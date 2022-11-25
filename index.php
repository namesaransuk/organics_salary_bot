<?php
session_start();
require ('connect.php');
require ('LineLogin.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LINE";
$mysql = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($mysql, "utf8");

if (isset($_SESSION['profile'])) {
    $profile = $_SESSION['profile'];
    echo '<img src="', $profile->picture, '/large">';

    $chkUser = $mysql->query("SELECT * FROM `Customer` WHERE `UserID`='$profile->sub'");
    $chkUserNum = $chkUser->num_rows;
    if ($chkUserNum > 0) {
        while ($row = $chkUser->fetch_assoc()) {
            $Name = $row['Name'];
            $Surname = $row['Surname'];
            $CustomerID = $row['CustomerID'];
        }
        echo '<a href="', $link, '">คลิกเพื่อดูสลิปเงินเดือน ' . $Name . '</a>';
    } else {
        echo '<a href="', $link, '">ไม่มี</a>';
    }

    echo '<p>User ID: ', $profile->sub, '</p>';
    echo '<p>Name: ', $profile->name, '</p>';
    echo '<p>Email: ', $profile->email, '</p>';
    echo '<a href="logout.php">Logout</a>';
} else {
    $line = new LineLogin();
    $link = $line->getLink();
    echo '<a href="', $link, '">Login</a>';
}
