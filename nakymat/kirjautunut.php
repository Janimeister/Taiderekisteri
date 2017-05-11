<html>
	<title>K‰ytt‰j‰n n‰kym‰</title>
	<head>
        <script type="text/javascript" src="modernizr-latest.js"></script>
        <meta name=viewport content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "./Indextyylit.css?version=51"/>
		<script src="./kirjastot/dropzone.js"></script>>
		<link href="./kirjastot/dropzone.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
    <div class = "kirjdiv">
		<p>Hei, <?php echo $_SESSION['nimi']; ?>. Olet kirjautunut sis‰‰n.
		Sinun PHP-versiosi on: <?php echo phpversion(); ?></p>
		<br><br><br>
			
			<a href="rekisterointi.php" class = "reka">Rekisterˆi uusi k‰ytt‰j‰</a>
			<br><br><br>

			<div class="dropdown">
			  <button class="dropbtn">Lis‰yksen valinta</button>
			  <div class="dropdown-content">
			    <a href="nakymat/lisaa_taiteilija.php">Lis‰‰ taiteilija</a>
			    <a href="nakymat/lisaa_teos.php">Lis‰‰ teos</a>
			    <a href="nakymat/lisaa_rakennus.php">Lis‰‰ rakennus</a>
			    <a href="nakymat/lisaa_sijoitushistoria.php">Lis‰‰ sijoitushistoriaan</a>
			    <a href="nakymat/lisaa_hoitohistoria.php">Lis‰‰ hoitohistoriaan</a>
			  </div>
			</div>
			<br><br><br>
        <div class = "muokdiv">
		<form method = "post" action = "muokkaaminen.php" class = "muokf" name = "muokkausform">
            <fieldset class ="muokkauslk">
                <legend>Muokkaus</legend>
                    <select name = "muokkaustoimi">
                        <option value="-1">--Valitse muokattava kohde--</option>
                        <option value="taiteilija">Taiteilija</option>
                        <option value="teos">Teos</option>
                        <option value="rakennus">Rakennus</option>
                        <option value="sijoitus">Sijoitushistoria</option>
                        <option value="hoito">Hoitohistoria</option>
                    </select>

                    <input id = "muokkausinput" class = "muokkaus_input" type = "text" name = "muokkausmuuttuja" required />
                    <br><br><br>

                    <input type =  "submit" name = "muokkausbtn" value = "Muokkaa" />
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
                        <option value="paaluokka">P‰‰luokka</option>
                        <option value="hankintatapa">Hankintatapa</option>
                        <option value="hankinta_aika">Hankinta-aika</option>
                        <option value="poistetut">Poistetut</option>
                        <option value="vakuutusarvo">Vakuutusarvo</option>
                        <option value="tekijanoikeus">Tekij‰n oikeus</option>
                        <option value="ohje1">--Seuraavat haut eiv‰t vaadi haku-kent‰n t‰yttˆ‰--</option>
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
        <br><br><br>
        <form action="./tiedoston_lisays.php" class="dropzone"></form> 
        <br><br><br>
			<a href="index.php?logout" class = "kirjaa">Kirjaudu ulos</a>
			<br><br><br>
    </div>
	</body>
</html>