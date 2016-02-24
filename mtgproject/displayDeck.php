
<?php
session_start();
if (session_status() == PHP_SESSION_NONE || !isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == 'false') {
    header('Location: ./Login.php');
}
include("database.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])){
        if ($_POST['action'] == "delete_card"){
            $query = 'DELETE FROM deckcontents
                      WHERE DeckId = :deck_id AND CardId = :card_id';
            $statement = $db->prepare($query);
            $statement->bindValue(':deck_id', $_POST['deck_id']);
            $statement->bindValue(':card_id', $_POST['card_id']);
            $statement->execute();
            $statement->closeCursor();
        }
        if ($_POST['action'] == "add_card"){
            $query = "INSERT INTO deckcontents (DeckId, CardId, Count)
                      VALUES (:deck_id
                      , (SELECT c.CardId
                         FROM card c
                         WHERE c.Name=:card_name)
                      , :count)";
            $statement = $db->prepare($query);
            $statement->bindValue(':deck_id', $_POST['deck_id']);
            $statement->bindValue(':card_name', $_POST['card_name']);
            $statement->bindValue(':count', $_POST['card_count']);
            $statement->execute();
            $statement->closeCursor();
        }
    }
}
$query = 'SELECT d.DeckName, d.DeckNotes
          FROM deck d INNER JOIN user u ON d.UserId = u.UserId
          WHERE u.UserId = :loggedInUserId 
          AND d.DeckId=:deck_id';
$statement = $db->prepare($query);
#There will be a login step later.
$statement->bindValue(':loggedInUserId', 1);
$statement->bindValue(':deck_id', $_POST['deck_id']);
$statement->execute();
$deckList = $statement->fetch();
$statement->closeCursor();
$query = 'SELECT c.CardId, c.Name, c.ConvertedManaCost as Cmc, c.Cost, c.Type, c.RulesText as Rules, dc.Count
          FROM card c 
          INNER JOIN deckcontents dc ON c.CardId = dc.CardId
          INNER JOIN deck d ON dc.DeckId = d.DeckId
          INNER JOIN user u ON u.UserId = d.UserId
          WHERE u.UserId = :loggedInUserId 
          AND d.DeckId=:deck_id';
$statement = $db->prepare($query);
$statement->bindValue(':loggedInUserId', $_SESSION['loggedUser']);
$statement->bindValue(':deck_id', $_POST['deck_id']);
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
                    <div class="col-lg-12">
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <h1>Deck Details</h1>
                    <div class="col-lg-12">
                        <div class="panel panel-default col-lg-8">
                            <div class="panel-heading col-lg-12 "><?php echo $deckList['DeckName'];?></div>
                            <div class="panel-body col-lg-12">
                                <?php 
                                foreach ($cardsInDeck as $card)
                                {
                                    echo "<div class='panel panel-default  col-lg-12 col-md-12 col-xs-12 card-details'>";
                                    ?>
                                    <form action="displayDeck.php" method="post">
                                        <input type="hidden" name="action" value="delete_card">
                                        <?php
                                        echo "<input type='hidden' name='card_id' value='".$card['CardId']."' />";
                                        echo "<input type='hidden' name='deck_id' value='".$_POST['deck_id']."' />";
                                        ?>
                                        <button type="submit"><i class="fa fa-close"></i></button>
                                    </form>
                                    <?php
                                    echo "<div class='col-lg-12 card-details'><span class='left-label'>Name:</span>".$card['Name']." x ".$card['Count']."</div>"; 
                                    echo "<div class='col-lg-12 card-details'><span class='left-label'>Mana Cost:</span>".$card['Cost']."</div>"; 
                                    echo "<div class='col-lg-12 card-details'><span class='left-label'>Type:</span>".$card['Type']."</div>"; 
                                    echo "<div class='col-lg-12 card-details'><span class='left-label'>Rules:</span>".$card['Rules']."</div>"; 
                                    echo "</div>";
                                }
                                ?>
                            </div>
                            <div class="panel-footer">
                                <form action="displayDeck.php" method="post">
                                    <input type="hidden" name="action" value="add_card"/>
                                <?php
                                    echo "<input type='hidden' name='deck_id' value=".$_POST['deck_id']."/>";
                                ?>
                                    <div>
                                        <label>Card Name:</label>
                                        <input type="text" name="card_name"/>
                                        <label>Quantity:</label>
                                        <input type="number" name="card_count">
                                        <button class="btn btn-default" type="submit" value="Add Card">Add Card</button>
                                    </div>

                                </form>
                            </div>
                            <div>
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
