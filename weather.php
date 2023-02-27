<?php
$apiKey = "YOUR_API_KEY_HERE"; // replace with your OpenWeatherMap API key
$city = isset($_GET["city"]) ? $_GET["city"] : "Istanbul"; // default city

$url = "https://api.openweathermap.org/data/2.5/weather?q=".urlencode($city)."&appid=".$apiKey."&units=metric";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ($httpCode != 200) {
  http_response_code(404);
  echo json_encode(array("error" => "Unable to get weather data."));
} else {
  header("Content-Type: application/json");
  echo $response;
}

curl_close($curl);
?>
