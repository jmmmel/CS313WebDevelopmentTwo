
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title></title></head>
<body>
    <?php
    $openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $host="";
    $port=0;
    $socket="";
    $user="";
    $password="";
    $dbname="";
    if ($openShiftVar === null || $openShiftVar == "")
    {
        include("localUser.php");
    }
    else
    {
        // In the openshift environment
        $host= getenv('OPENSHIFT_MYSQL_DB_HOST');
        $port= getenv('OPENSHIFT_MYSQL_DB_PORT');
        $user= getenv('OPENSHIFT_MYSQL_DB_USERNAME');
        $password= getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
        $dbname = 'php';
        // …
    } 
    echo "<div>host: '$host' user: '$user' db: '$dbname'</div>";
    $con = new PDO("mysql:host=$host:$port;dbname=$dbname", $user, $password)
        or die ('Could not connect to the database server');

    $fileString = file_get_contents("./AllCards.json");
    $card_json = json_decode($fileString, true);
    
    echo "<div>host: $host user: $user db: $dbname</div>";
    foreach ($card_json as $card)
    {
        $query = "INSERT INTO `php`.`card` (`Name`, `ConvertedManaCost`, `Cost`, `Type`, `RulesText`)"; 
        $query = $query."VALUES ('".$card['name']."', ";
        if (isset($card['cmc']) && !empty($card['cmc'])){
            $query = "'".$query.$card['cmc']."', '".$card['manaCost']."', '";
        }
        else
        {
            $query = $query." null, null, '";
        }
        
        if (isset($card['text']) && !empty($card['text'])){
            $query = $query.$card['type']."', '".$card['text']."')";
        }
        else
        {
            $query = $query.$card['type']."', 'null')";
        }
        echo "<div>$query</div>";
        $stmt = $con->exec($query);
        echo "<div>$stmt</div>";
        
    }
    
    
    ?>

</body>
</html>

