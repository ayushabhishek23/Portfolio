<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);
    
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!empty($_FILES["file"]["name"])) {
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            echo "File uploaded successfully!";
        } else {
            echo "File upload failed!";
        }
    }

    $data = "Name: $name\nEmail: $email\nMessage: $message\nFile: $fileName\n\n";
    file_put_contents("submissions.txt", $data, FILE_APPEND);

    echo "Form submitted successfully!";
} else {
    echo "Invalid request.";
}
?>
