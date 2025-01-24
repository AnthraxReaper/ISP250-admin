<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail List</title>
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
                <li class="logout" onclick="window.location.href='start_page.php';">
                    Logout <span class="icon">🚪</span>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">Order Detail List</div>
            <div class="content">
                
                <!-- Order Detail Table -->
                <h3 align="center"><font color="#000000">Order Detail</font></h3>
                <table align="center" border="1">
                    <tr>
                        <th><font color="#FFFFFF">Order Detail ID</font></th>
                        <th><font color="#FFFFFF">Customer ID</font></th>
                        <th><font color="#FFFFFF">Menu ID</font></th>
                        <th><font color="#FFFFFF">Order ID</font></th>
                        <th><font color="#FFFFFF">Employee ID</font></th>
                        <th><font color="#FFFFFF">Cart Quantity</font></th>
                        <th><font color="#FFFFFF">Cart Price</font></th>
                    </tr>

                    <?php
    // Connection to the server and database
    $dbc = mysqli_connect("localhost", "root", "", "restaurant");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    // Get the search term and sanitize it
    $search = isset($_GET['search']) ? mysqli_real_escape_string($dbc, $_GET['search']) : '';

    // Prepare SQL query based on search term
    $sql = "SELECT * FROM orderdetail";
    if (!empty($search)) {
        $sql .= " WHERE OrderDetail_ID = '$search'"; // Search for exact match on OrderDetail_ID
    }

    // Execute the query
    $result = mysqli_query($dbc, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        // Display the results in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td><font color="#000000">' . $row['OrderDetail_ID'] . '</font></td>
                    <td><font color="#000000">' . $row['Cust_ID'] . '</font></td>
                    <td><font color="#000000">' . $row['Menu_ID'] . '</font></td>
                    <td><font color="#000000">' . $row['Order_ID'] . '</font></td>
                    <td><font color="#000000">' . $row['Employee_ID'] . '</font></td>
                    <td><font color="#000000">' . $row['Cart_Quantity'] . '</font></td>
                    <td><font color="#000000">' . $row['Cart_Price'] . '</font></td>
                  </tr>';
        }
    } else {
        echo '<tr><td colspan="7">No results found.</td></tr>';
    }

    // Close the database connection
    mysqli_close($dbc);
    ?>
                </table>
            </div>
        </div>
    </div>
</form>
</body>
</html>