<html>

    <head>
        <script type="text/javascript" src="modernizr-latest.js""></script>
        <link rel = "stylesheet" type = "text/css" href = "nakymat/Tyylit.css?version=51">
        <script type="text/javascript" src="modernizr-latest.js"></script>
        <meta name=viewport content="width=device-width, initial-scale=1">
    </head>

    <div>
        <title>KYS-TAIDEREKISTERI-etusivu</title>
    </div>

    <body>
    <div id="wrapper">
        <div class = "header1">
            <header><img src="https://static1.squarespace.com/static/551c2c4ae4b0c1e6d15438da/t/55382d1fe4b002ebf3fbc2a4/1429744927588/" alt="logo" />TAIDEREKISTERI</header>
        </div>
        
        <br>
        <!-- login form box -->
        <div class = "logdiv">
        <form method="post" action="index.php" name="loginform" class = "logf">
            <fieldset class ="loglk">
                <legend>Kirjaudu</legend>
                    <label for="login_input_username">Käyttäjänimi</label>
                    <input id="login_input_username" class="login_input" type="text" name="nimi" required />
                    <br><br><br>

                    <label for="login_input_password">Salasana</label>
                    <input id="login_input_password" class="login_input" type="password" name="salasana" autocomplete="off" required />
                    <br><br><br>

                    <input type="submit" name="login" value="Kirjaudu" />
            </fieldset>

        </form>
        </div>
        <br><br><br>
        <div class = "hakudiv">
        <form method = "post" action = "index.php" name = "hakuform" class = "hakuf">
            <fieldset class ="hakulk">
                <legend>Hakeminen</legend>
                    <select name = "hakuehto">
                        <option value="-1">--Valitse hakuehto--</option>
                        <option value="taiteilija">Taiteilija</option>
                        <option value="teos">Teos</option>
                        <option value="sijainti">Sijainti</option>
                        <option value="paaluokka">Pääluokka</option>
                        <option value="hankintatapa">Hankintatapa</option>
                        <option value="hankinta_aika">Hankinta-aika</option>
                        <option value="poistetut">Poistetut</option>
                        <option value="vakuutusarvo">Vakuutusarvo</option>
                        <option value="tekijanoikeus">Tekijän oikeus</option>
                        <option value="ohje1">--Seuraavat haut eivät vaadi haku-kentän täyttöä--</option>
                        <option value="kaikkisijainnit">Kaikki sijainnit</option>
                        <option value="kaikkirakennukset">Kaikki rakennukset</option>
                        <option value="kaikkitaiteilijat">Kaikki taiteilijat</option>
                        <option value="kaikkiteokset">Kaikki teokset</option>
                        <option value="kaikkihoidot">Kaikki hoitotoimenpiteet</option>
                    </select>

                    <input id = "hakuinput" class = "haku_input" type = "text" name = "hakumuuttuja" />
                    <br><br><br>

                    <input type =  "submit" name = "haku" value = "Hae" />
            </fieldset>
        </form>
        </div>
        <?php 
            $hakeminen = new Haku();
        ?>
     
    </div>
    </body>
</html>

