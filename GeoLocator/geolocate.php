<?php
$apiUrl = "http://ip-api.com/json/";
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

$city = $data['city'] ?? 'Desconocida';
$country = $data['country'] ?? 'Desconocido';
$lat = $data['lat'] ?? 0;
$lon = $data['lon'] ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mapa</title>
</head>
<body>
<h3>Ubicación: <?php echo htmlspecialchars("$city, $country"); ?></h3>
<iframe
    width="100%"
    height="450"
    style="border:0"
    loading="lazy"
    src="https://www.openstreetmap.org/export/embed.html?bbox=<?php echo $lon-0.05; ?>%2C<?php echo $lat-0.05; ?>%2C<?php echo $lon+0.05; ?>%2C<?php echo $lat+0.05; ?>&layer=mapnik&marker=<?php echo $lat; ?>%2C<?php echo $lon; ?>">
</iframe>
</body>
</html>

