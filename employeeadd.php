<?php
// Assign data from customer form into variables
$empfname = $_POST['fempfname'];
$emplname = $_POST['femplname'];
$empic = $_POST['fempic'];
$empphone = $_POST['fempphone'];
$empaddress = $_POST['fempaddr'];
$empemergencyno = $_POST['fempemergencyno'];
$empemail = $_POST['fempemail'];
$emppass = $_POST['femppass'];

// Connection to the server and database
$dbc = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Function to extract date of birth from NRIC
function getDateOfBirthFromNRIC($nric) {
    if (strlen($nric) !== 12 || !ctype_digit($nric)) {
    return false; // Non-numeric characters are not allowed
	}

    // Extract the first 6 digits (YYMMDD)
    $dobPart = substr($nric, 0, 6);
    $year = intval(substr($dobPart, 0, 2));
    $month = intval(substr($dobPart, 2, 2));
    $day = intval(substr($dobPart, 4, 2));

    // Determine the century
    $currentYearShort = intval(date("y"));
    $year += ($year <= $currentYearShort) ? 2000 : 1900;

    // Validate date
    if (!checkdate($month, $day, $year)) {
        return false;
    }

    // Return in YYYY-MM-DD format
    return sprintf("%04d-%02d-%02d", $year, $month, $day);
}

// Extract DOB from NRIC
$empdob = getDateOfBirthFromNRIC($empic);
if ($empdob === false) {
    print '<script>alert("Invalid NRIC format. No record has been added.");</script>';
    print '<script>window.location.assign("frmaddemployee.php");</script>';
    exit();
}

// Escape special characters in user input
$empfname = mysqli_real_escape_string($dbc, $empfname);
$emplname = mysqli_real_escape_string($dbc, $emplname);
$empaddress = mysqli_real_escape_string($dbc, $empaddress);

// SQL statement to insert data into the employee table
$sql = "INSERT INTO `employee` 
        (`Emp_Name`, `Emp_FirstName`, `Emp_LastName`, `Emp_NRIC`, `Emp_DOB`, `Emp_Phone`, `Emp_Address`, `Emp_EmergencyNo`, `Emp_Email`, `Emp_Password`) 
        VALUES 
        (CONCAT('$empfname', ' ', '$emplname'), '$empfname', '$emplname', '$empic', '$empdob', '$empphone', '$empaddress', '$empemergencyno', '$empemail', '$emppass')";

// Execute the query
$results = mysqli_query($dbc, $sql);

if ($results) {
    mysqli_commit($dbc);
    print '<script>alert("Record Had Been Added");</script>';
    print '<script>window.location.assign("listemployee.php");</script>';
} else {
    mysqli_rollback($dbc);
    print '<script>alert("Data Is Invalid, No Record Been Added");</script>';
    print '<script>window.location.assign("frmaddemployee.php");</script>';
}
?>