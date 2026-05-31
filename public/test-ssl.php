<?php
echo "<h1>Diagnostic SSL / php.ini Check</h1>";

echo "<h2>1. Active php.ini</h2>";
echo "Loaded php.ini: <strong>" . php_ini_loaded_file() . "</strong><br>";

echo "<h2>2. Active SSL Settings</h2>";
echo "curl.cainfo: <strong>" . (ini_get('curl.cainfo') ?: '<i>(empty)</i>') . "</strong><br>";
echo "openssl.cafile: <strong>" . (ini_get('openssl.cafile') ?: '<i>(empty)</i>') . "</strong><br>";

echo "<h2>3. Test cURL connection</h2>";
$ch = curl_init('https://curl.se');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);

if ($res === false) {
    echo "<span style='color:red; font-weight:bold;'>cURL Test Failed!</span><br>";
    echo "Error (" . curl_errno($ch) . "): " . curl_error($ch);
} else {
    echo "<span style='color:green; font-weight:bold;'>cURL Test Succeeded!</span> Connection to https://curl.se is secure and verified.";
}
curl_close($ch);
