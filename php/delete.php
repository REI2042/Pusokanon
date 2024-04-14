<?php
// Check if the fileName parameter is set
if (isset($_POST['fileName'])) {
    $fileName = $_POST['fileName'];
    $filePath = 'uploadedFiles/' . $fileName; // Assuming the files are stored in the 'uploads' folder

    // Check if the file exists
    if (file_exists($filePath)) {
        // Delete the file
        if (unlink($filePath)) {
            echo "File deleted successfully.";
        } else {
            echo "Error deleting the file.";
        }
    } else {
        echo "File not found.";
    }
} else {
    echo "File name not provided.";
}