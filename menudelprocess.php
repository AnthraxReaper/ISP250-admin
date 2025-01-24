<?php
$menuid = $_GET['fmenuid'];
$dbc = mysqli_connect ("localhost", "root", "", "restaurant");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "DELETE FROM menu where Menu_ID ='$menuid'";
$result = mysqli_query($dbc, $sql);
if($result)
{
mysqli_commit($dbc);
Print '<script>alert("Product Record Successfuly Deleted.");</script>';
Print '<script>window.location.assign("listmenu.php");</script>';
}
else
{
mysqli_rollback($dbc);
Print '<script>alert("Product Record is failed to be Deleted.");</script>';
Print '<script>window.location.assign("listmenu.php");</script>';
}
?>