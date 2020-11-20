
<article class="article" style="
    text-align:center;
    min-height:300px;
">
    <h1>Väderprognos</h1>
    <p>Sök på koordinater (longitude,latitud) eller IP-adress för 7-dagarsprognos för platsen</p>
    <form method="GET" action="weather/search">
        <input name="location" type="text" value="<?= $data[0] ?>"><br><br>
        <input type="submit" value="Sök">
    </form>

    <p><i>Se <a src="
        http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/doc
        " style="color:#888;">dokumentationen</a> för att göra samma sökning via ett REST-API</i></p>

</article>
