<?php
session_start();
require_once('LineLogin.php');

if (isset($_SESSION['profile'])) {
    $profile = $_SESSION['profile'];
    echo '<img src="', $profile->picture, '/large">';
    echo '<p>Name: ', $profile->name, '</p>';
    echo '<p>Email: ', $profile->email, '</p>';
    echo '<a href="logout.php">Logout</a>';
} else {
    $line = new LineLogin();
    $link = $line->getLink();
    echo '<a href="', $link, '">Login</a>';
}