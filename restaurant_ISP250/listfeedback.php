<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback List</title>
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
			justify-content: flex-end; /* Align the search bar to the right */
			margin-bottom: 20px;
		}

		.search-form {
			display: flex;
			width: 100%; /* Make the search form span the available space */
			max-width: 500px; /* Optional: Limit the maximum width if needed */
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
<form name="feedback" method="post" action="">
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
            <div class="header">Feedback List</div>
            <div class="content">
				<!-- Search Bar -->
				<div class="search-container">
					<form method="GET" action="listfeedback.php" class="search-form">
						<input 
							type="text" 
							name="search" 
							placeholder="Search feedback..." 
							class="search-input">
						<button 
							type="submit" 
							class="search-button">
							Search
						</button>
					</form>
				</div>
				
                <!-- Menu Details Table -->
                <h3 align="center"><font color="#000000">Feedback Details</font></h3>
                <table align="center" border="1">
                    <tr>
                        <th><font color="#FFFFFF">Feedback ID</font></th>
                        <th><font color="#FFFFFF">Feedback Description</font></th>
                        <th><font color="#FFFFFF">Customer ID</font></th>
						<th><font color="#FFFFFF">Rating</font></th>
                    </tr>

					<?php
					// Connection to the server and database
					$dbc = mysqli_connect ("localhost","root","","restaurant");
					if (mysqli_connect_errno()) {
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}
					$search = isset($_GET['search']) ? mysqli_real_escape_string($dbc, $_GET['search']) : '';
					$sql = "SELECT * FROM feedback";
					if ($search) {
						$sql .= " WHERE Feedback_Description LIKE '%$search%' OR Rating LIKE '%$search%'";
					}
					$result = mysqli_query($dbc, $sql);
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<tr>
								<td><font color="#000000">' . $row['Feedback_ID'] . '</font></td>
								<td><font color="#000000">' . $row['Feedback_Description'] . '</font></td>
								<td><font color="#000000">' . $row['Cust_ID'] . '</font></td>
								<td>';
						// Generate star rating
						for ($i = 1; $i <= 5; $i++) {
							if ($i <= $row['Rating']) {
								echo '<span style="color: #f5c518;">&#9733;</span>'; // Filled star
							} else {
								echo '<span style="color: #ccc;">&#9733;</span>'; // Empty star
							}
						}
						echo '</td>
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