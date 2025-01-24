<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Employee</title>
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
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.sidebar .menu .icon {
			margin-left: 10px;
			font-size: 16px;
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
		
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
			background-color: #ffffff;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #8B1F1F;
            color: white;
        }

        a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
        }

        .btn-warning {
            background-color: #FFA500;
        }

        .btn-danger {
            background-color: #F44336;
        }

        .btn-warning:hover {
            background-color: #e68900;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<form name="menu" method="post" action="employeeadd.php">
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
				<li class="logout" onclick="window.location.href='start_page.php';">
					Logout <span class="icon">🚪</span>
				</li>
			</ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">Employee List</div>
            <div class="content">
                <!-- Menu Details Table -->
                <h3 align="center"><font color="#000000">Employee Details</font></h3>
                <table align="center" border="1">
                    <tr>
                        <th><font color="#FFFFFF">Employee ID</font></th>
                        <th><font color="#FFFFFF">Employee Name</font></th>
						<th><font color="#FFFFFF">Employee First Name</font></th>
						<th><font color="#FFFFFF">Employee Last Name</font></th>
						<th><font color="#FFFFFF">Employee IC</font></th>
						<th><font color="#FFFFFF">Employee DOB</font></th>
                        <th><font color="#FFFFFF">Employee Phone</font></th>
                        <th><font color="#FFFFFF">Employee Address</font></th>
						<th><font color="#FFFFFF">Employee Emergency Number</font></th>
						<th><font color="#FFFFFF">Employee Email</font></th>
						<th><font color="#FFFFFF">Employee Password</font></th>
                        <th colspan="2"><font color="#FFFFFF">Action</font></th>
                    </tr>

                    <?php
                    // Connection to the server and database
                    $dbc = mysqli_connect ("localhost","root","","restaurant");
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $sql = "SELECT * FROM employee";
                    $result = mysqli_query($dbc, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                <td><font color="#000000">' . $row['Employee_ID'] . '</font></td>
                                <td><font color="#000000">' . $row['Emp_Name'] . '</font></td>
								<td><font color="#000000">' . $row['Emp_FirstName'] . '</font></td>
								<td><font color="#000000">' . $row['Emp_LastName'] . '</font></td>
								<td><font color="#000000">' . $row['Emp_NRIC'] . '</font></td>
								<td><font color="#000000">' . $row['Emp_DOB'] . '</font></td>
                                <td><font color="#000000">' . $row['Emp_Phone'] . '</font></td>
                                <td><font color="#000000">' . $row['Emp_Address'] . '</font></td>
								<td><font color="#000000">' . $row['Emp_EmergencyNo'] . '</font></td>
								<td><font color="#000000">' . $row['Emp_Email'] . '</font></td>
								<td><font color="#000000">' . $row['Emp_Password'] . '</font></td>
                                <td><a href="fupdemployee.php?Employee_ID=' . $row['Employee_ID'] . '" class="btn btn-warning" role="button">Update</a></td>
                                <td><a href="fdelemployee.php?Employee_ID=' . $row['Employee_ID'] . '" class="btn btn-danger" role="button">Delete</a></td>
                              </tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</form>
</body>
</html>