<?php    
session_start();
include("database.php");
$query = 'SELECT UserId
          FROM user
          WHERE UserName=:user';
$statement = $db->prepare($query);
$statement->bindValue(':user', $_POST['user']);
$statement->execute();
$user = $statement->fetch();
$statement->closeCursor();

if(isset($user['UserId'])){
    $_SESSION['alreadyUsed'] = 'true';
    var_dump($_SESSION);
    header('Location: ./CreateAccount.php');
}
else
{
    $_SESSION['alreadyUsed'] = 'false';
    $_SESSION['failed'] = 'false';
    $query = 'INSERT INTO user (UserName, UserPass)
              VALUES (:user, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $_POST['user']);
    $statement->bindValue(':password', $_POST['password']);
    $statement->execute();
    $statement->closeCursor();
    var_dump($_SESSION);
    header('Location: ./Login.php');
}
?>