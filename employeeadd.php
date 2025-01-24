<?php
// Assign data from customer form into variable
$empfname = $_POST['fempfname'];
$emplname = $_POST['femplname'];
$empic = $_POST['fempic']; // Emp_NRIC is $empic here
$empphone = $_POST['fempphone'];
$empaddress = $_POST['fempaddr'];
$empemergencyno = $_POST['fempemergencyno'];
$empemail = $_POST['fempemail'];
$emppass = $_POST['femppass'];

// Connection to the server and database
$dbc = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Escape special characters in user input
$empfname = mysqli_real_escape_string($dbc, $empfname);
$emplname = mysqli_real_escape_string($dbc, $emplname);
$empaddress = mysqli_real_escape_string($dbc, $empaddress);

// Extract the first 6 digits of Emp_NRIC (from $empic) for Emp_DOB
$emp_dob = substr($empic, 0, 6); // Extract the first 6 digits for the DOB

// SQL statement to insert data from form into table employee
$sql = "INSERT INTO `employee` (`Emp_Name`, `Emp_FirstName`, `Emp_LastName`, `Emp_NRIC`, `Emp_DOB`, `Emp_Phone`, `Emp_Address`, `Emp_EmergencyNo`, `Emp_Email`, `Emp_Password`)
        VALUES (CONCAT('$empfname', ' ', '$emplname'), '$empfname', '$emplname', '$empic', '$emp_dob', '$empphone', '$empaddress', '$empemergencyno', '$empemail', '$emppass')";

// Execute the query
$results = mysqli_query($dbc, $sql);

// Check if the query was successful
if ($results) {
    mysqli_commit($dbc);
    // Display success message
    print '<script>alert("Record Has Been Added");</script>';
    // Redirect to listemployee.php page
    print '<script>window.location.assign("listemployee.php");</script>';
} else {
    mysqli_rollback($dbc);
    // Display error message
    print '<script>alert("Data Is Invalid, No Record Added");</script>';
    // Redirect back to frmaddemployee.php page
    print '<script>window.location.assign("frmaddemployee.php");</script>';
}
?>
