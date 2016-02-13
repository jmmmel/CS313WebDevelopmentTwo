<?php
session_start();
if (session_status() == PHP_SESSION_NONE || !isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == 'false') {
    header('Location: ./Login.php');
}

include("database.php");
$query = 'SELECT c.Name, c.ConvertedManaCost as Cmc, c.Cost, c.Type, c.RulesText as Rules
          FROM card c';
$statement = $db->prepare($query);
$statement->execute();
$cardsInDeck = $statement->fetchAll();
$statement->closeCursor();
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
    <script>
        function routeToDeck(deckId) {
            document.getElementById("deck-details").value = deckId;
            document.getElementById("find-deck-form").submit();
        }
    </script>
</head>

<body>

<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="index.php">Magic Database
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
                    echo "<a href='Login.php'>Logout</a>";
                }
                else
                {
                    echo "<a href='Login.php'>Login</a>";
                }
                ?>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12"><a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></a></div>
                <h1>Cards in System</h1>
                    <div class="deck-display col-lg-4 col-md-6 col-xs-12">
                        <?php 
                        foreach ($cardsInDeck as $card)
                        {
                            echo "<div class='panel panel-default  col-lg-12 col-md-12 col-xs-12 card-details'>";
                            echo "<div class='col-lg-12 card-details'><span class='left-label'>Name:</span>".$card['Name']."</div>"; 
                            echo "<div class='col-lg-12 card-details'><span class='left-label'>Mana Cost:</span>".$card['Cost']."</div>"; 
                            echo "<div class='col-lg-12 card-details'><span class='left-label'>Type:</span>".$card['Type']."</div>"; 
                            echo "<div class='col-lg-12 card-details'><span class='left-label'>Rules:</span>".$card['Rules']."</div>"; 
                            echo "</div>";
                        }
                        ?>
                        <input id="deck-details" type="hidden" name="deck_id" value="" />
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
