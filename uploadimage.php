<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form inputs
    $menuId = $_POST['fmenuid'];
    $menuName = $_POST['fmenuname'];
    $menuType = $_POST['fmenutype'];
    $menuPrice = $_POST['fmenuprice'];

    // File upload directory
    $targetDir = "Uploads/Menu Pictures/";
    $fileName = basename($_FILES['fmenupicture']['name']);
    $targetFilePath = $targetDir . $fileName;
    $uploadOk = true;

    // Ensure the upload directory exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Check if file is a valid image
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $validTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($fileType, $validTypes)) {
        echo "Only JPG, JPEG, PNG, & GIF files are allowed.";
        $uploadOk = false;
    }

    // Attempt to upload the file
    if ($uploadOk && move_uploaded_file($_FILES['fmenupicture']['tmp_name'], $targetFilePath)) {
        // Connect to the database
        $conn = new mysqli('localhost', 'root', '', 'restaurant'); // Replace 'root', '', and 'restaurant' with your DB credentials

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO menu (menu_id, menu_name, menu_type, menu_price, Menu_Picture) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssd", $menuId, $menuName, $menuType, $menuPrice, $fileName);

        // Execute the query
        if ($stmt->execute()) {
            echo "Menu item added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "File upload failed.";
    }
}
?>
