<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Default username for phpMyAdmin
$password = ""; // Default password for phpMyAdmin
$database = "restaurant";

// Connect to database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message
$error = "";

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = $_POST['password'];
	
	// Validate password length
	if (strlen($password) < 8) {
		$error = "Password must be at least 8 characters long.";
	} elseif (strlen($password) > 10) {
		$error = "Password must be no more than 10 characters long.";
	} else {
        // Fetch admin data from database
        $stmt = $conn->prepare("SELECT Admin_Password FROM admin WHERE Admin_ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
			
            // Verify the entered password
        if ($password === $row['Admin_Password']) {
            // Successful login
            $_SESSION['admin'] = $id;
            header("Location: frmaddmenu.php"); // Redirect to add menu form
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid ID.";
    }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
	<style>
		body {
			margin: 0;
			font-family: Arial, sans-serif;
			background-color: #DDBA96; /* background */
		}

		.container {
			display: flex;
			height: 100vh;
			align-items: center;
			justify-content: center;
			background-color: #891010; /* Background for the main section */
		}

		.login-section {
			display: flex;
			background-color: #540909;
			padding: 30px;
			border-radius: 0px;
			box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
			align-items: center;
			justify-content: space-between;
			width: 100%;
		}

		.image {
			width: 175px;
			height: auto;
			border-radius: 10px;
			object-fit: cover;
		}

		.form-container {
			text-align: center;
			color: white;
			width: 300px;
		}

		.form-container h1 {
			font-size: 32px;
			margin-bottom: 10px;
		}

		.form-container p {
			font-size: 16px;
			margin-bottom: 30px;
			color: #C3C3C3; /* Slightly lighter text */
		}

		.form-container form {
			display: flex;
			flex-direction: column;
			gap: 15px;
		}

		.form-container input {
			padding: 10px;
			font-size: 14px;
			border: none;
			border-radius: 5px;
		}

		.form-container input[type="text"],
		.form-container input[type="password"] {
			background-color: #ffffff;
		}

		.form-container button {
			padding: 10px;
			font-size: 16px;
			font-weight: bold;
			color: white;
			background-color: #ff1b1b; /* button */
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		.form-container button:hover {
			background-color: #cc1515; /* on hover */
		}

		.error {
			color: #ff4d4d;
			margin-top: 10px;
		}

		/* Responsive styles */
		@media screen and (max-width: 768px) {
			.image {
				width: 100px; /* Reduce image width for smaller screens */
				height: auto; /* Maintain aspect ratio */
			}
		}

		@media screen and (max-width: 480px) {
			.image {
				width: 50px; /* Further reduce image size for very small screens */
				height: auto; /* Maintain aspect ratio */
			}
		}
	</style>
</head>
<body>
    <div class="container">
        <div class="login-section">
            <!-- Left Image -->
            <img src="pexels-elli-559179-1854652.jpg" alt="Cake" class="image">

            <!-- Form Section -->
            <div class="form-container">
                <h1>Admin Login</h1>
                <p>Enter required details to continue</p>
                <form action="" method="POST">
					<label for="id" align="left">ID</label>
					<input type="number" id="id" name="id" placeholder="Enter your ID" required>
					<label for="password" align="left">PASSWORD</label>
					<input type="password" id="password" name="password" placeholder="Enter your password" minlength="8" maxlength="10" required>
					<button type="submit">Login</button>
				</form>

                <?php if (!empty($error)): ?>
                    <div class="error"><?php echo $error; ?></div>
                <?php endif; ?>
            </div>

            <!-- Right Image -->
            <img src="pexels-chevanon-312418.jpg" alt="Coffee" class="image">
        </div>
    </div>
</body>
</html>