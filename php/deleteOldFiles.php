<?php
// Specify the folder path where the files are stored
$folderPath = 'uploadedFiles/';

// Specify the maximum age in seconds (e.g., 3600 seconds = 1 hour)
$maxAge = 5;

// Get the current time
$currentTime = time();

// Open the folder
$dir = opendir($folderPath);

// Loop through the files in the folder
while ($file = readdir($dir)) {
    // Skip the current and parent directories
    if ($file == '.' || $file == '..') {
        continue;
    }

    // Construct the full file path
    $filePath = $folderPath . $file;

    // Check if the file is a regular file (not a directory)
    if (is_file($filePath)) {
        // Get the last modified time of the file
        $lastModified = filemtime($filePath);

        // Calculate the age of the file in seconds
        $fileAge = $currentTime - $lastModified;

        // Check if the file is older than the specified maximum age
        if ($fileAge >= $maxAge) {
            // Delete the file
            if (unlink($filePath)) {
                echo "File $file deleted successfully.<br>";
            } else {
                echo "Error deleting file $file.<br>";
            }
        }
    }
}

// Close the folder
closedir($dir);