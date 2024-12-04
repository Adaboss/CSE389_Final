<?php
// Set the upload directory
$upload_dir = 'uploads/';

// Create the upload directory if it doesn't exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file_name = basename($_FILES['file']['name']);
    $target_file = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $message = "File uploaded successfully: $file_name";
    } else {
        $message = "Error uploading file.";
    }
}

// Handle file download
if (isset($_GET['download'])) {
    $file_to_download = $upload_dir . basename($_GET['download']);
    if (file_exists($file_to_download)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_to_download) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_to_download));
        readfile($file_to_download);
        exit;
    } else {
        $message = "File not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>
</head>
<body>
    <h1>File Manager</h1>
    
    <!-- Display messages -->
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <!-- File Upload Form -->
    <h2>Upload a File</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <!-- List of Uploaded Files -->
    <h2>Uploaded Files</h2>
    <ul>
        <?php
        // List files in the upload directory
        $files = array_diff(scandir($upload_dir), ['.', '..']);
        foreach ($files as $file):
        ?>
            <li>
                <a href="?download=<?php echo urlencode($file); ?>"><?php echo htmlspecialchars($file); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
