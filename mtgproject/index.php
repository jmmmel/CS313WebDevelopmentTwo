<?php
include("database.php");
$query = 'SELECT d.DeckId, d.DeckName, d.DeckNotes
          FROM deck d INNER JOIN user u ON d.UserId = u.UserId
          WHERE u.UserId = :loggedInUserId';
$statement = $db->prepare($query);
#There will be a login step later.
$statement->bindValue(':loggedInUserId', 1);
$statement->execute();
$deckList = $statement->fetchAll();
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
                    <a href="#">Login/Logout (Doesn't Work)</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="pull-left col-lg-12"><a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></a></div>
                    <form id="find-deck-form" action="displayDeck.php" method="post">
                        <div class="deck-display col-lg-12 notes">
                            <?php foreach ($deckList as $deck){
                                      echo "<div class='btn col-lg-3 col-xs-4 panel panel-default' onclick='routeToDeck(".$deck['DeckId'].")'>";
                                      echo "<div class='panel-heading col-lg-12 notes'>"; 
                                      echo $deck['DeckName'];
                                      echo "</div>";
                                      echo "<div class='panel-body col-lg-12'>";
                                      echo "<label>Notes:</label>";
                                      echo "<div class='notes col-lg-12'>".$deck['DeckNotes']."</div>";
                                      echo "</div>";
                                      echo "</div>";         
                                  }?>
                            <input id="deck-details" type="hidden" name="deck_id" value="" />
                        </div>
                    </form>
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
