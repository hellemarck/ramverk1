---
title: "Dokumentation"
---
API-dokumentation
=========================

### IP-validering med geografisk position

På sidan [Ip-adresser](http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ip) finns möjlighet att validera IP-adresser och få fram dess geografiska position (koordinater, stad, land). Båda formulären kan användas direkt på sidan, det understa kommer att presentera svaret i JSON-format i webbläsaren. Ett alternativt sätt är att anropa JSON-API:t direkt i URL:en.

<b>Exempel</b> (sökning på t.ex. ip-adressen 8.8.8.8):<br><br>
...htdocs/ipApi/validateIpApi?ipAdress=8.8.8.8<br>
...htdocs/ipApi/validateIpApi?ipAdress=1.2.3<br>
...htdocs/ipApi/validateIpApi?ipAdress=193.150.214.141


<b>Testa</b>

<!-- alt lägg in länkar istället -->

<form action="ipApi/validateIpApi">
    ...ipApi/validateIpApi?ipAdress=
    <input type="submit" name="ipAdress" value="8.8.8.8" style="background-color:#62c25d;">
    <input type="submit" name="ipAdress" value="193.150.214.141" style="background-color:#62c25d;">
    <input type="submit" name="ipAdress" value="1.2.3" style="background-color:#f76765;"><br>
</form>
