<?php
include_once('includes/init.php');
include_once('database/users.php');

//Check if session is set
if (!isset($_SESSION['username'])) {
  header('Location: index.php');
  die();
}

//var_dump($_POST);
//die;

$username = $_SESSION['username'];

//check current Password
/*$pass = getUserPassword($username);
if(!password_verify($_POST['password'], $pass)){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die();
}*/


//FULLNAME
//$fullName = null;
//if ($_POST['fullname'] !== '') {
$fullName = $_POST['fullname'];
  //if (!validFullName($username))
    //$fullName = getUserFullName($username);
//}
//else
  //$fullName = getUserFullName($username);

//EMAIl
$email = $_POST['email'];

//COUNTRY
$country = $_POST['country'];

//BIRTHDATE
//$birthDate = $_POST['birth-date'];

//update Profile
updateProfile($email, $country, $fullName, $username);

//Update password
if ($_POST['new-password'] !== '')
    if ($_POST['new-password'] === $_POST['new-password-repeat'])
        updatePassword($username, $_POST['new-password']);

header('Location: interface.php');
