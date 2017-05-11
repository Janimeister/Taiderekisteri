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
    <title>Hoitohistoriaan lis‰ys</title>
    <body>
        <head>
            <script type="text/javascript" src="modernizr-latest.js"></script>
            <meta name=viewport content="width=device-width, initial-scale=1">
            <link rel = "stylesheet" type = "text/css" href = "Lisaystyylit.css?version=51"> 
        </head>

        <!-- register form -->
        <div class = "lisaysdiv">
        <form method="post" action="../lisays.php" class = "lisaysf" name="lisaysform">
            <fieldset>
                <legend>Lis‰‰ hoitohistoriaan</legend>

                

                <label for="input_pvm">P‰iv‰m‰‰r‰ (muotoa 2000-01-01)</label>
                <input id="input_pvm" class="hoitohistoria" type="date" name="paivamaara" pattern=".{6,}" required/>
                <br><br><br>


                <label for="input_toimenpide">Toimenpide (v‰hint‰‰n 2 merkki‰, enint‰‰n 100 merkki‰)</label>
                <input id="input_toimenpide" class="hoitohistoria" type="text" pattern="{2,100}" name="toimenpide" required/>
                <br><br><br>

               
                <label for="input_tekija">Tekij‰ (v‰hint‰‰n 2 merkki‰, enint‰‰n 30 merkki‰)</label>
                <input id="input_tekija" class="hoitohistoria" type="text" pattern="{2,30}" name="tekija" required/>
                <br><br><br>

               

                <input type="submit"  name="lisays_hoitohistoria" value="Lis‰‰ hoitohistoriaan" />
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