<?php

    header("Content-type: text/html; charset=\"utf-8\"");   
    $previsionTiempo ="";
    $error ="";
    $ciudad = str_replace(' ','',$_GET['ciudad']); //quita los espacios
        $file = "https://es.weather-forecast.com/locations/".$ciudad."/forecasts/latest";
        $file_headers = @get_headers($file);
        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $error = "No hemos podido encontrar esa ciudad";
        }
        else {
            $paginaForecast = file_get_contents($file);
            $array1 = explode('1 - 3 Días:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $paginaForecast);
                if(sizeof($array1)> 1)
                {
                    $array2 = explode('</span></span></span></p><div class="forecast-cont"><div class="units-cont">',$array1[1]);
                    if(sizeof($array2)> 1) {
                        $previsionTiempo = $array2[0];
                    }
                    else
                    {
                        $error = "No hemos podido encontrar esa ciudad";
                    }
                }
                else
                {
                    $error = "No hemos podido encontrar esa ciudad";
                }
            
           

            
        }
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>¿Qué tiempo hace?</title>
    <style type="text/css">
        html{
            background: url(background.png) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body{
            background: none;
        }

        .container{
            text-align: center;
            margin-top: 150px;
            width: 450px;
        }

        input{
            margin: 20px 0;
        }

        #previsionTiempo{
            margin-top: 30px;
        }
    
    </style>
  </head>
  <body>
    <div class="container">
        <h1>¿Qué tiempo hace?</h1>
        <form>
            <div class="form-group">
                <label for="ciudad">Intruduzca el nombre de una ciudad:</label>
                <input type="text" name="ciudad" class="form-control" id="ciudad" placeholder="Por ej. Londres, Tokyo">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        <div id="previsionTiempo">
            <?php    
                if($previsionTiempo){
                    echo '<div class="alert alert-primary" role="alert">'.$previsionTiempo.'</div>';
                }
                else if($error != ""){
                    echo    '<div class="alert alert-danger" role="alert">'.$error.'</div>';
                }
            ?>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>