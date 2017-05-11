<?php

// Näyttää rekisteröinti-olion mahdolliset virheet
//registration = rekisterointi
//error = virhe
if (isset($rekisterointi)) {
    if ($rekisterointi->virheet) {
        echo "<textarea rows = '1' columns = '10' type = 'text'>";
        foreach ($rekisterointi->virheet as $virhe) {
            echo $virhe;
        }
        echo "</textarea>";
    }
    if ($rekisterointi->ilmoitukset) {
        echo "<textarea rows = '1' columns = '10' type = 'text'>";
        foreach ($rekisterointi->ilmoitukset as $ilmoitus) {
            echo $ilmoitus;
        }
        echo "</textarea>";
    }
}
?>
<html>
    <title>Rekisteröinti</title>
    <head>
        <script type="text/javascript" src="modernizr-latest.js"></script>
        <meta name=viewport content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" type = "text/css" href = "nakymat/Tyylit.css?version=51"/> 
    </head>
    <body>
    <!-- register form -->
    <div class = "rekdiv">
        <form method="post" action="rekisterointi.php" class = "rekf" name="registerform">
            <fieldset class = "reklk">
                <Legend class = "rekleg">Rekisteröi käyttäjä</Legend>
                    <!-- the user name input field uses a HTML5 pattern check -->
                    <label for="login_input_username">Käyttäjänimi</label>
                        <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="nimi" required />
                        <br><br><br>
                    <!-- the email input field uses a HTML5 email type check -->
                    <label for="login_input_email">Käyttäjän sähköposti</label>
                        <input id="login_input_email" class="login_input" type="email" name="sposti" required />
                        <br><br><br>
                    <label for="login_input_password_new">Salasana</label>
                        <input id="login_input_password_new" class="login_input" type="password" name="uusi_salasana" pattern=".{6,}" required autocomplete="off" />
                        <br><br><br>
                    <label for="login_input_password_repeat">Toista salasana</label>
                        <input id="login_input_password_repeat" class="login_input" type="password" name="toisto_salasana" pattern=".{6,}" required autocomplete="off" />
                        <br><br><br>       
                    <input type="submit"  name="register" value="Rekisteröidy" />
            </fieldset>

        </form>

        <!-- backlink -->
        <a href="index.php" class = "aloitus">Aloitussivulle</a>
    </div>
    </body>
</html>