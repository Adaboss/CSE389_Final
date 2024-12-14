<?php
// Set the upload directory
$upload_dir = 'uploads/';

// Create the upload directory if it doesn't exist
// I never knew you could do this with html so I was shocked to learn about it and implement it
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file_name = basename($_FILES['file']['name']);
    $target_file = $upload_dir . $file_name;
    //This moves the file from memory to the upload directory, and checks if it did it properly	
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
	//Not fully sure what these headers do, GPT helped with that
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
//General formatting for html I found and generated so it will work without issues
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
    //hard to figure this out but actually pretty simple to do
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <!-- List of Uploaded Files -->
    //Lists file, gets updated after every new upload in other part of program
    //Creates href link to download	
    //not entirely sure what htmlspecialchars does, but it helps not break things when files have weird names, I think. 	
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
