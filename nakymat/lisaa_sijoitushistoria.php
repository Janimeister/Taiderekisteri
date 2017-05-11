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
    <title>Sijoitushistoriaan lis‰ys</title>
    <body>
        <head>
            <script type="text/javascript" src="modernizr-latest.js"></script>
            <meta name=viewport content="width=device-width, initial-scale=1">
            <link rel = "stylesheet" type = "text/css" href = "Lisaystyylit.css?version=51"> 
        </head>
        <div class = "lisaysdiv">
        <form method="post" action="../lisays.php" class = "lisaysf" name="lisaysform">
            <fieldset>
                <legend>Lis‰‰ sijoitushistoriaan</legend>

                <label for="input_varasto"> Varasto (1 eli on tai 0 eli ei ole)</label>
                 <input id="input_varasto" class="sijoitushistoria" type="text" pattern="[0-1]{0,1}" name="varasto" />
                <br><br><br>

                 <label for="input_kerros">Kerros (enint‰‰n 2 merkki‰)</label>
                 <input id="input_kerros" class="sijoitushistoria" type="int" pattern="[0-9]{1,2}" name="kerros" />
                <br><br><br>

                <label for="input_tilanumero">Tilanumero (v‰hint‰‰n 2 merkki‰, enint‰‰n 30 merkki‰)</label>
                <input id="input_tilanumero" class="sijoitushistoria" type="text" pattern="{2,30}" name="tilanumero" />
                <br><br><br>

                <label for="input_osasto">Osasto (v‰hint‰‰n 2 merkki‰, enint‰‰n 30 merkki‰)</label>
                <input id="input_tilanumero" class="sijoitushistoria" type="text" pattern="{2,30}" name="osasto" />
                <br><br><br>

                <label for="input_alkupvm">Alkup‰iv‰m‰‰r‰ (muotoa 2000-01-31)</label>
                <input id="input_alkupvm" class="sijoitushistoria" type="date" placeholder="YYYY-MM-DD" name="alku_pvm" pattern=".{6,}" />
                <br><br><br>

                <label for="input_loppupvm">Loppup‰iv‰m‰‰r‰ (muotoa 2000-12-31)</label>
                <input id="input_loppupvm" class="sijoitushistoria" type="date" placeholder="YYYY-MM-DD" name="loppu_pvm" pattern=".{6,}"  />
                <br><br><br>

                 <label for="input_vapaat_tiedot">Vapaat tiedot (v‰hint‰‰n 2 merkki‰, enint‰‰n 200 merkki‰)</label>
                <input id="input_vapaat_tiedot" class="sijoitushistoria" type="text" pattern="{2,200}" name="vapaat_tiedot" />
                <br><br><br>

                <label for="input_rakennus_id"> Rakennus-id</label>
                    <input id="input_rakennus_id" class="sijoitushistoria" type="text" pattern="[0-9]{1,4}" name="rakennus_id" required />
                <br><br><br>



                

                <input type="submit"  name="lisays_sijoitushistoria" value="Lis‰‰ sijoitushistoria" />
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