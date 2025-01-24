<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the employee ID from URL
$employeeid = isset($_GET['fempid']) ? $_GET['fempid'] : ''; 

if (empty($employeeid)) {
    echo 'Employee ID is missing.';
    exit;
}

// Connect to the database
$dbc = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

// Check if the user has confirmed the deletion
if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
	// Escape special characters in user input
    $empfname = mysqli_real_escape_string($dbc, $empfname);
	$emplname = mysqli_real_escape_string($dbc, $emplname);
	$empaddress = mysqli_real_escape_string($dbc, $empaddress);
    
    // Perform the deletion query
    $sql = "DELETE FROM employee WHERE Employee_ID = '$employeeid'";
    $result = mysqli_query($dbc, $sql);

    if ($result) {
        // If deletion successful
        mysqli_commit($dbc);
        echo '<script>alert("Product Record Successfully Deleted.");</script>';
        echo '<script>window.location.assign("listemployee.php");</script>';
    } else {
        // If deletion failed
        mysqli_rollback($dbc);
        echo '<script>alert("Product Record Failed to Delete.");</script>';
        echo '<script>window.location.assign("listemployee.php");</script>';
    }
} else {
    // Confirmation not received yet, show the confirmation message
    echo '
    <script>
        window.onload = function() {
            // Show the confirmation dialog
            var confirmation = confirm("Are you sure you want to delete this employee item?");
            if (confirmation) {
                // If the user clicks "OK", submit the form to delete
                document.getElementById("delete_form").submit();
            } else {
                // If the user clicks "Cancel", redirect back to the employee list
                window.location.assign("listemployee.php");
            }
        };
    </script>
    ';
}
?>

<!-- Hidden Form to submit the deletion -->
<form id="delete_form" action="employeedelprocess.php?fempid=<?php echo $employeeid; ?>" method="POST" style="display:none;">
    <input type="hidden" name="confirm_delete" value="yes">
</form>
