<?php
require_once 'connection.php'; // Ensure this file connects to your database
require_once 'phpqrcode/qrlib.php';

$path = 'images/';
if (!is_dir($path)) {
    mkdir($path, 0777, true); // Create directory if not exists
}

$qr_generated = false;
$filepath = '';

if (isset($_POST['submit'])) {
    $text = $_POST['text'];
    $filename = time().".png";
    $filepath = $path.$filename;

    // Generate QR code
    QRcode::png($text, $filepath, 'H', 4, 4);

    // Save to database
    $query = "INSERT INTO attendance (text, qrimage) VALUES ('$text', '$filename')";
    if (mysqli_query($connection, $query)) {
        echo "<script>alert('Data saved successfully');</script>";
        $qr_generated = true;
    } else {
        echo "<script>alert('Error saving data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f06, #ff9);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .qr-code {
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>QR Code Generated</h1>
        <?php if ($qr_generated): ?>
            <p>Your QR code has been generated successfully!</p>
            <div class="qr-code">
                <img src="<?php echo $filepath; ?>" alt="QR Code">
            </div>
            <a href="index.html" class="button">Generate Another QR Code</a>
        <?php else: ?>
            <p>There was an error generating the QR code.</p>
            <a href="index.html" class="button">Try Again</a>
        <?php endif; ?>
    </div>
</body>
</html>