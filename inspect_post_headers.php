<?php
$cookieFile = tempnam(sys_get_temp_dir(), 'curl_cookie_');
$ch = curl_init();
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);

curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/pendaftaran/create");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
if (preg_match('/<input[^>]*name="_token"[^>]*value="([^"]+)"/', $response, $m)) {
    $csrf = $m[1];
} else { echo "No token\n"; exit; }

$postData = [
    '_token' => $csrf,
    'nama' => 'HeaderTest',
    'nim' => 'HEADER' . time(),
    'semester' => '1',
    'no_hp' => '081234567890',
    'alasan_mendaftar' => str_repeat('a', 60),
    'pengalaman' => '',
    'skill' => '',
    'agree' => 'on'
];

curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/pendaftaran/");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($resp, 0, $header_size);
$body = substr($resp, $header_size);

echo "--- RESPONSE HEADERS ---\n";
echo $header . "\n";

curl_close($ch);
unlink($cookieFile);
