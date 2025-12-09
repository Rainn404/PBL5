<?php
/**
 * Test form submission and save detailed response
 */

$cookieFile = tempnam(sys_get_temp_dir(), 'curl_cookie_');
$ch = curl_init();

curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);

// Step 1: Get form
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/pendaftaran/create");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, false);

$response = curl_exec($ch);
$csrf = null;

if (preg_match('/<input[^>]*name="_token"[^>]*value="([^"]+)"/', $response, $m)) {
    $csrf = $m[1];
}

// Step 2: Submit
$nim = 'TEST' . time();

$postData = [
    '_token' => $csrf,
    'nama' => 'Tester Name',
    'nim' => $nim,
    'semester' => '2',
    'no_hp' => '081234567890',
    'alasan_mendaftar' => 'Saya ingin bergabung dengan HIMA-TI karena ingin belajar lebih dalam tentang teknologi informasi dan berkembang bersama.',
    'pengalaman' => '',
    'skill' => '',
    'agree' => 'on'
];

curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/pendaftaran/");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
]);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
$final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

// Save response
file_put_contents('test_form_response.html', $response);

// Extract form to see what data is still there
if (preg_match('/<form[^>]*>.*?<\/form>/is', $response, $m)) {
    $form = $m[0];
    
    // Check which fields have values
    echo "Form Fields Analysis:\n";
    echo "NIM in form: " . (strpos($form, "value=\"{$nim}\"") !== false ? "YES" : "NO") . "\n";
    
    // Check for error messages
    $errCount = preg_match_all('/<p[^>]*class="[^"]*error[^"]*"[^>]*>([^<]+)</i', $form, $m);
    if ($errCount > 0) {
        echo "\nError messages found: $errCount\n";
        foreach ($m[1] as $err) {
            echo "  - " . substr($err, 0, 80) . "\n";
        }
    } else {
        echo "\nNo error messages in form\n";
    }
    
    // Check for validation.errors helper calls
    if (strpos($form, '@error') !== false) {
        echo "\nForm has @error blade directives\n";
    }
    
    // Check if form has Laravel errors
    if (strpos($response, '$errors') !== false) {
        echo "Response has $errors variable references\n";
    }
}

echo "\n✓ Response saved to test_form_response.html\n";

curl_close($ch);
unlink($cookieFile);
