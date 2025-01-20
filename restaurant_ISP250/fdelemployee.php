<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
    <style>
        /* CSS styles */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 20%;
            background-color: #8B1F1F;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .sidebar .top-section {
            padding: 20px;
            text-align: center;
			
        }

        .sidebar .menu {
            list-style: none;
            padding: 0;

        }

        .sidebar .menu li {
            padding: 15px 20px;
            cursor: pointer;
        }

        .sidebar .menu li:hover {
            background-color: #A32F2F;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #8B1F1F;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            background-color: #F7E7D1;
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
			display: flex;
			flex-direction: column;
			gap: 15px;
        }

        .form-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 0;
            font-size: 14px;
        }

        .form-container button {
            padding: 10px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: white;
        }

        .del-btn {
            background-color: #F44336;
			width: 100%;
        }

        .form-container .button-group {
            display: flex;
            justify-content: space-between;
			margin-top: 10px;
        }
    </style>
</head>
<body>
<?php
$empid = $_GET['Emp_ID']; // Get the Menu ID from the URL
$dbc = mysqli_connect("localhost", "root", "", "restaurant"); // Connect to the database

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM employee WHERE Emp_ID = '$empid'"; // Fetch the menu item based on Emp_ID
$result = mysqli_query($dbc, $sql);

if (false === $result) {
    echo mysqli_error(); // Display error if query fails
}

$row = mysqli_fetch_assoc($result);
?>
<form action="employeedelprocess.php?fempid=<?php echo $empid; ?>" method="post">
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="top-section">
                <h2>ADMIN</h2>
            </div>
            <ul class="menu">
				<li onclick="window.location.href='frmaddmenu.php';">
					Add Menu <span class="icon">📄</span>
				</li>
				<li onclick="window.location.href='listmenu.php';">
					Update/Delete Menu <span class="icon">📝</span>
				</li>
				<li onclick="window.location.href='frmaddemployee.php';">
					Add Employee <span class="icon">👤</span>
				</li>
				<li onclick="window.location.href='listemployee.php';">
					Update/Delete Employee <span class="icon">🔧</span>
				</li>
				<li onclick="window.location.href='listorderdetail.php';">
					View Order Detail <span class="icon">📊</span>
				</li>
				<li onclick="window.location.href='listfeedback.php';">
					View Feedback <span class="icon">💬</span>
				</li>
				<li class="logout" onclick="window.location.href='frmadminlogin.php';">
					Logout <span class="icon">🚪</span>
				</li>
			</ul>
		</div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">Delete Employee</div>
            <div class="content">
                <!-- Form for Adding Menu -->
                <div class="form-container">
                    <form action="employeedelprocess.php" method="POST">
                        
						<label for="employee_fname">Employee First Name</label>
						<input type="text" name="fempfname" value="<?php echo htmlspecialchars($row['Emp_FirstName'], ENT_QUOTES, 'UTF-8'); ?>" disabled>

                        <label for="employee_lname">Employee Last Name</label>
						<input type="text" name="femplname" value="<?php echo htmlspecialchars($row['Emp_LastName'], ENT_QUOTES, 'UTF-8'); ?>" disabled>

						<label for="employee_ic">Employee IC</label>
                        <input type="text" name="fempic" value='<?php echo $row['Emp_NRIC']; ?>' disabled>

                        <label for="employee_phone">Employee Phone</label>
                        <input type="text" name="fempphone" value='<?php echo $row['Emp_Phone']; ?>' disabled>

                        <label for="employee_address">Employee Address</label>
						<input type="text" name="fempaddr" value="<?php echo htmlspecialchars($row['Emp_Address'], ENT_QUOTES, 'UTF-8'); ?>" disabled>
						
						<label for="employee_emergencyno">Employee Emergency Number</label>
                        <input type="text" name="fempemergencyno" value='<?php echo $row['Emp_EmergencyNo']; ?>' disabled>

						<label for="employee_email">Employee Email</label>
                        <input type="text" name="fempemail" value='<?php echo $row['Emp_Email']; ?>' disabled>
						
						<label for="employee_password">Employee Password</label>
                        <input type="text" name="femppass" value='<?php echo $row['Emp_Password']; ?>' disabled>
						
                        <div class="button-group">
                            <button type="submit" class="del-btn">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>