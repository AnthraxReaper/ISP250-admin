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

		.form-container select {
			width: 100%; /* Match other input fields */
			padding: 10px;
			margin-bottom: 10px;
			border: 1px solid #ccc;
			font-size: 14px;
			background-color: #fff;
			color: #000;
			border-radius: 0;
			appearance: none; /* Removes native styling for consistency */
		}

		/* Dropdown arrow styling for consistent look */
		.form-container select::-ms-expand {
			display: none; /* Remove default arrow for IE/Edge */
		}

		.form-container select {
			background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10"%3E%3Cpath fill="%23000" d="M0 0l5 5 5-5z"/%3E%3C/svg%3E');
			background-repeat: no-repeat;
			background-position: right 10px center;
			background-size: 10px;
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
            <div class="header">Add Menu</div>
            <div class="content">
                <!-- Form for Adding Menu -->
                <div class="form-container">
                    <form name="menu" method="post" action="menuadd.php" enctype="multipart/form-data">

                        <label for="menu_name">Menu Name</label>
                        <input type="text" id="menu_name" name="fmenuname" placeholder="Enter Menu Name" required>

                        <label for="menu_type">Menu Type</label>
                        <select type="text" id="menu_type" name="fmenutype" placeholder="Enter Menu Type" required>
                            <option value="Mains">Mains</option>
                            <option value="Burger">Burger</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Pizza">Pizza</option>
                        </select>
						
                        <label for="menu_price">Menu Price</label>
                        <input type="number" id="menu_price" name="fmenuprice" placeholder="Enter Menu Price" required>
						
						<label for="menu_picture">Menu Picture</label>
						<input type="file" id="menu_picture" name="fmenupicture" placeholder="Enter Menu Picture" accept="image/*" required>
						
                        <div class="button-group">
                            <button type="submit" class="add-btn">Add</button>
                            <button type="reset" class="reset-btn">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
