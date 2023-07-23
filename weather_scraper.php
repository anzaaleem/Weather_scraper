<?php

$error="";
$weather="";

if(array_key_exists('city',$_GET)){
$city=str_replace(' ','',$_GET['city']);

$file_headers = @get_headers("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $error="That city could not be found";
}
else{

$foreCast= file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
$pageArray= explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">',$foreCast);


if(sizeof($pageArray)>1)
{
$secondPageArray= explode('</span></span></span>',$pageArray[1]);
if(sizeof($secondPageArray)>1){
$weather=$secondPageArray[0];
}else{
    $error="That city could not be found";
}
}else{
    $error="That city could not be found";
}
}
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Weather App</title>
    <link href="weather_scraper.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
       <h1>What's the Weather?</h1>
       <form  action="#" method="get">
           <fieldset class="form-group">

           <label>Enter Your City Name</label>
           <input class="form-control" type="text" name="city" placeholder="e.g Pakistan, India" value="<?php echo $_GET['city']; ?>">
           </fieldset>

           <button type="submit" class="btn btn-primary">Submit</button>
       </form>

       <div id="weather">
        <?php
        if($weather){

echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
        }
       
        else($error){
            echo  '<div class="alert alert-danger" role="alert">'.$error.'</div>';
        } 
        ?>
       </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>
