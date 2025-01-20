<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the Employee ID from URL
$empid = isset($_GET['fempid']) ? $_GET['fempid'] : ''; 

if (empty($empid)) {
    echo 'Employee ID is missing.';
    exit;
}

// Get the employee details from the form
$empfname = isset($_POST['fempfname']) ? $_POST['fempfname'] : '';
$emplname = isset($_POST['femplname']) ? $_POST['femplname'] : '';
$empic = isset($_POST['fempic']) ? $_POST['fempic'] : '';
$empphone = isset($_POST['fempphone']) ? $_POST['fempphone'] : '';
$empaddress = isset($_POST['fempaddr']) ? $_POST['fempaddr'] : '';
$empemergencyno = isset($_POST['fempemergencyno']) ? $_POST['fempemergencyno'] : '';
$empemail = isset($_POST['fempemail']) ? $_POST['fempemail'] : '';
$emppass = isset($_POST['femppass']) ? $_POST['femppass'] : '';

// Check if the required form data is provided
if (empty($empfname) || empty($emplname) || empty($empic) || empty($empphone) || empty($empaddress) || empty($empemergencyno) || empty($empemail) || empty($emppass)) {
    echo 'Some fields are missing or not submitted.';
    exit;
}

// Connect to the database
$dbc = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

// Extract DOB from NRIC
function getDOBFromNRIC($nric) {
    if (strlen($nric) !== 12 || !ctype_digit($nric)) {
        return false; // Invalid NRIC format
    }
    $year = substr($nric, 0, 2);
    $month = substr($nric, 2, 2);
    $day = substr($nric, 4, 2);

    // Assume year is in the 2000s if less than 50, otherwise 1900s
    $year = $year < 50 ? "20$year" : "19$year";

    // Validate the date
    if (!checkdate($month, $day, $year)) {
        return false;
    }

    return "$year-$month-$day"; // Return DOB in 'YYYY-MM-DD' format
}

$empdob = getDOBFromNRIC($empic);

if (!$empdob) {
    echo 'Invalid NRIC format. Cannot extract DOB.';
    exit;
}

// Escape special characters in user input for security
$empfname = htmlspecialchars($empfname, ENT_QUOTES, 'UTF-8');
$emplname = htmlspecialchars($emplname, ENT_QUOTES, 'UTF-8');
$empaddress = htmlspecialchars($empaddress, ENT_QUOTES, 'UTF-8');

// If the form is submitted, insert the data into the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare the SQL query
    $query = "UPDATE employee SET
                Emp_FirstName = '$empfname',
                Emp_LastName = '$emplname',
                Emp_NRIC = '$empic',
                Emp_Phone = '$empphone',
                Emp_Address = '$empaddress',
                Emp_EmergencyNo = '$empemergencyno',
                Emp_Email = '$empemail',
                Emp_Password = '$emppass',
                Emp_DOB = '$empdob'
              WHERE Emp_ID = '$empid'";

    // Execute the query
    if (mysqli_query($dbc, $query)) {
        // After successful update, redirect to the listemployee page
        header('Location: listemployee.php');
        exit;
    } else {
        echo 'Error: ' . mysqli_error($dbc);
    }
}

// If the page is first loaded, show the confirmation dialog
if (!isset($_POST['fempfname'])) {
    echo '
    <script>
        window.onload = function() {
            var confirmation = confirm("Are you sure you want to update this employee item?");
            if (confirmation) {
                // If the user clicks "OK", submit the form
                document.getElementById("update_form").submit();
            } else {
                // If the user clicks "Cancel", redirect back to the menu list
                window.location.assign("listemployee.php");
            }
        }
    </script>
    ';
}
?>

<!-- Hidden form to submit the employee update -->
<form id="update_form" action="employeeupdprocess.php?fempid=<?php echo $empid; ?>" method="POST" style="display:none;">
    <input type="hidden" name="fempfname" value="<?php echo $empfname; ?>">
    <input type="hidden" name="femplname" value="<?php echo $emplname; ?>">
    <input type="hidden" name="fempic" value="<?php echo $empic; ?>">
    <input type="hidden" name="fempphone" value="<?php echo $empphone; ?>">
    <input type="hidden" name="fempaddr" value="<?php echo $empaddress; ?>">
    <input type="hidden" name="fempemergencyno" value="<?php echo $empemergencyno; ?>">
    <input type="hidden" name="fempemail" value="<?php echo $empemail; ?>">
    <input type="hidden" name="femppass" value="<?php echo $emppass; ?>">
    <input type="hidden" name="empdob" value="<?php echo $empdob; ?>">
</form>