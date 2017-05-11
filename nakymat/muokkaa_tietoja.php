<?php

// Näyttää lisays-olion mahdolliset virheet

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
    <title>Tietojen muokkaus</title>
    <body>
        <head>
            <script type="text/javascript" src="modernizr-latest.js"></script>
            <meta name=viewport content="width=device-width, initial-scale=1">
            <link rel = "stylesheet" type = "text/css" href = "nakymat/Lisaystyylit.css?version=51"> 
        </head>

    
        
    </body>
</html>