<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the Menu ID from URL
$menuid = isset($_GET['fmenuid']) ? $_GET['fmenuid'] : ''; 

if (empty($menuid)) {
    echo 'Menu ID is missing.';
    exit;
}

// Get the menu details from the form
$menuname = isset($_POST['fmenuname']) ? $_POST['fmenuname'] : '';
$menutype = isset($_POST['fmenutype']) ? $_POST['fmenutype'] : '';
$menuprice = isset($_POST['fmenuprice']) ? $_POST['fmenuprice'] : '';
$menupicture = isset($_FILES['fmenupicture']['name']) && !empty($_FILES['fmenupicture']['name']) 
    ? $_FILES['fmenupicture']['name'] 
    : '';

// Check if the required form data is provided
if (empty($menuname) || empty($menutype) || empty($menuprice)) {
    echo 'Some fields are missing or not submitted.';
    exit;
}

// Connect to the database
$dbc = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

// Escape special characters in user input for security
$menuname = mysqli_real_escape_string($dbc, $menuname);
$menutype = mysqli_real_escape_string($dbc, $menutype);
$menuprice = mysqli_real_escape_string($dbc, $menuprice);

// Prepare SQL query to update menu details
$sql_update = "UPDATE menu SET 
    Menu_Name='$menuname', 
    Menu_Type='$menutype', 
    Menu_Price='$menuprice'";

// Handle file upload if a new file is provided
if ($menupicture) {
    $target_dir = "foodimage/"; // Folder where images will be saved
    $target_file = $target_dir . basename($_FILES["fmenupicture"]["name"]);
    
    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["fmenupicture"]["tmp_name"], $target_file)) {
        // Append the picture update to the SQL query with the correct path
        $sql_update .= ", Menu_Picture='$target_file'";
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit;
    }
}

// Add WHERE clause to ensure only the correct menu item is updated
$sql_update .= " WHERE Menu_ID='$menuid'";

// Execute the query
if (mysqli_query($dbc, $sql_update)) {
    // Redirect to the menu listing page after successful update
    header("Location: listmenu.php");
    exit;
} else {
    echo "Error updating record: " . mysqli_error($dbc);
}

// Close the database connection
mysqli_close($dbc);
?>