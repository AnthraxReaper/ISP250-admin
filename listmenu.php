<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update/Delete Menu</title>
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

		.search-container {
			display: flex;
			margin-bottom: 20px;
			width: 100%; /* Ensures the container spans the entire width of the content */
		}

		.search-form {
			display: flex;
			width: 100%; /* Makes the search form span the entire container */
		}

		.search-input {
			flex: 1;
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 5px 0 0 5px;
			font-size: 16px;
		}

		.search-button {
			padding: 10px 20px;
			background-color: #8B1F1F;
			color: white;
			border: none;
			border-radius: 0 5px 5px 0;
			cursor: pointer;
			font-size: 16px;
		}

		.search-button:hover {
			background-color: #A32F2F;
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
            <div class="header">Update/Delete Menu</div>
            <div class="content">
                <!-- Search Bar -->
                <div class="search-container">
					<form method="GET" action="listmenu.php" class="search-form">
						<input 
							type="text" 
							name="search" 
							placeholder="Search menu..." 
							class="search-input">
						<button 
							type="submit" 
							class="search-button">
							Search
						</button>
					</form>
				</div>

                <!-- Menu Details Table -->
                <h3 align="center"><font color="#000000">Menu Details</font></h3>
                <table align="center" border="1">
                    <tr>
                        <th><font color="#FFFFFF">Menu ID</font></th>
                        <th><font color="#FFFFFF">Menu Name</font></th>
                        <th><font color="#FFFFFF">Menu Type</font></th>
                        <th><font color="#FFFFFF">Menu Price</font></th>
                        <th><font color="#FFFFFF">Menu Picture</font></th>
                        <th colspan="2"><font color="#FFFFFF">Action</font></th>
                    </tr>

                    <?php
                    // PHP Code to Handle Search
                    $dbc = mysqli_connect("localhost", "root", "", "restaurant");
                    if (mysqli_connect_errno()) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }

                    $search = isset($_GET['search']) ? mysqli_real_escape_string($dbc, $_GET['search']) : '';
                    $sql = "SELECT * FROM menu";
                    if ($search) {
                        $sql .= " WHERE Menu_Name LIKE '%$search%' OR Menu_Type LIKE '%$search%'";
                    }
                    $result = mysqli_query($dbc, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                <td><font color="#000000">' . $row['Menu_ID'] . '</font></td>
                                <td><font color="#000000">' . $row['Menu_Name'] . '</font></td>
                                <td><font color="#000000">' . $row['Menu_Type'] . '</font></td>
                                <td><font color="#000000">' . $row['Menu_Price'] . '</font></td>
                                <td><img src="Uploads/Menu Pictures/' . $row['Menu_Picture'] . '" alt="Not Available" width="200"></td>
                                <td><a href="fupdmenu.php?Menu_ID=' . $row['Menu_ID'] . '" class="btn btn-warning" role="button">Update</a></td>
                                <td><a href="fdelmenu.php?Menu_ID=' . $row['Menu_ID'] . '" class="btn btn-danger" role="button">Delete</a></td>
                              </tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>