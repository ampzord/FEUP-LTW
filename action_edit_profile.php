<?php
include_once('includes/init.php');
include_once('database/users.php');
checkValidSession();

$userInfo = getUserInformation();

//check current Password
if(!password_verify($_POST['password'], $userInfo['passwordHash'])) {
    header('Location: edit_profile.php?erro=passwordBad');
    die;
}

//FULLNAME
$fullName = $userInfo['fullName'];
if (validFullName($_POST['fullname']))
    $fullName = $_POST['fullname'];
else{
    header('Location: edit_profile.php?erro=fullName');
    die;
}

//EMAIL
$email = $userInfo['email'];
if ($_POST['email'] !== '' && eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email']))
  $email = $_POST['email'];
else{
    header('Location: edit_profile.php?erro=email');
    die;
}

//COUNTRY
$country = $userInfo['country'];
if ($_POST['country'] !== '')
  $country = $_POST['country'];
else{
    header('Location: edit_profile.php?erro=country');
    die;
}

//BIRTHDATE
$birthDate = $userInfo['birthDate'];
if ($_POST['birth-date'] !== '')
  $birthDate = $_POST['birth-date'];
else{
    header('Location: edit_profile.php?erro=birthDate');
    die;
}

//PHONENUMBER
$phoneNumber = $userInfo['phoneNumber'];
if (validPhoneNumber($_POST['phone-number']))
  $phoneNumber = $_POST['phone-number'];
  else{
    header('Location: edit_profile.php?erro=phoneNumber');
    die;
}

$username = $_SESSION['username'];

//update Profile
updateProfile($email, $country, $fullName, $phoneNumber, $birthDate, $username);

//Update password
if ($_POST['new-password'] !== '')
    if ($_POST['new-password'] === $_POST['new-password-repeat'])
        updatePassword($username, $_POST['new-password']);
    else{
        header('Location: edit_profile.php?erro=passwordMatch');
        die;
    }

header('Location: edit_profile.php?success=1');
