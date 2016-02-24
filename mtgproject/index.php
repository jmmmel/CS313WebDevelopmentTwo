<?php
session_start();
if (session_status() == PHP_SESSION_NONE || !isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == 'false') {
    header('Location: ./Login.php');
}
include("database.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])){
        if ($_POST['action'] == "delete_deck"){
            $query = 'DELETE FROM deckcontents
                      WHERE DeckId = :deck_id';
            $statement = $db->prepare($query);
            $statement->bindValue(':deck_id', $_POST['deck_id']);
            $statement->execute();
            $statement->closeCursor();
            $query = 'DELETE FROM deck
                      WHERE DeckId = :deck_id';
            $statement = $db->prepare($query);
            $statement->bindValue(':deck_id', $_POST['deck_id']);
            $statement->execute();
            $statement->closeCursor();
        }
        if ($_POST['action'] == "add_deck"){
            $query = "INSERT INTO deck (DeckName, DeckNotes, UserId)
                      VALUES (:deck_name, :deck_notes, :user_id)";
            $statement = $db->prepare($query);
            $statement->bindValue(':deck_name', $_POST['deck-name']);
            $statement->bindValue(':deck_notes', $_POST['deck-notes']);
            $statement->bindValue(':user_id', $_SESSION['loggedUser']);
            $statement->execute();
            $statement->closeCursor();
        }
    }
}
$query = 'SELECT d.DeckId, d.DeckName, d.DeckNotes
          FROM deck d INNER JOIN user u ON d.UserId = u.UserId
          WHERE u.UserId = :loggedInUserId';
$statement = $db->prepare($query);
$statement->bindValue(':loggedInUserId', $_SESSION['loggedUser']);
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
    <style>
        .right{
            text-align: right;
            margin-right: 0px;
            margin-left: auto;
        }
    </style>
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
                    <h1>Deck Collection</h1>
                    <form id="find-deck-form" action="displayDeck.php" method="post">

                        <div class="deck-display col-lg-12 notes">
                            <?php foreach ($deckList as $deck){
                                      echo "<div class='btn col-lg-5 col-md-6 col-xs-12 panel panel-default' onclick='routeToDeck(".$deck['DeckId'].")'>";
                                      echo "<div class='panel-heading col-lg-12 notes'>";
                                      echo "<form action='.' method='post' id='delete-deck-form'>";
                                      echo "<input type='hidden' name='action' value='delete_deck'/>";
                                      echo "<input type='hidden' name='deck_id' value='".$deck['DeckId']."'/>";
                                      echo "<button type=\"submit\"><i class=\"fa fa-close\"></i></button>";
                                      echo "</form>";
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
                    <form id="add-new-deck-form" action="." method="post">
                        <input type="hidden" name="action" value="add_deck"/>
                        <div class="col-lg-5 col-md-6 col-xs-12 panel panel-default">
                            <div class="panel-body">
                                <div class="col-lg-12"><label class="left-label">Deck Name: </label><input class="right" type="text" name="deck-name"/></div>
                                <div class="col-lg-12"><label class="left-label">Notes: </label><input class="right" type="text" name="deck-notes"></div>
                                <button type="submit" value="Add Deck">Add Deck</button>
                            </div>
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
