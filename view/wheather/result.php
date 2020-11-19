<article class="article" style="text-align:center; min-height:300px;">
    <div style="
        background-color:#ececec;
        width:600px;
        margin:40px auto;
        padding:20px;
        border:1px solid #888;
    ">
        <h1 class="heading">7-dagarsprognos för x</h1>
        <div style="width:500px;margin: 0 auto;text-align:center;">
<?php
if (is_string($data["forecast"])) {
    ?><p><?= $data["forecast"] ?></p>
<?php } else {
    foreach ($data["forecast"] as $day) { ?>
         <p><b><?= $day["date"]; ?></b> - <?= $day["description"]; ?>, temperatur mellan <?= $day["temp"]; ?> °C.</p>
    <?php }
}?>

    <a href="http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/wheather" style="
        color:#666;
        background-color:white;
        padding:10px;
        text-decoration:none;
        border: 1px solid #888;
    ">BÖRJA OM</a>
    <br><br>
    </div>
</article>
