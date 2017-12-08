<?php
include_once('includes/init.php');
include_once('database/users.php');

checkValidSession();

//var_dump($_POST);
//die;

$username = $_SESSION['username'];

//check current Password
$pass = getUserPassword($username);
if(!password_verify($_POST['password'], $pass)){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}

//FULLNAME
$fullName = null;
if ($_POST['fullname'] !== '') {
  $fullName = $_POST['fullname'];
  if (!validFullName($fullName))
    $fullName = getUserFullName($fullName);
}
else
  $fullName = getUserFullName($fullName);

//TODO needs regex
//EMAIl
$email = null;
if ($_POST['email'] !== '')
  $email = $_POST['email'];
else
  $email = getUserEmail($email);

//COUNTRY
$country = null;
if ($_POST['country'] !== '')
  $country = $_POST['country'];
else
  $country = getUserCountry($country);

//BIRTHDATE
$birthDate = null;
if ($_POST['birth-date'] !== '')
  $birthDate = $_POST['birth-date'];
else
  $birthDate = getUserBirthDate($birthDate);

//PHONENUMBER
$phoneNumber = null;
if ($_POST['phone-number'] !== '')
  $phoneNumber = $_POST['phone-number'];
  if (!validPhoneNumber($phoneNumber))
    $phoneNumber = getUserPhoneNumber($phoneNumber);
else
  $phoneNumber = getUserPhoneNumber($phoneNumber);

//update Profile
updateProfile($email, $country, $fullName, $phoneNumber, $birthDate, $username);

//Update password
if ($_POST['new-password'] !== '')
    if ($_POST['new-password'] === $_POST['new-password-repeat'])
        updatePassword($username, $_POST['new-password']);

header('Location: view_profile.php');
