<?php
session_start();
require('connect.php');
require('LineLogin.php');

if (isset($_SESSION['profile'])) {
    $profile = $_SESSION['profile'];

    $chkUser = $mysql->query("SELECT * FROM `Customer` WHERE `UserID`='$profile->sub'");
    $mysql->query("UPDATE `customer` SET `Picture`='$profile->picture' WHERE `UserID`='$profile->sub'");
    $chkUserNum = $chkUser->num_rows;
    if ($chkUserNum > 0) {
        while ($row = $chkUser->fetch_assoc()) {
            $Name = $row['Name'];
            $Surname = $row['Surname'];
            $CustomerID = $row['CustomerID'];
            $Role = $row['Role'];
            $Salary = $row['Salary'];
            $OT = $row['OT'];
        }
        require('profile.php');
    } else {
        require('not-found.html');
    }

    // echo '<p>User ID: ', $profile->sub, '</p>';
    // echo '<p>Name: ', $profile->name, '</p>';
    // echo '<p>Email: ', $profile->email, '</p>';
} else {
    $line = new LineLogin();
    $link = $line->getLink();
    echo '
    <div>
        <a href="', $link, '"><img src="11111.png" style="display: block;margin-top: 100px;margin-left: auto;margin-right: auto;"/></a>
    </div>
    ';
}
