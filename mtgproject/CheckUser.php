<?php    
session_start();
include("database.php");
$query = 'SELECT UserId
          FROM user
          WHERE UserName=:user and UserPass=:password';
$statement = $db->prepare($query);
$statement->bindValue(':user', $_POST['user']);
$statement->bindValue(':password', $_POST['password']);
$statement->execute();
$user = $statement->fetch();
$statement->closeCursor();

if(isset($user['UserId'])){
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