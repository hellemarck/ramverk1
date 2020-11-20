<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css">
<script src='https://unpkg.com/leaflet@1.3.3/dist/leaflet.js'></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@[VERSION]/dist/L.Control.Locate.min.js" charset="utf-8"></script> -->

<article class="article" style="text-align:center; min-height:300px;">
    <div style="
        background-color:#ececec;
        width:600px;
        margin:40px auto;
        padding:20px;
        border:1px solid #888;
    ">
        <h1 class="heading">7-dagarsprognos</h1>
        <div style="width:500px;margin: 0 auto;text-align:center;">
<?php

// IF COORDINATES ARE FOUND - DRAW MAP
// code in map/map.php to reuse

if ($data["coordinates"] && $data["location"]) {
    ?>
    <p><b>Plats:</b> <?= $data["location"][0] ?>, <?= $data["location"][1] ?></p>
    <div id="map" style="height: 440px; border: 1px solid #AAA;"></div>

    <script>
        let latitude = <?= $data["coordinates"][0] ?>;
        let longitude = <?= $data["coordinates"][1] ?>;
    </script>

    <?php require 'map/map.php';
}

// SHOW FORECAST OR ERROR MSG

if (is_string($data["forecast"])) {
    ?><p><?= $data["forecast"] ?></p>
<?php } else {
    foreach ($data["forecast"] as $day) { ?>
         <p><b><?= $day["date"]; ?></b> - <?= $day["description"]; ?>, temperatur mellan <?= $day["temp"]; ?> °C.</p>
    <?php }
}?>
    <br>
    <a href="http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/weather" style="
        color:#666;
        background-color:white;
        padding:10px;
        text-decoration:none;
        border: 1px solid #888;
    ">BÖRJA OM</a>
    <br><br>
    </div>
</article>
