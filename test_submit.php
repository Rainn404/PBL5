<?php

$cookieFile = tempnam(sys_get_temp_dir(), 'curl_cookie_');
$ch = curl_init();

// ✓ Set cookie jar to maintain session
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);

// Step 1: Get form page
echo "=== Step 1: Get form page ===\n";
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/pendaftaran/create");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_POST, false);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "Status: " . $http_code . "\n";
echo "Response length: " . strlen($response) . " bytes\n";

// Extract CSRF token
if (preg_match('/<input[^>]*name="_token"[^>]*value="([^"]+)"/', $response, $matches)) {
    $csrf_token = $matches[1];
    echo "✓ CSRF Token: " . substr($csrf_token, 0, 20) . "...\n";
} else {
    echo "✗ Token not found\n";
    die();
}

// Step 2: Submit form
echo "\n=== Step 2: Submit Form ===\n";

curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/pendaftaran/");
curl_setopt($ch, CURLOPT_POST, true);

$postData = [
    '_token' => $csrf_token,
    'nama' => 'Test User ' . time(),
    'nim' => '99999' . rand(100, 999),
    'semester' => '3',
    'no_hp' => '081234567890',
    'alasan_mendaftar' => 'Saya ingin bergabung dengan HIMA-TI karena saya ingin belajar dan berkembang bersama dalam dunia teknologi informasi',
    'pengalaman' => 'Tidak ada',
    'skill' => 'PHP, Laravel',
    'agree' => 'on'
];

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

echo "Posting data:\n";
foreach ($postData as $key => $value) {
    if ($key !== '_token') {
        echo "  $key = " . substr($value, 0, 50) . (strlen($value) > 50 ? "..." : "") . "\n";
    }
}

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$redirect_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

echo "HTTP Status: " . $http_code . "\n";
echo "Final URL: " . $redirect_url . "\n";
echo "Response length: " . strlen($response) . " bytes\n";

// Look for ALL error divs
if (preg_match_all('/<div[^>]*class="[^"]*error[^"]*"[^>]*>([^<]+)</i', $response, $matches)) {
    echo "\n❌ ERROR DIVS:\n";
    foreach ($matches[1] as $error) {
        echo "  " . htmlspecialchars_decode(trim($error)) . "\n";
    }
}

// Look for validation errors from Laravel
if (preg_match('/@error\\((.*?)\\)/', $response) || strpos($response, 'withErrors') !== false) {
    echo "\n⚠️  Response contains error handling code\n";
}

// Check for specific error in HTML
if (strpos($response, 'Terjadi kesalahan') !== false) {
    echo "\n⚠️  'Terjadi kesalahan' found in response\n";
}

// Save response untuk analysis
file_put_contents('test_response.html', $response);
echo "\n✓ Response saved to test_response.html\n";

// Extract form elements dari response
if (preg_match('/<form[^>]*>(.*?)<\/form>/is', $response, $m)) {
    $formContent = $m[1];
    
    // Check for input fields with errors
    if (preg_match_all('/<input[^>]*name="([^"]*)"[^>]*>/i', $formContent, $fields)) {
        echo "\nForm fields in response:\n";
        foreach (array_unique($fields[1]) as $field) {
            echo "  - $field\n";
        }
    }
    
    // Look for error messages
    preg_match_all('/<p[^>]*class="[^"]*text-red[^"]*"[^>]*>([^<]+)</i', $formContent, $errors);
    if (!empty($errors[1])) {
        echo "\n❌ Error messages found:\n";
        foreach ($errors[1] as $error) {
            echo "  " . htmlspecialchars_decode(trim($error)) . "\n";
        }
    }
    
    // Look for any span with error message
    preg_match_all('/<span[^>]*>Validation error[^<]*</i', $formContent, $spans);
    if (!empty($spans[0])) {
        echo "\n⚠️  Found span errors\n";
    }
}

echo "\n--- Response excerpt ---\n";
$excerpt = substr($response, 0, 2000);
// Remove all tags
$excerpt = strip_tags($excerpt);
$excerpt = preg_replace('/\s+/', ' ', $excerpt);
echo substr($excerpt, 0, 500) . "...\n";



curl_close($ch);
unlink($cookieFile);
?>

