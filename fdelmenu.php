<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Menu</title>
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
$menuid = $_GET['Menu_ID']; // Get the Menu ID from the URL
$dbc = mysqli_connect("localhost", "root", "", "restaurant"); // Connect to the database

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM menu WHERE Menu_ID = '$menuid'"; // Fetch the menu item based on Menu_ID
$result = mysqli_query($dbc, $sql);

if (false === $result) {
    echo mysqli_error(); // Display error if query fails
}

$row = mysqli_fetch_assoc($result);
?>
<form action="menudelprocess.php?fmenuid=<?php echo $menuid; ?>" method="post">
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
            <div class="header">Delete Menu</div>
            <div class="content">
                <!-- Form for Adding Menu -->
                <div class="form-container">
                    <form action="menudelprocess.php" method="POST">

                        <label for="menu_name">Menu Name</label>
                        <input type="text" name="fmenuname" value="<?php echo htmlspecialchars($row['Menu_Name'], ENT_QUOTES, 'UTF-8'); ?>" disabled>

                        <label for="menu_type">Menu Type</label>
                        <input type="text" name="fmenutype" value='<?php echo $row['Menu_Type']; ?>' disabled>

                        <label for="menu_price">Menu Price</label>
                        <input type="number" name="fmenuprice" value='<?php echo $row['Menu_Price']; ?>' disabled>
						
						<label for="menu_picture">Menu Picture</label>
						<!-- Display the current image -->
						<?php if ($row['Menu_Picture']): ?>
							<img src="<?php echo htmlspecialchars($row['Menu_Picture'], ENT_QUOTES, 'UTF-8'); ?>" alt="Menu Image" width="100">
						<?php else: ?>
							<p>No image available.</p>
						<?php endif; ?>
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
