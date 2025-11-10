<?php
include('phpqrcode-master/qrlib.php'); // Path to qrlib.php

// Default empty QR file path
$filePath = '';

if (isset($_POST['generate'])) {
    $url = trim($_POST['url']); // Get URL from form input

    if (!empty($url)) {
        // File path to save QR code image (give unique name to avoid overwrite)
        $filePath = 'qrcode.png';

        // Generate QR code image
        QRcode::png($url, $filePath, QR_ECLEVEL_L, 6);
    }
}

// Hide warnings/notices
error_reporting(0);
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Generator</title>
</head>
<body>
    <h2>QR Code Generator</h2>

    <!-- Form to enter URL -->
    <form method="post">
        <label for="url">Enter URL:</label>
        <input type="text" name="url" id="url" placeholder="https://example.com" required style="width:300px;">
        <button type="submit" name="generate">Generate QR Code</button>
    </form>

    <?php if (!empty($filePath)): ?>
        <h3>Scan this QR Code</h3>
        <img height="500" src="<?php echo $filePath; ?>" alt="QR Code">
        <br><br>
        <button>
            <a href="<?php echo $filePath; ?>" download>Download QR Code</a>
        </button>
    <?php endif; ?>
</body>
</html>
