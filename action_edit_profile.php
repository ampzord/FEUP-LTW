<?php
include_once('includes/init.php');
include_once('database/users.php');
checkValidSession();

$userInfo = getUserInformation();

//check current Password
if(!password_verify($_POST['password'], $userInfo['passwordHash'])) {
    header('Location: view_profile.php');
}

//FULLNAME
$fullName = $userInfo['fullName'];
if (validFullName($_POST['fullname']))
  $fullName = $_POST['fullname'];

//EMAIL
$email = $userInfo['email'];
if ($_POST['email'] !== '')
  $email = $_POST['email'];

//COUNTRY
$country = $userInfo['country'];
if ($_POST['country'] !== '')
  $country = $_POST['country'];

//BIRTHDATE
$birthDate = $userInfo['birthDate'];
if ($_POST['birth-date'] !== '')
  $birthDate = $_POST['birth-date'];

//PHONENUMBER
$phoneNumber = $userInfo['phoneNumber'];
if (validPhoneNumber($_POST['phone-number']))
  $phoneNumber = $_POST['phone-number'];

$username = $_SESSION['username'];

//update Profile
updateProfile($email, $country, $fullName, $phoneNumber, $birthDate, $username);

//Update password
if ($_POST['new-password'] !== '')
    if ($_POST['new-password'] === $_POST['new-password-repeat'])
        updatePassword($username, $_POST['new-password']);

header('Location: view_profile.php');
