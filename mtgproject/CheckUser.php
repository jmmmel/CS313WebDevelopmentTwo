<?php    
session_start();
include("password.php");
include("database.php");
$query = 'SELECT UserId, UserName, UserPass
          FROM user
          WHERE UserName=:user';
$statement = $db->prepare($query);
$statement->bindValue(':user', $_POST['user']);
$statement->execute();
$user = $statement->fetch();
$statement->closeCursor();


if(isset($user['UserPass']) && password_verify($_POST['password'],$user['UserPass'])){
    $_SESSION['loggedin'] = 'true';
    $_SESSION['failed'] = 'false';
    $_SESSION['loggedUser'] = $user['UserId'];
    header('Location: ./index.php');
}
else
{
    $_SESSION['loggedin'] = 'false';
    $_SESSION['failed'] = 'true';
    header('Location: ./Login.php');
}
?>