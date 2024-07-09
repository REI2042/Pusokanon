<?php
include 'DBconn.php';

if (isset($_GET['file']) && isset($_GET['filename'])) {
    $file = urldecode($_GET['file']);
    $filename = urldecode($_GET['filename']);

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid parameters.';
}
?>
