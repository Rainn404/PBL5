<?php
/**
 * Test form submission with proper headers
 */

$cookieFile = tempnam(sys_get_temp_dir(), 'curl_cookie_');
$ch = curl_init();

curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);

// Step 1: Get form
echo "=== Getting form ===\n";
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/pendaftaran/create");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
]);

$response = curl_exec($ch);
$csrf = null;

if (preg_match('/<input[^>]*name="_token"[^>]*value="([^"]+)"/', $response, $m)) {
    $csrf = $m[1];
    echo "CSRF token: " . substr($csrf, 0, 20) . "...\n";
}

if (!$csrf) {
    echo "ERROR: No CSRF token found\n";
    die();
}

// Step 2: Submit form with proper headers
echo "\n=== Submitting form ===\n";

// Use a REAL NIM that's not in database
$nim = 'TEST' . time();

$postData = [
    '_token' => $csrf,
    'nama' => 'Tester Name',
    'nim' => $nim,
    'semester' => '2',
    'no_hp' => '081234567890',
    'alasan_mendaftar' => 'Saya ingin bergabung dengan HIMA-TI karena ingin belajar lebih dalam tentang teknologi informasi dan berkembang bersama teman-teman.',
    'pengalaman' => '',
    'skill' => '',
    'agree' => 'on'
];

echo "POST Data:\n";
foreach ($postData as $k => $v) {
    if ($k !== '_token') {
        echo "  $k = " . substr($v, 0, 40) . (strlen($v) > 40 ? "..." : "") . "\n";
    }
}

curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/pendaftaran/");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

// Set proper browser headers
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
    'Content-Type: application/x-www-form-urlencoded',
    'Referer: http://127.0.0.1:8000/pendaftaran/create'
]);

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

echo "\nResponse:\n";
echo "  HTTP Code: $http_code\n";
echo "  Final URL: $final_url\n";

// Check for success
if (strpos($final_url, '/pendaftaran/success') !== false) {
    echo "  ✅ SUCCESS! Redirected to success page\n";
} else if (strpos($final_url, '/pendaftaran/create') !== false) {
    echo "  ❌ Form returned to create page\n";
    
    // Look for errors
    if (preg_match_all('/<p[^>]*class="[^"]*text-red[^"]*"[^>]*>([^<]+)</', $response, $m)) {
        echo "\n  Errors:\n";
        foreach ($m[1] as $err) {
            echo "    - " . htmlspecialchars_decode(trim($err)) . "\n";
        }
    }
} else {
    echo "  ⚠️  Unexpected URL: $final_url\n";
}

curl_close($ch);
unlink($cookieFile);
