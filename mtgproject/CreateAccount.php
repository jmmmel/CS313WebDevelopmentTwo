<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Magic Database</title>

    <link href="./css/index.css" rel="stylesheet" />
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="index.php">
                        Magic Database
                    </a>
                </li>
                <li>
                    <a href="cardList.php">Card Database</a>
                </li>
                <li>
                    <a href="index.php">Decks</a>
                </li>
                <li>
                    <?php
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'){
                        echo "<a href='#'>Logout</a>";
                    }
                    else
                    {
                        echo "<a href='#'>Login</a>";
                    }
                    ?>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">

                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4">
                            <h1 class="text-center login-title">Create Account</h1>
                            <div class="account-wall">
                                <?php
                                if(isset($_SESSION['alreadyUsed']) && $_SESSION['alreadyUsed'] == 'true'){
                                    echo "<div class='has-error'>Username is already taken</div>";
                                }
                                ?>                                
                                <form class="form-signin" method="post" action="AddAccount.php">
                                    <input type="text" class="form-control" name="user" placeholder="Username" required autofocus>
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                                        Create Account
                                    </button>                                    
                                </form>
                            </div>
                            <a href="Login.php" class="text-center new-account">Go back to signin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>
