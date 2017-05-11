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
    <title>Rakennuksen lis‰ys</title>
    <body>
        <head>
            <script type="text/javascript" src="modernizr-latest.js"></script>
            <meta name=viewport content="width=device-width, initial-scale=1">
            <link rel = "stylesheet" type = "text/css" href = "Lisaystyylit.css?version=51"> 
        </head>
            <div class = "lisaysdiv">
            <form method="post" action="../lisays.php" class = "lisaysf" name="lisaysform">
                <fieldset>
                    <legend>Lis‰‰ Rakennus</legend>
                 
                    <label for="rakennus_nimi">Rakennuksen nimi (v‰hint‰‰n 2 merkki‰, enint‰‰n 50 merkki‰)</label>
                    <input id="rakennus_nimi" class="rakennus" type="text" pattern="{2,50}" name="rakennuksen_nimi" required />
                    <br><br><br>
                  
                    <label for="rakennus_kerros">Rakennuksen kerrokset (enint‰‰n 2 merkki‰)</label>
                    <input id="rakennus_kerros" class="rakennus" type="int" pattern="[0-9]{1,2}" name="kerrokset" />
                    <br><br><br>

                    <input type="submit"  name="lisays_rakennus" value="Lis‰‰ rakennus" />
                </fieldset>
            </form>
            </div>
            <br><br><br>
            <div class link>
                <a href="../index.php" class = "peru">Peruuta</a>
            </div>
    </body>
</html>