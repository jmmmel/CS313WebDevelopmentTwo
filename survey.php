<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['voted'] = 'true';
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
mb_internal_encoding('UTF-8');
$myfile = fopen("results.txt", "r");
$resultsString = fread($myfile, filesize("results.txt"));
$resultsArray = array_map('intval', explode( ',', $resultsString));
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $answerOne = 1 + $_POST['survey-one'];
    $answerTwo = 5 + $_POST['survey-two'];
    $answerThree = 9 + $_POST['survey-three'];
    $answerFour = 13 + $_POST['survey-four'];

    $resultsArray[0] += 1;
    $resultsArray[$answerOne] += 1;
    $resultsArray[$answerTwo] += 1;
    $resultsArray[$answerThree] += 1;
    $resultsArray[$answerFour] += 1;
    $resultsString = implode(',', $resultsArray);

    file_put_contents('results.txt', $resultsString);
}
?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <script src="jquery/jquery-2.2.0.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <title>Survey Results</title>
</head>
<body>
    <div class="row">
        <div>
            <?php if ($_SESSION['voted'] == 'true')
                  { ?>
                    <a href="Ideas.html">Go Back</a>
                  	<div class="alert alert-danger">You have already voted</div>
             <?php } else
                  {?>
                    <a href="surveyOne.php">Go Back</a>
                <?php } ?>
        </div>
        <div class="panel panel-default col-lg-5">
            <div class="panel-body">
                <h3>Favorite Taco:</h3>
                <div>Spicy</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
                <?php echo "aria-valuenow='$resultsArray[1]'"; ?>
                aria-valuemin="0"
                <?php echo "aria-valuemax='$resultsArray[0]'";
                      $percent = ($resultsArray[1]/$resultsArray[0]) * 100;
                      echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Fish</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[2]'"; ?>
            aria-valuemin="0"
           <?php echo "aria-valuemax='$resultsArray[0]'";
                 $percent = ($resultsArray[2]/$resultsArray[0]) * 100;
                 echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Normal</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[3]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[3]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Kitchen Sink</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[4]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[4]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <h3>Favorite Marvel Character:</h3>
                <div>Thor</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[5]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[5]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Spider-Man</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[6]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[6]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Wolverine</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[7]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[7]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Punisher</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[8]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[8]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <h3>Favorite Marvel Group:</h3>
                <div>X-Men</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[9]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[9]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Avengers</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[10]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[10]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Guardians of the Galaxy</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[11]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[11]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Fantastic Four</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[12]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[12]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <h3>Favorite DC Group:</h3>
                <div>Justice League of America</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[13]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[13]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Green Lantern Corps</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[14]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[14]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Teen Titans</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[15]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[15]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
                <div>Suicide Squad</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" 
            <?php echo "aria-valuenow='$resultsArray[16]'"; ?>
            aria-valuemin="0"
            <?php echo "aria-valuemax='$resultsArray[0]'";
                  $percent = ($resultsArray[16]/$resultsArray[0]) * 100;
                  echo "style='width: $percent%'"; ?>>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">      
    </script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
