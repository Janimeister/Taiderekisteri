<?php

// N‰ytt‰‰ lisays-olion mahdolliset virheet

if (isset($lisays)) {
    if ($lisays->virheet) {
        echo "<textarea rows = '1' columns = '10' type = 'text'>";
        foreach ($lisays->virheet as $virhe) {
            echo $virhe;
        }
        echo "</textarea>";
    }
    if ($lisays->ilmoitukset) {
        echo "<textarea rows = '1' columns = '10' type = 'text'>";
        foreach ($lisays->ilmoitukset as $ilmoitus) {
            echo $ilmoitus;
        }
        echo "</textarea>";
    }
}
?>
<html>
    <title>Taiteilijan lis‰ys</title>
    <body>
        <head>
            <script type="text/javascript" src="modernizr-latest.js"></script>
            <meta name=viewport content="width=device-width, initial-scale=1">
            <link rel = "stylesheet" type = "text/css" href = "Lisaystyylit.css?version=51"> 
        </head>

        <div class = "lisaysdiv">
        <form method="post" action="../lisays.php" class = "lisaysf" name="lisaysform">
            <fieldset>
                <legend>Lis‰‰ taiteilija</legend>

         
                <label for="input_taiteilija">Taiteilijan kokonimi (v‰hint‰‰n 2 merkki‰, enint‰‰n 50 merkki‰)</label>
                <input id="input_taiteilija" class="taiteilija" type="text" pattern="{2,50}" name="nimi" required />
                <br><br><br>

               
                <label for="input_kotipaikkakunta">Taiteilijan syntym‰paikkakunta (v‰hint‰‰n 2 merkki‰, enint‰‰n 50 merkki‰)</label>
                <input id="input_kotipaikkakunta" class="taiteilija" type="text" pattern="{2,50}" name="syntymapaikka" />
                <br><br><br>

                <label for="input_syntyaika">Taiteilijan syntym‰aika (muotoa 2000-01-31)</label>
                <input id="input_syntyaika" class="taiteilija" type="date" placeholder="YYYY-MM-DD" name="syntyma_aika" pattern=".{6,}" />
                <br><br><br>

                <label for="input_kuolinaika">Taiteilijan kuolinaika (muotoa 2000-12-31) </label>
                <input id="input_kuolinaika" class="taiteilija" type="date" placeholder="YYYY-MM-DD" name="kuolinaika" pattern=".{6,}"  />
                <br><br><br>

                <label for="input_koulutus">Taiteilijan koulutus (v‰hint‰‰n 2 merkki‰, enint‰‰n 50 merkki‰)</label>
                <input id="input_koulutus" class="taiteilija" type="text" pattern="{2,50}" name="koulutus" />
                <br><br><br>

               
                <label for="input_palkinnot">Taiteilijan palkinnot (v‰hint‰‰n 2 merkki‰, enint‰‰n 10000 merkki‰)</label>
                <input id="input_palkinnot" class="taiteilija" type="text" pattern="{2,10000}" name="palkinnot" />
                <br><br><br>

                <label for="input_kirjallisuusviite">Taiteilijan kirjallisuusviite (v‰hint‰‰n 2 merkki‰, enint‰‰n 10000 merkki‰)</label>
                <input id="input_kirjallisuusviite" class="taiteilija" type="text" pattern="{2,10000}" name="kirjallisuusviite"/>
                <br><br><br>

                <input type="submit"  name="lisays_taiteilija" value="Lis‰‰ taiteilija" />
                <br><br><br>
            </fieldset>
        </form>
        </div>
        <!-- backlink -->
        <div class link>
            <a href="../index.php" class = "peru">Peruuta</a>
        </div>
    </body>
</html>