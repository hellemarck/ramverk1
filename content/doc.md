---
title: "Dokumentation"
---
API-dokumentation
=========================

### IP-validering

På sidan [Ip-adresser](http://www.student.bth.se/~mehe19/dbwebb-kurser/ramverk1/me/redovisa/htdocs/ip) finns möjlighet att validera IP-adresser. Båda formulären kan användas direkt på sidan, det understa kommer att presentera svaret i JSON-format i webbläsaren. Ett alternativt sätt är att anropa JSON-API:t direkt i URL:en.

<b>Exempel (sökning på 127.0.0.1 och 1.2.3):</b><br><br>
...htdocs/ipApi/validateIpApi?ipAdress=127.0.0.1<br>
...htdocs/ipApi/validateIpApi?ipAdress=1.2.3


<b>Testa</b>

<!-- alt lägg in länkar istället -->

<form action="ipApi/validateIpApi">
    ...ipApi/validateIpApi?ipAdress=
    <input type="submit" name="ipAdress" value="127.0.0.1">
    <input type="submit" name="ipAdress" value="1.2.3"><br>
</form>
