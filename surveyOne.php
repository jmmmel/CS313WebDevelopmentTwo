<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    var_dump($_SESSION);
    if(isset($_SESSION['voted']) && !empty($_SESSION['voted'])) {
        if ($_SESSION['voted'] == 'true'){
            header( 'Location: ./survey.php' ) ;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function validateForm() {
            var isValid = false;
            var radios = document.getElementsByName("survey-one");

            for (var i = 0, len = radios.length; i < len; i++) {
                if (radios[i].checked) {
                    isValid = true;
                }
            }
            if (isValid) {
                isValid = false;

                radios = document.getElementsByName("survey-two");

                for (var i = 0, len = radios.length; i < len; i++) {
                    if (radios[i].checked) {
                        isValid = true;
                    }
                }
            }
            if (isValid) {
                isValid = false;

                radios = document.getElementsByName("survey-three");

                for (var i = 0, len = radios.length; i < len; i++) {
                    if (radios[i].checked) {
                        isValid = true;
                    }
                }
            }
            if (isValid) {
                isValid = false;

                radios = document.getElementsByName("survey-four");

                for (var i = 0, len = radios.length; i < len; i++) {
                    if (radios[i].checked) {
                        isValid = true;
                    }
                }
            }

            if (!isValid) {
                alert("All groups need a selection");
                return false;
            }

            return true;
        }
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Survey</title>
    <script src="jquery/jquery-2.2.0.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="myCss.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->

</head>
<body>
    <div class="header">
        <div><a href="Ideas.html">Back to Projects</a></div>
        <div class="row">

            <div class="panel panel-default col-lg-5">
                <form onsubmit="return validateForm()" action="survey.php" method="post">
                    <div class="panel-heading">
                        <h1>Php Survey</h1>
                    </div>
                    <div class="panel-body">
                        <div class="text-left col-sm-12 panel-title">Favorite Taco:</div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-one" value="0" name="survey-one" /> <span>Spicy</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-one" value="1" name="survey-one" /> <span>Fish</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-one" value="2" name="survey-one" /> <span>Normal</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-one" value="3" name="survey-one" /> <span>Kitchen Sink</span>
                        </div>

                        <div class="text-left col-sm-12 panel-title">Favorite Marvel Character:</div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-two" value="0" name="survey-two" /> <span>Thor</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-two" value="1" name="survey-two" /> <span>Spider-Man</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-two" value="2" name="survey-two" /> <span>Wolverine</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-two" value="3" name="survey-two" /> <span>Punisher</span>
                        </div>
                        
                        <div class="text-left col-sm-12 panel-title">Favorite Marvel Group:</div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-three" value="0" name="survey-three" /> <span>X-Men</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-three" value="1" name="survey-three" /> <span>Avengers</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-three" value="2" name="survey-three" /> <span>Guardians of the Galaxy</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-three" value="3" name="survey-three" /> <span>Fantastic Four</span>
                        </div>

                        <div class="text-left col-sm-12 panel-title">Favorite DC Group:</div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-four" value="0" name="survey-four" /> <span>Justice League of America</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-four" value="1" name="survey-four" /> <span>Green Lantern Corps</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-four" value="2" name="survey-four" /> <span>Teen Titans</span>
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" id="survey-four" value="3" name="survey-four" /> <span>Suicide Squad</span>
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button class="btn-default" type="submit">Submit</button>
                    </div>
                </form>
                <a href="survey.php">See Result</a>
            </div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">

    </script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>