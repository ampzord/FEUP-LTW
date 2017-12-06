<?php
include_once('includes/init.php');
include_once('database/users.php');

//Check if session is set
if (!isset($_SESSION['username'])) {
  header('Location: index.php');
  die();
}

/*
id INTEGER PRIMARY KEY,
username TEXT UNIQUE,
email TEXT UNIQUE,
phoneNumber INTEGER UNIQUE,
country TEXT UNIQUE,                 SIM
timeZone INTEGER, --UTC Offset ????????????????
fullName TEXT,
birthDate DATE,                       ?
passwordHash TEXT NOT NULL          SIM
*/


$fullName = $_POST['full-name'];
$email = $_POST['email'];
$phoneNumber = $_POST['phone-number'];
$birthDate = $_POST['birth-date'];
$country = $_POST['country'];
updateProfile($fullName, $email, $phoneNumber, $birthDate, $country) {

}

//Update password
if ($_POST['new-password'] !== '') {
    if ($_POST['new-password'] === $_POST['new-password-repeat'])
        changePassword($username, $_POST['new-password']);




?>
