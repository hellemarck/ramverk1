
<article class="article" style="
    text-align:center;
    min-height:300px;
">
    <h1>Väderprognos för kommande 7 dagar</h1>
    <p>Sök på ort, coordinater (longitude,latitud) eller IP-adress</p>
    <form method="GET" action="wheather/search">
        <input name="location" type="text" value="<?= $data[0] ?>"><br><br>
        <!-- <input type="submit" value="Validera"> -->
        <!-- <label><input type="radio" name="type" value="coming" checked> Kommande 10 dagar</label><br>
        <label><input type="radio" name="type" value="past"> Föregående 30 dagar</label><br><br> -->
        <input type="submit" value="Sök">
    </form>

    <!-- <h3>Validera IP-adress med JSON-resultat</h3>

    <form method="GET" action="ipApi/validateIpApi">
        <input name="ipAdress" type="text" value="<?= $data[0] ?>"><br><br>
        <input type="submit" value="Validera med JSON-resultat">
    </form> -->
</article>
