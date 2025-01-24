<?php
// Assign data from menu form into variables
$menuname = $_POST['fmenuname'];
$menutype = $_POST['fmenutype'];
$menuprice = $_POST['fmenuprice'];

// Connection to the server and database
$dbc = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Escape special characters in user input
$menuname = mysqli_real_escape_string($dbc, $menuname);
$menutype = mysqli_real_escape_string($dbc, $menutype);
$menuprice = mysqli_real_escape_string($dbc, $menuprice);

// Handle file upload
if (isset($_FILES['fmenupicture']) && $_FILES['fmenupicture']['error'] == UPLOAD_ERR_OK) {
    $uploadDir = 'foodimage/'; // Directory to save files
    $menupicture = basename($_FILES['fmenupicture']['name']);
    $uploadFile = $uploadDir . $menupicture;

    // Move uploaded file to the desired directory
    if (move_uploaded_file($_FILES['fmenupicture']['tmp_name'], $uploadFile)) {
        // Prepare the SQL statement to insert data into the database
        $sql = "INSERT INTO `menu`(`Menu_Name`, `Menu_Type`, `Menu_Price`, `Menu_Picture`) 
                VALUES ('$menuname', '$menutype', '$menuprice', '$uploadFile')"; // Use $uploadFile for the path

        $results = mysqli_query($dbc, $sql);

        if ($results) {
            mysqli_commit($dbc);
            // Display success message
            echo '<script>alert("Record Has Been Added");</script>';
            echo '<script>window.location.assign("listmenu.php");</script>';
        } else {
            mysqli_rollback($dbc);
            // Display error message
            echo '<script>alert("Data Is Invalid, No Record Has Been Added");</script>';
            echo '<script>window.location.assign("frmaddmenu.php");</script>';
        }
    } else {
        echo '<script>alert("File upload failed.");</script>';
        echo '<script>window.location.assign("frmaddmenu.php");</script>';
    }
} else {
    echo '<script>alert("Please upload a valid file.");</script>';
    echo '<script>window.location.assign("frmaddmenu.php");</script>';
}
?>