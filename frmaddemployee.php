<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <style>
        /* CSS styles */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            display: flex;
            height: 100vh;
            flex-direction: column;
        }

        .main-container {
            display: flex;
            flex: 1;
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

        .add-btn {
            background-color: #4CAF50;
            width: 48%;
        }

        .reset-btn {
            background-color: #F44336;
            width: 48%;
        }

        .form-container .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Main Content -->
        <div class="main-container">
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

            <div class="main-content">
                <div class="header">Add Employee</div>
                <div class="content">
                    <!-- Form for Adding Employee -->
                    <div class="form-container">
                        <form action="employeeadd.php" method="POST">
                            <label for="employee_fname">Employee First Name</label>
                            <input type="text" id="employee_fname" name="fempfname" placeholder="Enter Employee First Name" required>

                            <label for="employee_lname">Employee Last Name</label>
                            <input type="text" id="employee_lname" name="femplname" placeholder="Enter Employee Last Name" required>

                            <label for="employee_ic">Employee IC</label>
                            <input type="text" id="employee_ic" name="fempic" placeholder="Enter Employee IC" required>

                            <label for="employee_phone">Employee Phone</label>
                            <input type="text" id="employee_phone" name="fempphone" placeholder="Enter Employee Phone" required>

                            <label for="employee_address">Employee Address</label>
                            <input type="text" id="employee_address" name="fempaddr" placeholder="Enter Employee Address" required>

                            <label for="employee_emergencyno">Employee Emergency Number</label>
                            <input type="text" id="employee_emergencyno" name="fempemergencyno" placeholder="Enter Employee Emergency Number" required>

                            <label for="employee_email">Employee Email</label>
                            <input type="text" id="employee_email" name="fempemail" placeholder="Enter Employee Email" required>

                            <label for="employee_password">Employee Password</label>
                            <input type="text" id="employee_password" name="femppass" placeholder="Enter Employee Password" required>

                            <div class="button-group">
                                <button type="submit" class="add-btn">Add</button>
                                <button type="reset" class="reset-btn">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>