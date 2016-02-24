<?php    
session_start();
include("database.php");
include("password.php");
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
    header('Location: ./CreateAccount.php');
}
else
{
    $_SESSION['alreadyUsed'] = 'false';
    $_SESSION['failed'] = 'false';
    $hashPassword = password_hash($_POST['password']);
    $query = 'INSERT INTO user (UserName, UserPass)
              VALUES (:user, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $_POST['user']);
    $statement->bindValue(':password', $hash);
    $statement->execute();
    $statement->closeCursor();
    header('Location: ./Login.php');
}
?>