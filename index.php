<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$upload_dir = 'uploads/';

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file_name = basename($_FILES['file']['name']);
    $file_name = preg_replace('/[^A-Za-z0-9.\-_]/', '', $file_name); 
    $target_file = $upload_dir . uniqid('file_', true) . '.' . pathinfo($file_name, PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $message = "File uploaded successfully: " . htmlspecialchars($file_name);
    } else {
        $message = "File upload failed.";
    }
}

if (isset($_GET['download'])) {
    $file_to_download = realpath($upload_dir . basename($_GET['download']));
    if (strpos($file_to_download, realpath($upload_dir)) === 0 && file_exists($file_to_download)) {
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
<meta charset="utf-8"/>
<title>
   Homepage - NoteShare
  </title>
</head>

</html>
<!-- // Debug: Entering debug section for line 60 -->
error_log("Debugging Line 60: " . __FILE__ . " at " . __LINE__);
<?php echo htmlspecialchars($_SESSION['username']); ?>
error_log("Exiting debug section for line 60");

!
<?php if (!empty($message)): ?>

<p>
</p>
<!-- // Debug: Entering debug section for line 67 -->
error_log("Debugging Line 67: " . __FILE__ . " at " . __LINE__);
<?php echo htmlspecialchars($message); ?>
error_log("Exiting debug section for line 67");

<?php endif; ?>

<h2>
 Upload File
</h2>
<form action="" enctype="multipart/form-data" method="POST">
<input name="file" required="" type="file"/>
<button type="submit">
  Upload File
 </button>
</form>
<h2>
 File List
</h2>
<ul>
</ul>
<?php
        $files = array_diff(scandir($upload_dir), ['.', '..']);
        foreach ($files as $file) {
// Debug: Entering debug section for line 88
error_log("Debugging Line 88: " . __FILE__ . " at " . __LINE__);
            echo "<li><a href='?download=" . urlencode($file) . "'>" . htmlspecialchars($file) . "</a></li>";
error_log("Exiting debug section for line 88");
        }
        ?>

<a href="logout.php">
 Logout
</a>
