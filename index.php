<?php

    date_default_timezone_set("Europe/Belgrade");
    $apiKey = "69b221fad52ef23c42dfeb43a5cf3a9e";
    $cityId = 3189595;
    $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=".$cityId."&lang=en&units=metric&APPID=".$apiKey;

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_URL, $googleApiUrl);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_VERBOSE, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response);
    //echo "<pre>";
    //print_r($data);
    $currentTime = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forecast weather</title>
    <style>
        body{
            font-family: Arial;
            font-size: 0.95em;
            color: #929292;
        }
        .report-container{
            border: #E0E0E0 1px solid ;
            padding: 20px 40px 40px 40px;
            border-radius: 5px;
            width: 550px;
            margin: 0 auto;
        }
        .weather-icon{
            vertical-align: middle;
            margin-right: 20px;
        }
        .weather-forecast{
            color: #212121;
            font-size: 1.2em;
            font-weight: bold;
            margin: 20px 0px;
        }
        span.min-temperature{
            margin-left: 15px;
            color: #929292;
        }
        .time{
            line-height: 25px;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <h2><?php echo $data->name ?> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y", $currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" 
            class="weather-icon"><?php echo $data->main->temp_max; ?>&deg;C
            <span class="min-temperature"><?php echo $data->main->temp_min; ?>&deg;C</span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?>%</div>
            <div>Wind: <?php echo $data->wind->speed; ?></div>
        </div>
    </div>
</body>
</html>