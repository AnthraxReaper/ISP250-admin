<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the Employee ID from URL
$employeeid = isset($_GET['femployeeid']) ? $_GET['femployeeid'] : ''; 

if (empty($employeeid)) {
    echo 'Employee ID is missing.';
    exit;
}

// Get the employee details from the form
$emp_firstname = isset($_POST['fempfname']) ? $_POST['fempfname'] : '';
$emp_lastname = isset($_POST['femplname']) ? $_POST['femplname'] : '';
$emp_nric = isset($_POST['fempic']) ? $_POST['fempic'] : '';
$emp_phone = isset($_POST['fempphone']) ? $_POST['fempphone'] : '';
$emp_address = isset($_POST['fempaddr']) ? $_POST['fempaddr'] : '';
$emp_emergencyno = isset($_POST['fempemergencyno']) ? $_POST['fempemergencyno'] : '';
$emp_email = isset($_POST['fempemail']) ? $_POST['fempemail'] : '';
$emp_password = isset($_POST['femppass']) ? $_POST['femppass'] : '';

// Check if the required employee fields are provided
if (empty($emp_firstname) || empty($emp_lastname) || empty($emp_nric) || empty($emp_phone) || empty($emp_email) || empty($emp_password)) {
    echo 'Some employee fields are missing or not submitted.';
    exit;
}

// Generate Emp_Name and Emp_DOB
$emp_name = $emp_firstname . ' ' . $emp_lastname; // Concatenate first and last names
$emp_dob = substr($emp_nric, 0, 6); // Extract the first 6 digits of the NRIC as DOB

// Connect to the database
$dbc = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

// Escape special characters in user input for security
$emp_firstname = mysqli_real_escape_string($dbc, $emp_firstname);
$emp_lastname = mysqli_real_escape_string($dbc, $emp_lastname);
$emp_nric = mysqli_real_escape_string($dbc, $emp_nric);
$emp_phone = mysqli_real_escape_string($dbc, $emp_phone);
$emp_address = mysqli_real_escape_string($dbc, $emp_address);
$emp_emergencyno = mysqli_real_escape_string($dbc, $emp_emergencyno);
$emp_email = mysqli_real_escape_string($dbc, $emp_email);
$emp_password = mysqli_real_escape_string($dbc, $emp_password);

// Prepare SQL query to update employee details
$sql_update = "UPDATE employee SET 
    Emp_FirstName='$emp_firstname', 
    Emp_LastName='$emp_lastname', 
    Emp_Name='$emp_name', 
    Emp_NRIC='$emp_nric', 
    Emp_DOB='$emp_dob', 
    Emp_Phone='$emp_phone', 
    Emp_Address='$emp_address', 
    Emp_EmergencyNo='$emp_emergencyno', 
    Emp_Email='$emp_email', 
    Emp_Password='$emp_password'";

// Add WHERE clause to ensure only the correct employee is updated
$sql_update .= " WHERE Employee_ID='$employeeid'";

// Execute the query
if (mysqli_query($dbc, $sql_update)) {
    // Redirect to the employee listing page after successful update
    header("Location: listemployee.php");
    exit;
} else {
    echo "Error updating record: " . mysqli_error($dbc);
}

// Close the database connection
mysqli_close($dbc);
?>
