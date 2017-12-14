<?php
include_once('includes/init.php');
include_once('database/users.php');
checkValidSession();

global $purifier;

$_POST['username'] = $purifier->purify($_POST['username']);
$_POST["password"] = $purifier->purify($_POST["password"]);
$_POST['fullname'] = $purifier->purify($_POST['fullname']);
$_POST["email"] = $purifier->purify($_POST["email"]);
$_POST['country'] = $purifier->purify($_POST['country']);
$_POST["birth-date"] = $purifier->purify($_POST["birth-date"]);
$_POST["phone-number"] = $purifier->purify($_POST["phone-number"]);
$_POST["new-password"] = $purifier->purify($_POST["new-password"]);
$_POST["new-password-repeat"] = $purifier->purify($_POST["new-password-repeat"]);

if ($_SESSION['csrf'] !== $_POST['csrf']) {
  header('Location: edit_profile.php');
  die;
}

$userInfo = getUserInformation();

//check current Password
if(!password_verify($_POST['password'], $userInfo['passwordHash'])) {
    header('Location: view_profile.php');
}

//FULLNAME
$fullName = $userInfo['fullName'];
if (validFullName($_POST['fullname']))
    $fullName = $_POST['fullname'];
else
    header('Location: edit_profile.php?erro=fullName');

//EMAIL
$email = $userInfo['email'];
if ($_POST['email'] !== '' && eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email']))
  $email = $_POST['email'];
else
  header('Location: edit_profile.php?erro=email');

//COUNTRY
$country = $userInfo['country'];
if ($_POST['country'] !== '')
  $country = $_POST['country'];
else
  header('Location: edit_profile.php?erro=country');

//BIRTHDATE
$birthDate = $userInfo['birthDate'];
if ($_POST['birth-date'] !== '')
  $birthDate = $_POST['birth-date'];
else
  header('Location: edit_profile.php?erro=birthDate');

//PHONENUMBER
$phoneNumber = $userInfo['phoneNumber'];
if (validPhoneNumber($_POST['phone-number']))
  $phoneNumber = $_POST['phone-number'];
else
  header('Location: edit_profile.php?erro=phoneNumber');

$username = $_SESSION['username'];

//update Profile
updateProfile($email, $country, $fullName, $phoneNumber, $birthDate, $username);

//Update password
if ($_POST['new-password'] !== '')
    if ($_POST['new-password'] === $_POST['new-password-repeat'])
        updatePassword($username, $_POST['new-password']);
    else
        header('Location: edit_profile.php?erro=passwordMatch');

header('Location: edit_profile.php?success=1');
