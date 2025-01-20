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
$menupicture = $_FILES['fmenupicture']['name'] ? $_FILES['fmenupicture']['name'] : '';

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

// Handle file upload if there's a new file
if ($menupicture) {
    $target_dir = "Uploads/Menu Picture"; // Folder where images will be saved
    $target_file = $target_dir . basename($_FILES["fmenupicture"]["name"]);
    if (move_uploaded_file($_FILES["fmenupicture"]["tmp_name"], $target_file)) {
        // File uploaded successfully, update the menu picture in the database
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit;
    }
}

// Add the confirmation dialog
echo '
<script>
	window.onload = function() {
		var confirmation = confirm("Are you sure you want to update this menu item?");
		if (confirmation) {
			// If the user clicks "OK", submit the form
			document.getElementById("update_form").submit();
		} else {
			// If the user clicks "Cancel", redirect back to the menu list
			window.location.assign("listmenu.php");
		}
	}
</script>
';

// Create a hidden form for submission
?>

<!-- Hidden form to submit the menu update -->
<form id="update_form" action="menuupdprocess.php?fmenuid=<?php echo $menuid; ?>" method="POST" style="display:none;" enctype="multipart/form-data">
    <input type="hidden" name="fmenuname" value="<?php echo $menuname; ?>">
    <input type="hidden" name="fmenutype" value="<?php echo $menutype; ?>">
    <input type="hidden" name="fmenuprice" value="<?php echo $menuprice; ?>">
    <input type="hidden" name="fmenupicture" value="<?php echo $menupicture; ?>">
</form>