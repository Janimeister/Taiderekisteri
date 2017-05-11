<?php
class Muokkaus{
    public function __construct(){
            if(isset($_POST["muokkausbtn"])){
                $valittu = $_POST["muokkaustoimi"];
                if($valittu == "taiteilija"){
                     $this->MuokkaaTaiteilija();
                }
                if($valittu == "rakennus"){
                    $this->MuokkaaRakennus();
                }
                if($valittu == "teos"){
                    $this->MuokkaaTeos();
                }
                if($valittu == "sijoitus"){
                    $this->MuokkaaSijoitus();
                }
                if($valittu == "hoito"){
                    $this->MuokkaaHoito();
                }
            }
            if(isset($_POST["muokkaa_taiteilija"])){
                $this->PaivitaTaiteilija();
            }
            if (isset($_POST["muokkaa_rakennus"])){
                $this->PaivitaRakennus();
            }
            if(isset($_POST["muokkaa_teos"])){
                $this->PaivitaTeos();
            }
            if(isset($_POST["muokkaa_sijoitus"])){
                $this->PaivitaSijoitus();
            }
            if(isset($_POST["muokkaa_hoito"])){
                $this->PaivitaHoito();
            }

            

    }


    private function MuokkaaTaiteilija(){

        echo "<body>";

        echo "<head>";
            echo "<link rel = 'stylesheet' type = 'text/css' href = 'nakymat/Lisaystyylit.css?version=51'>";
            echo "<script type= 'text/javascript' src= 'modernizr-latest.js'></script>";
            echo "<meta name=viewport content= 'width=device-width, initial-scale=1'>";
        echo "</head>";

            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $muokkausmuuttuja = $this->tietokanta_yhteys->real_escape_string($_POST["muokkausmuuttuja"]);
                $sql = "SELECT *
                        FROM TAITEILIJAT
                        WHERE nimi = '" . $muokkausmuuttuja . "';";
 
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                if ($haku_varmentaminen_tulos->num_rows == 1) {
                    echo "<div class = 'muokkausdiv'>";
                    echo "<form method= 'post' action= 'muokkaaminen.php'  class = 'muoksf' name= 'muokkausform'>";
                        echo "<fieldset class = 'mtaiteilija'>";
                            echo '<legend>Muokkaa taiteilijan tietoja</legend>';

                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){

                        $var1 = $tulosrivi['taiteilija_id'];
                        $var2 = $tulosrivi["nimi"];
                        $var3 = $tulosrivi["syntyma_aika"];
                        $var4 = $tulosrivi["kuolinaika"];
                        $var5 = $tulosrivi["syntymapaikka"];
                        $var6 = $tulosrivi["koulutus"];
                        $var7 = $tulosrivi["palkinnot"];
                        $var8 = $tulosrivi["kirjallisuusviite"];

                        echo "<label for='input_taiteilija'>Taiteilijan ID</label>";
                        echo "<input id='input_taiteilija' class='taiteilija' type='text' value = '$var1' name='taiteilija_id' readonly='readonly' required />'";
                        echo "<br><br><br>";

                        echo "<label for='input_taiteilija'>Taiteilijan kokonimi (v‰hint‰‰n 2 merkki‰, enint‰‰n 50 merkki‰)</label>";
                        echo "<input id='input_taiteilija' class='taiteilija' type='text' value = '$var2' name='nimi' pattern='{2,50}' required />'";
                        echo "<br><br><br>";

                        echo "<label for='input_kotipaikkakunta'>Taiteilijan syntym‰paikkakunta (v‰hint‰‰n 2 merkki‰, enint‰‰n 50 merkki‰)</label>";
                        echo "<input id='login_input_email' class='taiteilija' type='text' value ='$var5' name='syntymapaikka' pattern='{2,50}' />";
                        echo "<br><br><br>";

                        echo "<label for='input_syntyaika'>Taiteilijan syntym‰aika (muotoa 2000-01-31)</label>";
                        echo "<input id='login_input_password_new' class='taiteilija' type='date' value = '$var3' name='syntyma_aika' pattern='.{6,}' />";
                        echo "<br><br><br>";

                        echo "<label for='input_kuolinaika'>Taiteilijan kuolinaika (muotoa 2000-12-31) </label>";
                        echo "<input id='input_kuolinaika' class='taiteilija' type='date' value = '$var4' name='kuolinaika' pattern='.{6,}' />";
                        echo "<br><br><br>";

                        echo "<label for='input_koulutus'>Taiteilijan koulutus (v‰hint‰‰n 2 merkki‰, enint‰‰n 50 merkki‰)</label>";
                        echo "<input id='input_koulutus' class='taiteilija' type='text' value = '$var6' ' name='koulutus' pattern='{2, 50}' />";
                        echo "<br><br><br>";

                       
                        echo "<label for='input_palkinnot'>Taiteilijan palkinnot (v‰hint‰‰n 2 merkki‰, enint‰‰n 10000 merkki‰)</label>";
                        echo "<input id='input_palkinnot' class='taiteilija' type='text' value = '$var7' name='palkinnot' pattern='{2, 10000}' />";
                        echo "<br><br><br>";

                        echo "<label for='input_kirjallisuusviite'>Taiteilijan kirjallisuusviite (v‰hint‰‰n 2 merkki‰, enint‰‰n 10000 merkki‰)</label>";
                        echo "<input id='input_kirjallisuusviite' class='taiteilija' type='text' value = '$var8' name='kirjallisuusviite' pattern='{2, 10000}' />";
                        echo "<br><br><br>";

                        echo "<input type='submit'  name='muokkaa_taiteilija' value='Muokkaa' />";
                        echo "<br>";
                    }
                echo "</fieldset>";
            echo "</form>";
            echo "</div>";

            echo "<a href='index.php' class = 'peru'>Peruuta</a>";
        echo "</body>";
                                       
            }
        }
    }

    private function PaivitaTaiteilija(){
    $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
             
                $taiteilija_id = $_POST['taiteilija_id'];
                $nimi = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['nimi'], ENT_QUOTES));
                $syntyma_aika = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['syntyma_aika'], ENT_QUOTES));
                $kuolinaika = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kuolinaika'], ENT_QUOTES));
                $syntymapaikka = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['syntymapaikka'], ENT_QUOTES));
                $koulutus = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['koulutus'], ENT_QUOTES));
                $palkinnot = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['palkinnot'], ENT_QUOTES));
                $kirjallisuusviite = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kirjallisuusviite'], ENT_QUOTES));

                $sql = "UPDATE TAITEILIJAT SET nimi = '" . $nimi . "', kuolinaika = '" . $kuolinaika . "', syntymapaikka = '" . $syntymapaikka . "', koulutus = '" . $koulutus . "', palkinnot = '" . $palkinnot . "', kirjallisuusviite = '" . $kirjallisuusviite . "'
                       WHERE taiteilija_id = '" . $taiteilija_id . "';";
                $tunnuksen_update = $this->tietokanta_yhteys->query($sql);
                    // Jos taiteilijan lis‰‰minen onnistui

                if ($tunnuksen_update) {
                    echo "<p class = 'vp'>";
                    echo "Taiteilija p‰ivitettiin onnistuneesti.";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                } else {
                    echo "<p class = 'vp'>";
                    echo "P‰ivitt‰minen ep‰onnistui, yrit‰ uudelleen..";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                }
            }

    }

    private function MuokkaaRakennus(){
        echo "<body>";

        echo "<head>";
            echo "<link rel = 'stylesheet' type = 'text/css' href = 'nakymat/Lisaystyylit.css?version=51'>";
            echo "<script type= 'text/javascript' src= 'modernizr-latest.js'></script>";
            echo "<meta name=viewport content= 'width=device-width, initial-scale=1'>";
        echo "</head>";

            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $muokkausmuuttuja = $this->tietokanta_yhteys->real_escape_string($_POST["muokkausmuuttuja"]);
                $sql = "SELECT *
                        FROM RAKENNUS
                        WHERE rakennuksen_nimi = '" . $muokkausmuuttuja . "';";
 
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                if ($haku_varmentaminen_tulos->num_rows == 1) {
                    echo "<div class = 'muokkausdiv'>";
                    echo "<form method= 'post' action= 'muokkaaminen.php'  class = 'muoksf' name= 'muokkausform'>";
                        echo "<fieldset class = 'mrakennus'>";
                            echo '<legend>Muokkaa rakennuksen tietoja</legend>';

                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        $var1 = $tulosrivi['rakennus_id'];
                        $var2 = $tulosrivi["rakennuksen_nimi"];
                        $var3 = $tulosrivi["kerrokset"];

                        echo "<label for='input_rakennus'>Rakennuksen ID</label>";
                        echo "<input id='input_rakennus_edit' class='rakennus' type='text' value = '$var1' ' name='rakennus_id' readonly='readonly' required />'";
                        echo "<br><br><br>";

                        echo "<label for='input_rakennus'>Rakennuksen nimi (v‰hint‰‰n 2 merkki‰, enint‰‰n 50 merkki‰)</label>";
                        echo "<input id='input_rakennus_edit' class='rakennus' type='text' value = '$var2' ' name='rakennuksen_nimi' pattern='{2, 50}' required />'";
                        echo "<br><br><br>";

                        echo "<label for='input_rakennus'>Rakennuksen kerrokset (enint‰‰n 2 merkki‰)</label>";
                        echo "<input id='input_rakennus_edit' class='rakennus' type='text' value ='$var3' ' name='kerrokset' pattern='[0-9]{1,2}' required />";
                        echo "<br><br><br>";
                        echo "<input type='submit'  name='muokkaa_rakennus' value='Muokkaa' />";
                        echo "<br>";
                    }
                echo "</fieldset>";
            echo "</form>";
            echo "</div>";

            echo "<a href='index.php' class = 'peru'>Peruuta</a>";
        echo "</body>";

                }
                else{
                    echo "<p class = 'vp'>";
                    echo "Rakennusta ei lˆytynyt";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                }

            }
            else{
                echo "<p class = 'vp'>";
                echo "Virhe tietokantaan yhdist‰misess‰";
                echo "</p>";
                echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
            }
        }

    private function PaivitaRakennus(){
        $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
             
                $rakennus_id = $_POST['rakennus_id'];
                $rakennuksen_nimi = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['rakennuksen_nimi'], ENT_QUOTES));
                $kerrokset = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kerrokset'], ENT_QUOTES));

                $sql = "UPDATE RAKENNUS SET rakennuksen_nimi = '" . $rakennuksen_nimi . "', kerrokset = '" . $kerrokset . "'
                       WHERE rakennus_id = '" . $rakennus_id . "';";
                $tunnuksen_update = $this->tietokanta_yhteys->query($sql);
                    // Jos taiteilijan lis‰‰minen onnistui
                if ($tunnuksen_update) {
                    echo "<p class = 'vp'>";
                    echo "Rakennus p‰ivitettiin onnistuneesti.";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                } else {
                    echo "<p class = 'vp'>";
                    echo "P‰ivitt‰minen ep‰onnistui, yrit‰ uudelleen..";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                }
            }

    }
    private function MuokkaaTeos(){
        echo "<body>";

        echo "<head>";
            echo "<link rel = 'stylesheet' type = 'text/css' href = 'nakymat/Lisaystyylit.css?version=51'>";
            echo "<script type= 'text/javascript' src= 'modernizr-latest.js'></script>";
            echo "<meta name=viewport content= 'width=device-width, initial-scale=1'>";
        echo "</head>";

        $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {

                 $muokkausmuuttuja = $this->tietokanta_yhteys->real_escape_string($_POST["muokkausmuuttuja"]);
                $sql = "SELECT *
                        FROM TEOS
                        WHERE nimi = '" . $muokkausmuuttuja . "';";
 
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                if ($haku_varmentaminen_tulos->num_rows == 1) {
                    echo "<div class = 'muokkausdiv'>";
                    echo "<form method= 'post' action= 'muokkaaminen.php'  class = 'muoksf' name= 'muokkausform'>";
                        echo "<fieldset class = 'mteos'>";
                            echo '<legend>Muokkaa teoksen tietoja</legend>';

                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){

                        $var1 = $tulosrivi['teos_id'];
                        $var2 = $tulosrivi["nimi"];
                        $var3 = $tulosrivi["deponoitu"];
                        $var4 = $tulosrivi["aktiivisuustila"];
                        $var5 = $tulosrivi["poistoperuste"];
                        $var6 = $tulosrivi["inventaarionumero"];
                        $var7 = $tulosrivi["paaluokka"];
                        $var8 = $tulosrivi["erikoisluokka"];
                        $var9 = $tulosrivi["hoito_id"];
                        $var10 = $tulosrivi["sijoitus_id"];
                        $var11 = $tulosrivi["taiteilija_id"];
                        $var12 = $tulosrivi["omistaja"];
                        $var13 = $tulosrivi["kokoelman_nimi"];
                        $var14 = $tulosrivi["teoksen_aiemmat_nimet"];
                        $var15 = $tulosrivi["tekohetki"];
                        $var16 = $tulosrivi["hankintatapa"];
                        $var17 = $tulosrivi["hankintahinta"];
                        $var18 = $tulosrivi["omistajuushistoria"];
                        $var19 = $tulosrivi["hankinta_aika"];
                        $var20 = $tulosrivi["hankinta_paikka"];
                        $var21 = $tulosrivi["tekniikka"];
                        $var22 = $tulosrivi["teoksen_mitat"];
                        $var23 = $tulosrivi["kehyksen_mitat"];
                        $var24 = $tulosrivi["kehyksen_materiaali"];
                        $var25 = $tulosrivi["etupuolen_merkinnat"];
                        $var26 = $tulosrivi["takapuolen_merkinnat"];
                        $var27 = $tulosrivi["tekijanoikeustiedot"];
                        $var28 = $tulosrivi["tekijanoikeuden_vapautuminen"];
                        $var29 = $tulosrivi["teoksen_kunto"];
                        $var30 = $tulosrivi["sisalto_kuvailu"];
                        $var31 = $tulosrivi["tutkimusmateriaali"];
                        $var32 = $tulosrivi["konservointiasiakirjat"];
                        $var33 = $tulosrivi["vakuutusarvo"];
                        $var34 = $tulosrivi["vakuutusarvon_selite"];
                        $var35 = $tulosrivi["muu_tieto"];
                        $var36 = $tulosrivi["nayttelytiedot"];
                        $var37 = $tulosrivi["aukon_mitat"];
                        $var38 = $tulosrivi["kuva_alan_mitat"];
                        $var39 = $tulosrivi["jalustan_mitat"];
                        $var40 = $tulosrivi["jalustan_materiaalit"];
                        $var41 = $tulosrivi["poistoajankohta"];

                        echo "<h2 class = 'lisayshead'>1. Kokoelmatiedot</h2>";
                        echo "<br>";
                        echo "<label for='input_Omistaja'>Omistaja (v‰hint‰‰n 2 merkki‰, enint‰‰n 50 merkki‰)</label>";
                        echo "<input id='input_Omistaja' class='teos' type='text' pattern='{2,50}' value = '$var12' name='omistaja' />";
                        echo "<br><br><br>";
                        echo "<label for='input_kokoelma'>Kokoelman nimi (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>";
                        echo "<input id='input_kokoelma' class='teos' type='text' pattern='{2,60}' value = '$var13' name='kokoelman_nimi' />";
                        echo "<br><br><br>";
                        echo "<label for='input_inventaarionumero'>Inventaarionumero (enint‰‰n 6 merkki‰)</label>";
                        echo "<input id='input_inventaarionumero' class='teos' type='text' pattern='{1,6}' value = '$var6' name='inventaarionumero' />";
                        
                        echo "<br>";
                        echo "<h2 class = 'lisayshead'>2. Taiteilijatiedot</h2>";
                        echo "<br>";

                        echo "<label for='input_taiteilija_id'> Taiteilija-id (olemassaoleva)</label>";
                        echo "<input id='input_taiteilija_id' class='teos' type='text' pattern='[0-9]{1,6}' value = '$var11' name='taiteilija_id' />";
                        
                        echo "<br>";
                        echo "<h2 class = 'lisayshead'>3. Teostiedot</h2>";
                        echo "<br>";

                        echo "<label for='input_tyyppi'>Teos ID</label>";
                        echo "<input id= 'input_tyyppi' class='teos' type='int' value = '$var1' name= 'teos_id' readonly='readonly' />";
                        echo "<br><br><br>";
                        echo "<label for='input_tyyppi'>Deponoitu (0 eli ei-deponoitu tai 1 eli deponoitu)</label>";
                        echo "<input id='input_tyyppi' class='teos' type='text' pattern='[0-1]{1}' value = '$var3' name='deponoitu' />";
                        echo "<br><br><br>";
                        echo "<label for='input_paaluokka'>Paaluokka (v‰hint‰‰n 2 merkki‰, enint‰‰n 20 merkki‰)</label>";
                        echo "<input id='input_paaluokka' class='teos' type='text' pattern='{2,20}' value = '$var7' name='paaluokka' />";
                        echo "<br><br><br>";
                        echo "<label for='input_erikoisluokka'>Erikoisluokka (v‰hint‰‰n 2 merkki‰, enint‰‰n 20 merkki‰)</label>";
                        echo "<input id='input_erikoisluokka' class='teos' type='text' pattern='{2,20}' value = '$var8' name='erikoisluokka' />";  
                        echo "<br><br><br>";
                        echo "<label for='input_tekniikka'>Tekniikka (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>";
                        echo "<input id='input_tekniikka' class='teos' type='text' pattern='{2,60}' value = '$var21' name='tekniikka' />";
                        echo "<br><br><br>";
                        echo "<label for='input_kokoelma'>Teoksen nimi (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>";
                        echo "<input id='input_kokoelma' class='teos' type='text' pattern='{2,60}' value = '$var2' name='nimi' />"; 
                        echo "<br><br><br>";
                        echo "<label for='input_aiemmat_nimet'>Teoksen aiemmat nimet (v‰hint‰‰n 2 merkki‰, enint‰‰n 100 merkki‰)</label>";
                        echo "<input id='input_aiemmat_nimet' class='teos' type='text' pattern='{2,100}' value = '$var14' name='teoksen_aiemmat_nimet' />";
                        echo "<br><br><br>";
                        echo "<label for='input_sisalto_kuvailu'>Aiheen kuvailu (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>";
                        echo "<input id='input_sisalto_kuvailu' class='teos' type='text' pattern='{2,150}' value = '$var30' name='sisalto_kuvailu' />";
                        echo "<br><br><br>";
                        echo "<label for='input_tekohetki'>Tekohetki (muotoa 2000-01-31)</label>";
                        echo "<input id='input_tekohetki' class='teos' type='date' value = '$var15' name='tekohetki' pattern='.{6,}' />";
                        echo "<br><br><br>";
                        echo "<label for='input_teoksen_mitat'>Teoksen mitat (korkeus X leveys)</label>";
                        echo "<input id='input_teoksen_mitat' class='teos' type='text' pattern='[xX0-9 ]{2,30}' value = '$var22' name='teoksen_mitat' />";
                        echo "<br><br><br>";
                        echo "<label for='input_aukon_mitat'>Aukon mitat (korkeus X leveys)</label>";
                        echo "<input id='input_aukon_mitat' class='teos' type='text' pattern='[xX0-9 ]{2,30}' value = '$var37' name='aukon_mitat' />";
                        echo "<br><br><br>";
                        echo "<label for='input_kuva_alan_mitat'>Kuva-alan mitat (korkeus X leveys)</label>";
                        echo "<input id='input_kuva-alan_mitat' class='teos' type='text' pattern='[xX0-9 ]{2,30}' value = '$var38' name='kuva_alan_mitat' />";
                        echo "<br><br><br>";
                        echo "<label for='input_kehyksen_mitat'>Kehyksen mitat (korkeus X leveys)</label>";
                        echo "<input id='input_kehyksen_mitat' class='teos' type='text' pattern='[xX0-9 ]{2,30}' value = '$var23' name='kehyksen_mitat' />";
                        echo "<br><br><br>";
                        echo "<label for='input_kehyksen_materiaali'>Kehyksen materiaali (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>";
                        echo "<input id='input_kehyksen_materiaali' class='teos' type='text' pattern='{2,60}' value = '$var24' name='kehyksen_materiaali' />";
                        echo "<br><br><br>";
                        echo "<label for='input_jalustan_mitat'>Jalustan mitat (korkeus X leveys)</label>";
                        echo "<input id='input_jalustan_mitat' class='teos' type='text' pattern='[xX0-9 ]{2,30}' value = '$var39' name='jalustan_mitat' />";
                        echo "<br><br><br>";
                        echo "<label for='input_jalustan_materiaali'>Jalustan materiaalit (v‰hint‰‰n 2 merkki‰, enint‰‰n 30 merkki‰)</label>";
                        echo "<input id='input_jalustan_materiaali' class='teos' type='text' pattern='{2,30}' value = '$var40' name='jalustan_materiaalit' />";
                        echo "<br><br><br>";
                        echo "<label for='input_etupuolen_merkinnat'>Etupuolen merkinnat (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>";
                        echo "<input id='input_etupuolen_merkinnnat' class='teos' type='text' pattern='{2,150}' value = '$var25' name='etupuolen_merkinnat' />";
                        echo "<br><br><br>";
                        echo "<label for='input_takapuolen_merkinnat'>K‰‰ntˆpuolen merkinn‰t (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>";
                        echo "<input id='input_takapuolen_merkinnnat' class='teos' type='text' pattern='{2,150}' value = '$var26' name='takapuolen_merkinnat' />";
                        
                        echo "<br>";
                        echo "<h2 class = 'lisayshead' class = 'lisayshead'>4. Kuntotiedot</h2>";
                        echo "<br>";

                        echo "<label for='input_teoksen_kunto'>Teoksen kunto (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>";
                        echo "<input id='input_teoksen_kunto' class='teos' type='text' pattern='{2,60}' value = '$var29' name='teoksen_kunto' />";
                        echo "<br><br><br>";
                        echo "<label for='input_konservointiasiakirjat'>Konservointiasiakirjat (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>";
                        echo "<input id='input_konservointiasiakirjat' class='teos' type='text' pattern='{2,150}' value = '$var32' name='konservointiasiakirjat' />";
                        echo "<br><br><br>";
                        echo "<label for='input_hoito_id'> Hoito-id (olemassaoleva)</label>";
                        echo "<input id='input_hoito_id' class='teos' type='text' pattern='[0-9]{1,6}' value = '$var9' name='hoito_id' />";
                        
                        echo "<br>";
                        echo "<h2 class = 'lisayshead'>5. Poisto</h2>";
                        echo "<br>";

                        echo "<label for='input_aktiivisuustila'> Aktiivisuustila (0 eli ei-aktiivinen tai 1 eli aktiivinen)</label>";
                        echo "<input id='input_aktiivisuustila' class='teos' type='text' pattern='[0-1]{1}' value = '$var4' name='aktiivisuustila' required />";
                        echo "<br><br><br>";
                        echo "<label for='input_poistoperuste'>Poistoperuste (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>";
                        echo "<input id='input_poistoperuste' class='teos' type='text' pattern='{2,60}' value = '$var5' name='poistoperuste' />";
                        echo "<br><br><br>";
                        echo "<label for='input_poistoajankohta'>Poistoajankohta (muotoa 2000-01-31)</label>";
                        echo "<input id='input_poistoajankohta' class='teos' type='date' value = '$var41' name='poistoajankohta' />";
                        echo "<br><br><br>";
                        echo "<h2 class = 'lisayshead'>6. Sijoitus</h2>";
                        echo "<br><br><br>";
                        echo "<label for='input_Sijoitus_id'> Sijoitus-id (olemassaoleva)</label>";
                        echo "<input id='input_Sijoitus_id' class='teos' type='text' pattern='[0-9]{1,6}' value = '$var10' name='sijoitus_id' />";
                        
                        echo "<br>";
                        echo "<h2 class = 'lisayshead'>7. Hankintatiedot</h2>";
                        echo "<br>";

                        echo "<label for='input_hankintatapa'>Hankintatapa (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>";
                        echo "<input id='input_hankintatapa' class='teos' type='text' pattern='{2,60}' value = '$var16' name='hankintatapa' />";
                        echo "<br><br><br>";
                        echo "<label for='input_hankintahinta'> Hankintahinta (enint‰‰n 10 merkki‰ joista 2 on desimaaleja, erota desimaalit pisteell‰)</label>";
                        echo "<input id='input_hankintahinta' class='teos' type='text' pattern='[0-9.]{0,10}' value = '$var17' name='hankintahinta' />";
                        echo "<br><br><br>";
                        echo "<label for='input_hankinta_aika'>Hankinta-aika (muotoa 2000-01-31)</label>";
                        echo "<input id='input_hankinta_aika' class='teos' type='date' value = '$var19' name='hankinta_aika' pattern='.{6,}' />";
                        echo "<br><br><br>";
                        echo "<label for='input_hankintapaikka'>Hankintapaikka (v‰hint‰‰n 2 merkki‰, enint‰‰n 20 merkki‰)</label>";
                        echo "<input id='input_hankintapaikka' class='teos' type='text' pattern='{2,60}' value = '$var20' name='hankinta_paikka' />";
                        echo "<br><br><br>";
                        echo "<label for='input_omistajuushistoria'>Omistajuushistoria (v‰hint‰‰n 2 merkki‰, enint‰‰n 100 merkki‰)</label>";
                        echo "<input id='input_omistajuushistoria' class='teos' type='text' pattern='{2,100}' value = '$var18' name='omistajuushistoria' />"; 
                        
                        echo "<br>";                            
                        echo "<h2 class = 'lisayshead'>8. Arvotiedot</h2>";
                        echo "<br>";
                        
                        echo "<label for='input_vakuutusarvo'> Vakuutusarvo (enint‰‰n 10 merkki‰ joista 2 on desimaaleja, erota desimaliit pisteell‰)</label>";
                        echo "<input id='input_vakuutusarvo' class='teos' type='text' pattern='[0-9.]{0,10}' value = '$var33' name='vakuutusarvo' />";
                        echo "<br><br><br>";
                        echo "<label for='input_vakuutusarvon_selite'>Vakuutusarvon selite (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>";
                        echo "<input id='input_vakuutusarvon_selite' class='teos' type='text' pattern='{2,150}' value = '$var34' name='vakuutusarvon_selite' />";
                        
                        echo "<br>";
                        echo "<h2 class = 'lisayshead'>9. Tekij‰noikeustiedot</h2>";
                        echo "<br>";

                        echo "<label for='input_tekijanoikeustiedot'>Tekij‰noikeustiedot (v‰hint‰‰n 2 merkki‰, enint‰‰n 100 merkki‰)</label>";
                        echo "<input id='input_tekijanoikeustiedot' class='teos' type='text' pattern='{2,100}' value = '$var27' name='tekijanoikeustiedot' />";
                        echo "<br><br><br>";
                        echo "<label for='input_tekijanoikeuden_vapautuminen'>Tekij‰noikeuden vapautuminen (muotoa 2000-01-31)</label>";
                        echo "<input id='input_tekijanoikeuden_vapautuminen' class='teos' type='date' value = '$var28' name='tekijanoikeuden_vapautuminen' pattern='.{6,}' />";
                        
                        echo "<br>";
                        echo "<h2 class = 'lisayshead'>10. Kuvatiedot</h2>";
                        echo "<br>";
                        echo "<h2 class = 'lisayshead'>11. Arkisto- ja tutkimusmateriaali</h2>";
                        echo "<br>";

                        echo "<label for='input_tutkimusmateriaali'>Tutkimusmateriaali (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>";
                        echo "<input id='input_tutkimusmateriaali' class='teos' type='text' pattern='{2,150}' value = '$var31' name='tutkimusmateriaali' />";
                        echo "<br><br><br>";
                        echo "<label for='input_nayttelytiedot'>N‰yttelytiedot (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>";
                        echo "<input id='input_nayttelytiedot' class='teos' type='text' pattern='{2,150}' value = '$var36' name='nayttelytiedot' />";
                        
                        echo "<br>";
                        echo "<h2 class = 'lisayshead'>12. Muuta</h2>";              
                        echo "<br>";

                        echo "<label for='input_muutieto'>Muu tieto (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>";
                        echo "<input id='input_muutieto' class='teos' type='text' pattern='{2,150}' value = '$var35' name='muu_tieto' />";
                        echo "<br><br><br>";                           
                        echo "<input type='submit'  name='muokkaa_teos' value='Muokkaa' />";
                        echo "<br>";
                        }
                    echo "</fieldset>";
                echo "</form>";
                echo "</div>";

            echo "<a href='index.php' class = 'peru'>Peruuta</a>";
        echo "</body>";

                }
                else{
                    echo "<p class = 'vp'>";
                    echo "Teosta ei lˆytynyt";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                }

            }
            else{
                echo "<p class = 'vp'>";
                echo "Virhe tietokantaan yhdist‰misess‰";
                echo "</p>";
                echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
            }
            
    }

    private function PaivitaTeos(){
        $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {

               $teos_id = $_POST['teos_id'];
             
               $nimi = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['nimi'], ENT_QUOTES));  

               $deponoitu = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['deponoitu'], ENT_QUOTES));

               $aktiivisuustila = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST["aktiivisuustila"], ENT_QUOTES));

               $poistoperuste = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['poistoperuste'], ENT_QUOTES));  

               $inventaarionumero = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['inventaarionumero'], ENT_QUOTES));

               $paaluokka = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['paaluokka'], ENT_QUOTES));

               $erikoisluokka = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['erikoisluokka'], ENT_QUOTES));

               $hoito_id = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['hoito_id'], ENT_QUOTES));  

               $sijoitus_id = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['sijoitus_id'], ENT_QUOTES));

               $taiteilija_id = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['taiteilija_id'], ENT_QUOTES));

               $omistaja = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST["omistaja"], ENT_QUOTES));

               $kokoelman_nimi = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kokoelman_nimi'], ENT_QUOTES));  

               $teoksen_aiemmat_nimet = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['teoksen_aiemmat_nimet'], ENT_QUOTES));

               $tekohetki = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['tekohetki'], ENT_QUOTES));

               $hankintatapa = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST["hankintatapa"], ENT_QUOTES));

               $hankintahinta = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['hankintahinta'], ENT_QUOTES));  

               $omistajuushistoria = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['omistajuushistoria'], ENT_QUOTES));

               $hankinta_aika = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['hankinta_aika'], ENT_QUOTES));

               $hankinta_paikka = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST["hankinta_paikka"], ENT_QUOTES));

               $tekniikka = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['tekniikka'], ENT_QUOTES));  

               $teoksen_mitat = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['teoksen_mitat'], ENT_QUOTES));

               $kehyksen_mitat = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kehyksen_mitat'], ENT_QUOTES));

               $kehyksen_materiaali = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST["kehyksen_materiaali"], ENT_QUOTES));

               $etupuolen_merkinnat = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['etupuolen_merkinnat'], ENT_QUOTES));  

               $takapuolen_merkinnat = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['takapuolen_merkinnat'], ENT_QUOTES));

               $tekijanoikeustiedot = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['tekijanoikeustiedot'], ENT_QUOTES));

               $tekijanoikeuden_vapautuminen = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST["tekijanoikeuden_vapautuminen"], ENT_QUOTES));

               $teoksen_kunto = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['teoksen_kunto'], ENT_QUOTES));  

               $sisalto_kuvailu = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['sisalto_kuvailu'], ENT_QUOTES));

               $tutkimusmateriaali = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['tutkimusmateriaali'], ENT_QUOTES));

               $konservointiasiakirjat = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST["konservointiasiakirjat"], ENT_QUOTES));

               $vakuutusarvo = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['vakuutusarvo'], ENT_QUOTES));  

               $vakuutusarvon_selite = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['vakuutusarvon_selite'], ENT_QUOTES));

               $muu_tieto = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST["muu_tieto"], ENT_QUOTES));

               $nayttelytiedot = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST["nayttelytiedot"], ENT_QUOTES));

               $aukon_mitat = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['aukon_mitat'], ENT_QUOTES));  

               $kuva_alan_mitat = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kuva_alan_mitat'], ENT_QUOTES));  

               $jalustan_mitat = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['jalustan_mitat'], ENT_QUOTES));

               $jalustan_materiaalit= $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['jalustan_materiaalit'], ENT_QUOTES));

               $poistoajankohta= $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['poistoajankohta'], ENT_QUOTES));

               $sql = "UPDATE TEOS SET nimi = '" . $nimi . "', deponoitu = '" . $deponoitu . "', aktiivisuustila = '" . $aktiivisuustila . "', poistoperuste = '" . $poistoperuste . "', inventaarionumero = '" . $inventaarionumero . "', paaluokka = '" . $paaluokka . "', erikoisluokka = '" . $erikoisluokka . "', hoito_id = '" . $hoito_id . "', sijoitus_id = '" . $sijoitus_id . "', taiteilija_id = '" . $taiteilija_id . "', omistaja = '" . $omistaja . "', kokoelman_nimi = '" . $kokoelman_nimi . "', teoksen_aiemmat_nimet = '" . $teoksen_aiemmat_nimet . "', tekohetki = '" . $tekohetki . "', hankintatapa = '" . $hankintatapa . "', hankintahinta = '" . $hankintahinta . "', omistajuushistoria = '" . $omistajuushistoria . "', hankinta_aika = '" . $hankinta_aika . "', hankinta_paikka = '" . $hankinta_paikka . "', tekniikka = '" . $tekniikka . "', teoksen_mitat = '" . $teoksen_mitat . "', kehyksen_mitat = '" . $kehyksen_mitat . "', kehyksen_materiaali = '" . $kehyksen_materiaali . "', etupuolen_merkinnat = '" . $etupuolen_merkinnat . "', takapuolen_merkinnat = '" . $takapuolen_merkinnat . "', tekijanoikeustiedot = '" . $tekijanoikeustiedot . "', tekijanoikeuden_vapautuminen = '" . $tekijanoikeuden_vapautuminen . "', teoksen_kunto = '" . $teoksen_kunto . "', sisalto_kuvailu = '" . $sisalto_kuvailu . "', tutkimusmateriaali = '" . $tutkimusmateriaali . "', konservointiasiakirjat = '" . $konservointiasiakirjat . "', vakuutusarvo = '" . $vakuutusarvo . "', vakuutusarvon_selite = '" . $vakuutusarvon_selite . "', muu_tieto = '" . $muu_tieto . "', nayttelytiedot = '" . $nayttelytiedot . "', aukon_mitat = '" . $aukon_mitat . "', kuva_alan_mitat = '" . $kuva_alan_mitat . "', jalustan_mitat = '" . $jalustan_mitat . "', jalustan_materiaalit = '" . $jalustan_materiaalit . "', poistoajankohta = '" . $poistoajankohta . "' WHERE teos_id = '" . $teos_id . "';";

                $tunnuksen_update = $this->tietokanta_yhteys->query($sql);
                    // Jos taiteilijan lis‰‰minen onnistui
                if ($tunnuksen_update) {
                    echo "<p class = 'vp'>";
                    echo "Teos p‰ivitettiin onnistuneesti.";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                }
                else {
                    echo "<p class = 'vp'>";
                    echo "P‰ivittaminen ep‰onnistui, yrit‰ uudelleen..";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                }
            }

    }

    private function MuokkaaSijoitus(){
        echo "<body>";

        echo "<head>";
            echo "<link rel = 'stylesheet' type = 'text/css' href = 'nakymat/Lisaystyylit.css?version=51'>";
            echo "<script type= 'text/javascript' src= 'modernizr-latest.js'></script>";
            echo "<meta name=viewport content= 'width=device-width, initial-scale=1'>";
        echo "</head>";

            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $muokkausmuuttuja = $this->tietokanta_yhteys->real_escape_string($_POST["muokkausmuuttuja"]);
                $sql = "SELECT *
                        FROM SIJOITUSHISTORIA
                        WHERE sijoitus_id = '" . $muokkausmuuttuja . "';";
 
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                if ($haku_varmentaminen_tulos->num_rows == 1) {
                    echo "<div class = 'muokkausdiv'>";
                    echo "<form method= 'post' action= 'muokkaaminen.php'  class = 'muoksf' name= 'muokkausform'>";
                        echo "<fieldset class = 'msijoitus'>";
                            echo '<legend>Muokkaa sijoitushistorian tietoja</legend>';

                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        $var1 = $tulosrivi['sijoitus_id'];
                        $var2 = $tulosrivi["varasto"];
                        $var3 = $tulosrivi["kerros"];
                        $var4 = $tulosrivi["tilanumero"];
                        $var5 = $tulosrivi["osasto"];
                        $var6 = $tulosrivi["alku_pvm"];
                        $var7 = $tulosrivi["loppu_pvm"];
                        $var8 = $tulosrivi["vapaat_tiedot"];
                        $var9 = $tulosrivi["rakennus_id"];

                        echo "<label for='input_id'>Sijoitushistorian ID</label>";
                        echo "<input id='input_kerros' class='sijoitushistoria' type='int' pattern='[0-9]' name='sijoitus_id' value = '$var1' readonly='readonly' />";
                        echo "<br><br><br>";
                        echo "<label for='input_varasto'> Varasto (1 eli on tai 0 eli ei ole)</label>";
                        echo "<input id='input_varasto' class='sijoitushistoria' type='text' pattern='[0-1]{0,1}' name='varasto' value = '$var2' />";
                        echo "<br><br><br>";
                        echo "<label for='input_kerros'>Kerros</label>";
                        echo "<input id='input_kerros' class='sijoitushistoria' type='int' pattern='[0-9]{1,2}' name='kerros' value = '$var3' />";
                        echo "<br><br><br>";
                        echo "<label for='input_tilanumero'>Tilanumero</label>";
                        echo "<input id='input_tilanumero' class='sijoitushistoria' type='text' pattern='{2,30}' name='tilanumero' value = '$var4' />";
                        echo "<br><br><br>";
                        echo "<label for='input_osasto'>Osasto</label>";
                        echo "<input id='input_tilanumero' class='sijoitushistoria' type='text' pattern='{2,30}' name='osasto' value = '$var5' />";
                        echo "<br><br><br>";
                        echo "<label for='input_alkupvm'>Alkup‰iv‰m‰‰r‰ (muotoa 2000-01-31)</label>";
                        echo "<input id='input_alkupvm' class='sijoitushistoria' type='date' name='alku_pvm' value = '$var6' pattern='.{6,}' />";
                        echo "<br><br><br>";
                        echo "<label for='input_loppupvm'>Loppup‰iv‰m‰‰r‰ (muotoa 2000-12-31) </label>";
                        echo "<input id='input_loppupvm' class='sijoitushistoria' type='date' name='loppu_pvm' value = '$var7' pattern='.{6,}'  />";
                        echo "<br><br><br>";
                        echo "<label for='input_vapaat_tiedot'>Vapaat tiedot</label>";
                        echo "<input id='input_vapaat_tiedot' class='sijoitushistoria' type='text' pattern='{2,200}' name='vapaat_tiedot' value = '$var8' />";
                        echo "<br><br><br>";
                        echo "<label for='input_rakennus_id'> Rakennus-id</label>";
                        echo "<input id='input_rakennus_id' class='sijoitushistoria' type='text' pattern='[0-9]{1,4}' name='rakennus_id' value = '$var9' readonly='readonly' required />";
                        echo "<br><br><br>";
                        echo "<input type='submit'  name='muokkaa_sijoitus' value='Muokkaa' />";
                        echo "<br>";
                    }
                echo "</fieldset>";
            echo "</form>";
            echo "</div>";

            echo "<a href='index.php' class = 'peru'>Peruuta</a>";
        echo "</body>";

                }
                else{
                    echo "<p class = 'vp'>";
                    echo "Sijoitusta ei lˆytynyt";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                }

            }
            else{
                echo "<p class = 'vp'>";
                echo "Virhe tietokantaan yhdist‰misess‰";
                echo "</p>";
                echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
            }
    }



    private function PaivitaSijoitus(){
        $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
             
                $sijoitus_id = $_POST['sijoitus_id'];
                $varasto = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['varasto'], ENT_QUOTES));
                $kerros = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kerros'], ENT_QUOTES));
                $tilanumero = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['tilanumero'], ENT_QUOTES));
                $osasto = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['osasto'], ENT_QUOTES));
                $alku_pvm = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['alku_pvm'], ENT_QUOTES));
                $loppu_pvm = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['loppu_pvm'], ENT_QUOTES));
                $vapaat_tiedot = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['vapaat_tiedot'], ENT_QUOTES));
                $rakennus_id = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['rakennus_id'], ENT_QUOTES));

                $sql = "UPDATE SIJOITUSHISTORIA SET varasto = '" . $varasto . "', kerros = '" . $kerros . "', tilanumero = '" . $tilanumero . "', osasto = '" . $osasto . "', alku_pvm = '" . $alku_pvm . "', loppu_pvm = '" . $loppu_pvm . "', vapaat_tiedot = '" . $vapaat_tiedot . "'
                       WHERE sijoitus_id = '" . $sijoitus_id . "';";
                $tunnuksen_update = $this->tietokanta_yhteys->query($sql);
                    // Jos taiteilijan lis‰‰minen onnistui
                if ($tunnuksen_update) {
                    echo "<p class = 'vp'>";
                    echo "Sijoitus p‰ivitettiin onnistuneesti.";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                } else {
                    echo "<p class = 'vp'>";
                    echo "P‰ivitt‰minen ep‰onnistui, yrit‰ uudelleen..";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                }
            }
    }




    private function MuokkaaHoito(){
        echo "<body>";

        echo "<head>";
            echo "<link rel = 'stylesheet' type = 'text/css' href = 'nakymat/Lisaystyylit.css?version=51'>";
            echo "<script type= 'text/javascript' src= 'modernizr-latest.js'></script>";
            echo "<meta name=viewport content= 'width=device-width, initial-scale=1'>";
        echo "</head>";

            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $muokkausmuuttuja = $this->tietokanta_yhteys->real_escape_string($_POST["muokkausmuuttuja"]);
                $sql = "SELECT *
                        FROM HOITOHISTORIA
                        WHERE hoito_id = '" . $muokkausmuuttuja . "';";
 
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                if ($haku_varmentaminen_tulos->num_rows == 1) {
                    echo "<div class = 'muokkausdiv'>";
                    echo "<form method= 'post' action= 'muokkaaminen.php'  class = 'muoksf' name= 'muokkausform'>";
                        echo "<fieldset class = 'mhoito'>";
                            echo '<legend>Muokkaa hoitohistorian tietoja</legend>';

                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        $var1 = $tulosrivi['hoito_id'];
                        $var2 = $tulosrivi["paivamaara"];
                        $var3 = $tulosrivi["toimenpide"];
                        $var5 = $tulosrivi["tekija"];

                        echo "<label for='input_pvm'>Hoitohistorian ID</label>";
                        echo "<input id='input_pvm' class='hoitohistoria' type='text' name='hoito_id' required/>";
                        echo "<br><br><br>";
                        echo "<label for='input_pvm'>P‰iv‰m‰‰r‰</label>";
                        echo "<input id='input_pvm' class='hoitohistoria' type='date' name='paivamaara' pattern='.{6,}' required/>";
                        echo "<br><br><br>";
                        echo "<label for='input_toimenpide'>Toimenpide</label>";
                        echo "<input id='input_toimenpide' class='hoitohistoria' type='text' pattern='{2,100}' name='toimenpide' required/>";
                        echo "<br><br><br>";
                        echo "<label for='input_tekija'>Tekij‰</label>";
                        echo "<input id='input_tekija' class='hoitohistoria' type='text' pattern='{2,30}' name='tekija' required/>";
                        echo "<br><br><br>";
                        echo "<input type='submit'  name='muokkaa_hoito' value='Lisaa hoitohistoriaan' />";
                        }
                    echo "</fieldset>";
                echo "</form>";
                echo "</div>";

            echo "<a href='index.php' class = 'peru'>Peruuta</a>";
        echo "</body>";

                }
                else{
                    echo "<p class = 'vp'>";
                    echo "Hoitotoimenpidetta ei lˆytynyt";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                }

            }
            else{
                echo "<p class = 'vp'>";
                echo "Virhe tietokantaan yhdist‰misess‰";
                echo "</p>";
                echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
            }

    }



    private function PaivitaHoito(){
        $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
             
                $hoito_id = $_POST['hoito_id'];
                $paivamaara = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['paivamaara'], ENT_QUOTES));
                $toimenpide = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['toimenpide'], ENT_QUOTES));
                $tekija = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['tekija'], ENT_QUOTES));

                $sql = "UPDATE HOITOHISTORIA SET paivamaara = '" . $paivamaara . "', toimenpide = '" . $toimenpide . "', tekija = '" . $tekija . "'
                       WHERE sijoitus_id = '" . $sijoitus_id . "';";
                $tunnuksen_update = $this->tietokanta_yhteys->query($sql);
                    // Jos taiteilijan lis‰‰minen onnistui
                if ($tunnuksen_update) {
                    echo "<p class = 'vp'>";
                    echo "Hoitotoimenpide p‰ivitettiin onnistuneesti.";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                } else {
                    echo "<p class = 'vp'>";
                    echo "P‰ivitt‰minen ep‰onnistui, yrit‰ uudelleen..";
                    echo "</p>";
                    echo "<br><br><br><a class = 'ilmoitukset_a' href='index.php'>Takaisin p‰‰valikkoon</a>";
                }
            }

    }



}