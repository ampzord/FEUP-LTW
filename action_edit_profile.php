<?php
include_once('includes/init.php');
include_once('database/users.php');

checkValidSession();

$userInfo = getUserInformation()

echo preg_match('/./', $k);
die;

//check current Password
if(!password_verify($_POST['password'], $userInfo['passwordHash'])){
    header('Location: view_profile.php');
    die();
}

//FULLNAME
$fullName = $userInfo['fullName'];
  if (validFullName($_POST['fullname']))
    $fullName = $_POST['fullname'];
}

//TODO needs regex
//EMAIl
if ($_POST['email'] !== '')
  $email = $_POST['email'];
else
  $email = getUserEmail($email);

//COUNTRY
if ($_POST['country'] !== '')
  $country = $_POST['country'];
else
  $country = getUserCountry();

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
