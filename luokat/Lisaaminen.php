<?php

class Lisaaminen{
    /**
     * @var object $tietokanta_yhteys 
     */
    private $tietokanta_yhteys = null;
    /**
     * @var array $virheet Virhe ilmoitukset
     */
    public $virheet = array();
    /**
     * @var array $ilmoitukset 
     */
    public $ilmoitukset = array();
    /**
     * Funktio "__construct()" automaattisesti aloittaa toiminnan kun t‰m‰n luokan olio on luotu,
     * "$registration = new Registration();"
     */
  
    public function __construct(){

        if (isset($_POST["lisays_taiteilija"])) {
            $this->lisaa_uusi_taiteilija();
            /*header('Location: nakymat/lisaa_taiteilija.php');*/
        }
         elseif (isset($_POST["lisays_rakennus"])) {
            $this->lisaa_uusi_rakennus();
            //header('Location: nakymat/lisaa_rakennus.php');
        }
         elseif (isset($_POST["lisays_teos"])) {
            $this->lisaa_uusi_teos();
            //header('Location: nakymat/lisaa_teos.php');
        }
        elseif (isset($_POST["lisays_hoitohistoria"])) {
            $this->lisaa_uusi_hoitohistoria();
            //header('Location: nakymat/lisaa_hoitohistoria.php');
        }
         elseif (isset($_POST["lisays_sijoitushistoria"])) {
            $this->lisaa_uusi_sijoitushistoria();
            //header('Location: nakymat/lisaa_sijoitushistoria.php');
        }
    }
    /**
     * K‰sittelee ja toteuttaa lis‰ysprosessin. Tarkastaa virheiden varalta
     * ja luo uuden hoitohistoriatiedon jos kaikki on ok
     */
    private function lisaa_uusi_hoitohistoria(){
        
            // Luodaan tietokantayhteys
        $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
        if (!$this->tietokanta_yhteys->set_charset("utf8")) {
            $this->virheet[] = $this->tietokanta_yhteys->virhe;
        }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
        if (!$this->tietokanta_yhteys->connect_errno) {

            $paivamaara = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['paivamaara'], ENT_QUOTES));
            $toimenpide = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['toimenpide'], ENT_QUOTES));
            $tekija = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['tekija'], ENT_QUOTES));
           

           
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan
                $sql = "INSERT INTO HOITOHISTORIA (paivamaara, toimenpide, tekija)
                            VALUES('" . $paivamaara . "', '" . $toimenpide . "', '" . $tekija . "');"; 
                $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos taiteilijan lis‰‰minen onnistui
                if ($tunnuksen_insert) {
                    echo "<p class = 'vp'>";
                    echo "Hoitohistoriaan lis‰ys onnistui.";
                    echo "</p>";
                }
                else {
                    echo "<p class = 'vp'>";
                    echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                    echo "</p>";
                }
            }
        
        else {
            echo "<p class = 'vp'>";
            echo "Yhteyden muodostaminen tietokantaan ep‰onnistui.";
            echo "</p>";
        }
    } 
     /**
     * K‰sittelee ja toteuttaa lis‰ysprosessin. Tarkastaa virheiden varalta
     * ja luo uuden sijoitushistoriatiedon jos kaikki on ok
     */
    private function lisaa_uusi_sijoitushistoria(){

            // Luodaan tietokantayhteys
        $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
        if (!$this->tietokanta_yhteys->set_charset("utf8")) {
            $this->virheet[] = $this->tietokanta_yhteys->virhe;
        }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
        if (!$this->tietokanta_yhteys->connect_errno) {

            $varasto = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['varasto'], ENT_QUOTES));
            $kerros = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kerros'], ENT_QUOTES));
            $tilanumero = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['tilanumero'], ENT_QUOTES));
            $osasto = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['osasto'], ENT_QUOTES));
            $alku_pvm = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['alku_pvm'], ENT_QUOTES));
            $loppu_pvm = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['loppu_pvm'], ENT_QUOTES));
            $vapaat_tiedot = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['vapaat_tiedot'], ENT_QUOTES));
            $rakennus_id = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['rakennus_id'], ENT_QUOTES));

            
                    // Kirjoitetaan sijoitushistorian lis‰yksen tiedot tietokantaan
                $sql = "INSERT INTO SIJOITUSHISTORIA (varasto, kerros, tilanumero, osasto, alku_pvm, loppu_pvm, vapaat_tiedot, rakennus_id)
                            VALUES('" . $varasto . "', '" . $kerros . "', '" . $tilanumero . "', '" . $osasto . "', '" . $alku_pvm . "', '" . $loppu_pvm . "', '" . $vapaat_tiedot . "', '" . $rakennus_id . "');"; 
                $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos lis‰‰minen onnistui
                if ($tunnuksen_insert) {
                    echo "<p class = 'vp'>";
                    echo "Sijoitushistorian merkint‰ lis‰ttiin onnistuneesti.";
                    echo "</p>";
                }
                else {
                    echo "<p class = 'vp'>";
                    echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                    echo "</p>";
                }
            
        }
        else {
            echo "<p class = 'vp'>";
            echo "Yhteyden muodostaminen tietokantaan ep‰onnistui.";
            echo "</p>";
        }
    } 
    private function lisaa_uusi_taiteilija(){

            // Luodaan tietokantayhteys
        $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
        if (!$this->tietokanta_yhteys->set_charset("utf8")) {
            $this->virheet[] = $this->tietokanta_yhteys->virhe;
        }
            // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
        if (!$this->tietokanta_yhteys->connect_errno) {

            $nimi = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['nimi'], ENT_QUOTES));
            $syntyma_aika = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['syntyma_aika'], ENT_QUOTES));
            $kuolinaika = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kuolinaika'], ENT_QUOTES));
            $syntymapaikka = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['syntymapaikka'], ENT_QUOTES));
            $koulutus = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['koulutus'], ENT_QUOTES));
            $palkinnot = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['palkinnot'], ENT_QUOTES));
            $kirjallisuusviite = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kirjallisuusviite'], ENT_QUOTES));

            $sql = "SELECT * FROM TAITEILIJAT WHERE nimi = '" . $nimi . "'";
            $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);

            if ($tarkasta_nimi->num_rows == 1) {
                echo "<p class = 'vp'>";
                echo "Taiteilija on jo tietokannassa";
                echo "</p>";
            }
            else {
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan
                $sql = "INSERT INTO TAITEILIJAT (nimi, syntyma_aika, kuolinaika, syntymapaikka, koulutus, palkinnot, kirjallisuusviite)
                            VALUES('" . $nimi . "', '" . $syntyma_aika . "', '" . $kuolinaika . "', '" . $syntymapaikka . "', '" . $koulutus . "', '" . $palkinnot . "', '" . $kirjallisuusviite . "');"; 
                $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos taiteilijan lis‰‰minen onnistui
                if ($tunnuksen_insert) {
                    echo "<p class = 'vp'>";
                    echo "Taiteilija lis‰ttiin onnistuneesti.";
                    echo "</p>";
                }
                else {
                    echo "<p class = 'vp'>";
                    echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                    echo "</p>";
                }
            }
        }
        else {
            echo "<p class = 'vp'>";
            echo "Yhteyden muodostaminen tietokantaan ep‰onnistui.";
            echo "</p>";
        }
    } 



    private function lisaa_uusi_rakennus(){

            // Luodaan tietokantayhteys
        $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
        // Vaihdetaan utf8 encodeen ja tarkastetaan se
        if (!$this->tietokanta_yhteys->set_charset("utf8")) {
            $this->virheet[] = $this->tietokanta_yhteys->virhe;
        }
        // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
        if (!$this->tietokanta_yhteys->connect_errno) {

            $rakennuksen_nimi = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['rakennuksen_nimi'], ENT_QUOTES));
            $kerrokset = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['kerrokset'], ENT_QUOTES)); 
            $sql = "SELECT * FROM RAKENNUS WHERE rakennuksen_nimi = '" . $rakennuksen_nimi . "'";
            $tarkasta_rakennus = $this->tietokanta_yhteys->query($sql);

            if ($tarkasta_rakennus->num_rows == 1) {
                $this->virheet[] = "Rakennus on jo tietokannassa";
            }
            else {
                // Kirjoitetaan uuden rakennuksen tiedot tietokantaan
           
                $sql = "INSERT INTO RAKENNUS (rakennuksen_nimi, kerrokset)
                        VALUES('" . $rakennuksen_nimi . "', '" . $kerrokset . "');"; 
                $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                // Jos rakennuksen lis‰‰minen onnistui
                if ($tunnuksen_insert) {
                    echo "<p class = 'vp'>";
                    echo "Rakennus lis‰ttiin onnistuneesti.";
                    echo "</p>";
                }
                else {
                    echo "<p class = 'vp'>";
                    echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                    echo "</p>";
                }
            }
        }
        else {
            echo "<p class = 'vp'>";
            echo "Yhteyden muodostaminen tietokantaan ep‰onnistui.";
            echo "</p>";
        }
    }

    private function lisaa_uusi_teos(){
    
            // Luodaan tietokantayhteys
        $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
        // Vaihdetaan utf8 encodeen ja tarkastetaan se
        if (!$this->tietokanta_yhteys->set_charset("utf8")) {
            $this->virheet[] = $this->tietokanta_yhteys->virhe;
        }
        // Jos ei virheit‰ yhteydess‰ (= toimiva tietokantayhteys)
        if (!$this->tietokanta_yhteys->connect_errno) {

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

            $aiemmat_nimet = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['teoksen_aiemmat_nimet'], ENT_QUOTES));

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
            
            $jalustan_materiaalit = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['jalustan_materiaalit'], ENT_QUOTES));

            $poistoajankohta = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['poistoajankohta'], ENT_QUOTES));
                      
            if (strlen($taiteilija_id) == 0 && strlen($hoito_id) == 0 && strlen($sijoitus_id) == 0){

                $sql = "SELECT * FROM TEOS WHERE nimi = '" . $nimi . "'";
                
                $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);

                if ($tarkasta_nimi->num_rows == 1) {
                    echo "<p class = 'vp'>";
                    echo "Teos on jo tietokannassa";
                    echo "</p>";
                }
                else {
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan

                    $sql = "INSERT INTO TEOS (nimi, deponoitu, aktiivisuustila, poistoperuste, inventaarionumero, paaluokka, erikoisluokka, omistaja, kokoelman_nimi, teoksen_aiemmat_nimet, tekohetki, hankintatapa, hankintahinta, omistajuushistoria, hankinta_aika, hankinta_paikka, tekniikka, teoksen_mitat, kehyksen_mitat, kehyksen_materiaali, etupuolen_merkinnat, takapuolen_merkinnat, tekijanoikeustiedot, tekijanoikeuden_vapautuminen, teoksen_kunto, sisalto_kuvailu, tutkimusmateriaali, konservointiasiakirjat, vakuutusarvo, vakuutusarvon_selite, muu_tieto, nayttelytiedot, aukon_mitat, kuva_alan_mitat, jalustan_mitat, jalustan_materiaalit, poistoajankohta)
                        VALUES('" . $nimi . "', '" . $deponoitu . "', '" . $aktiivisuustila . "', '" . $poistoperuste . "', '" . $inventaarionumero . "', '" . $paaluokka . "', '" . $erikoisluokka . "', '" . $omistaja . "', '" . $kokoelman_nimi . "', '" . $aiemmat_nimet . "', '" . $tekohetki . "', '" . $hankintatapa . "', '" . $hankintahinta . "', '" . $omistajuushistoria . "', '" . $hankinta_aika . "', '" . $hankinta_paikka . "', '" . $tekniikka . "', '" . $teoksen_mitat . "', '" . $kehyksen_mitat . "', '" . $kehyksen_materiaali . "', '" . $etupuolen_merkinnat . "', '" . $takapuolen_merkinnat. "', '" . $tekijanoikeustiedot . "', '" . $tekijanoikeuden_vapautuminen . "', '" . $teoksen_kunto . "', '" . $sisalto_kuvailu . "', '" . $tutkimusmateriaali . "', '" . $konservointiasiakirjat . "', '" . $vakuutusarvo . "', '" . $vakuutusarvon_selite. "', '" . $muu_tieto . "', '" . $nayttelytiedot . "', '" . $aukon_mitat. "', '" . $kuva_alan_mitat . "', '" . $jalustan_mitat . "', '" . $jalustan_materiaalit  . "',  '" . $poistoajankohta . "');";
               
                    $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    if ($tunnuksen_insert) {
                        echo "<p class = 'vp'>";
                        echo "Teos lis‰ttiin onnistuneesti.";
                        echo "</p>";
                    }
                    else {
                        echo "<p class = 'vp'>";
                        echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                        echo "</p>";
                    }


                }
            }
            elseif (strlen($taiteilija_id) != 0 && strlen($hoito_id) == 0 && strlen($sijoitus_id) == 0){

                $sql = "SELECT * FROM TEOS WHERE nimi = '" . $nimi . "'";
                $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);

                if ($tarkasta_nimi->num_rows == 1) {
                    echo "<p class = 'vp'>";
                    echo "Teos on jo tietokannassa";
                    echo "</p>";
                }
                else {
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan
                    $sql = "INSERT INTO TEOS (nimi, deponoitu, aktiivisuustila, poistoperuste, inventaarionumero, paaluokka, erikoisluokka, taiteilija_id, omistaja, kokoelman_nimi, teoksen_aiemmat_nimet, tekohetki, hankintatapa, hankintahinta, omistajuushistoria, hankinta_aika, hankinta_paikka, tekniikka, teoksen_mitat, kehyksen_mitat, kehyksen_materiaali, etupuolen_merkinnat, takapuolen_merkinnat, tekijanoikeustiedot, tekijanoikeuden_vapautuminen, teoksen_kunto, sisalto_kuvailu, tutkimusmateriaali, konservointiasiakirjat, vakuutusarvo, vakuutusarvon_selite, muu_tieto, nayttelytiedot, aukon_mitat, kuva_alan_mitat, jalustan_mitat, jalustan_materiaalit, poistoajankohta)
                        VALUES('" . $nimi . "', '" . $deponoitu . "', '" . $aktiivisuustila . "', '" . $poistoperuste . "', '" . $inventaarionumero . "', '" . $paaluokka . "', '" . $erikoisluokka . "', '" . $taiteilija_id . "', '" . $omistaja . "', '" . $kokoelman_nimi . "', '" . $aiemmat_nimet . "', '" . $tekohetki . "', '" . $hankintatapa . "', '" . $hankintahinta . "', '" . $omistajuushistoria . "', '" . $hankinta_aika . "', '" . $hankinta_paikka . "', '" . $tekniikka . "', '" . $teoksen_mitat . "', '" . $kehyksen_mitat . "', '" . $kehyksen_materiaali . "', '" . $etupuolen_merkinnat . "', '" . $takapuolen_merkinnat. "', '" . $tekijanoikeustiedot . "', '" . $tekijanoikeuden_vapautuminen . "', '" . $teoksen_kunto . "', '" . $sisalto_kuvailu . "', '" . $tutkimusmateriaali . "', '" . $konservointiasiakirjat . "', '" . $vakuutusarvo . "', '" . $vakuutusarvon_selite. "', '" . $muu_tieto . "', '" . $nayttelytiedot . "', '" . $aukon_mitat. "', '" . $kuva_alan_mitat . "', '" . $jalustan_mitat . "', '" . $jalustan_materiaalit  . "', '" . $poistoajankohta . "');";
        
                    $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos teoksen lis‰‰minen onnistui
                    if ($tunnuksen_insert) {
                        echo "<p class = 'vp'>";
                        echo "Teos lis‰ttiin onnistuneesti.";
                        echo "</p>";
                    }
                    else {
                        echo "<p class = 'vp'>";
                        echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                        echo "</p>";
                    }
                }
            }
            elseif (strlen($taiteilija_id) != 0 && strlen($hoito_id) != 0 && strlen($sijoitus_id) == 0){

                $sql = "SELECT * FROM TEOS WHERE nimi = '" . $nimi . "'";
                $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);

                if ($tarkasta_nimi->num_rows == 1) {
                    echo "<p class = 'vp'>";
                    echo "Teos on jo tietokannassa";
                    echo "</p>";
                }
                else {
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan
                    $sql = "INSERT INTO TEOS (nimi, deponoitu, aktiivisuustila, poistoperuste, inventaarionumero, paaluokka, erikoisluokka, taiteilija_id, hoito_id, omistaja, kokoelman_nimi, teoksen_aiemmat_nimet, tekohetki, hankintatapa, hankintahinta, omistajuushistoria, hankinta_aika, hankinta_paikka, tekniikka, teoksen_mitat, kehyksen_mitat, kehyksen_materiaali, etupuolen_merkinnat, takapuolen_merkinnat, tekijanoikeustiedot, tekijanoikeuden_vapautuminen, teoksen_kunto, sisalto_kuvailu, tutkimusmateriaali, konservointiasiakirjat, vakuutusarvo, vakuutusarvon_selite, muu_tieto, nayttelytiedot, aukon_mitat, kuva_alan_mitat, jalustan_mitat, jalustan_materiaalit, poistoajankohta)
                        VALUES('" . $nimi . "', '" . $deponoitu . "', '" . $aktiivisuustila . "', '" . $poistoperuste . "', '" . $inventaarionumero . "', '" . $paaluokka . "', '" . $erikoisluokka . "', '" . $taiteilija_id . "', '" . $hoito_id . "','" . $omistaja . "', '" . $kokoelman_nimi . "', '" . $aiemmat_nimet . "', '" . $tekohetki . "', '" . $hankintatapa . "', '" . $hankintahinta . "', '" . $omistajuushistoria . "', '" . $hankinta_aika . "', '" . $hankinta_paikka . "', '" . $tekniikka . "', '" . $teoksen_mitat . "', '" . $kehyksen_mitat . "', '" . $kehyksen_materiaali . "', '" . $etupuolen_merkinnat . "', '" . $takapuolen_merkinnat. "', '" . $tekijanoikeustiedot . "', '" . $tekijanoikeuden_vapautuminen . "', '" . $teoksen_kunto . "', '" . $sisalto_kuvailu . "', '" . $tutkimusmateriaali . "', '" . $konservointiasiakirjat . "', '" . $vakuutusarvo . "', '" . $vakuutusarvon_selite. "', '" . $muu_tieto . "', '" . $nayttelytiedot . "', '" . $aukon_mitat. "', '" . $kuva_alan_mitat . "', '" . $jalustan_mitat . "', '" . $jalustan_materiaalit  . "', '" . $poistoajankohta . "');";
               
                    $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos teoksen lis‰‰minen onnistui
                    if ($tunnuksen_insert) {
                        echo "<p class = 'vp'>";
                        echo "Teos lis‰ttiin onnistuneesti.";
                        echo "</p>";
                    }
                    else {
                        echo "<p class = 'vp'>";
                        echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                        echo "</p>";
                    }
                }
            } 
            elseif (strlen($taiteilija_id) != 0 && strlen($hoito_id) != 0 && strlen($sijoitus_id) != 0){

                $sql = "SELECT * FROM TEOS WHERE nimi = '" . $nimi . "'";
                $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);

                if ($tarkasta_nimi->num_rows == 1) {
                    echo "<p class = 'vp'>";
                    echo "Teos on jo tietokannassa";
                    echo "</p>";
                }
                else {
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan

                    $sql = "INSERT INTO TEOS (nimi, deponoitu, aktiivisuustila, poistoperuste, inventaarionumero, paaluokka, erikoisluokka, hoito_id, sijoitus_id, taiteilija_id, omistaja, kokoelman_nimi, teoksen_aiemmat_nimet, tekohetki, hankintatapa, hankintahinta, omistajuushistoria, hankinta_aika, hankinta_paikka, tekniikka, teoksen_mitat, kehyksen_mitat, kehyksen_materiaali, etupuolen_merkinnat, takapuolen_merkinnat, tekijanoikeustiedot, tekijanoikeuden_vapautuminen, teoksen_kunto, sisalto_kuvailu, tutkimusmateriaali, konservointiasiakirjat, vakuutusarvo, vakuutusarvon_selite, muu_tieto, nayttelytiedot, aukon_mitat, kuva_alan_mitat, jalustan_mitat, jalustan_materiaalit, poistoajankohta)
                        VALUES('" . $nimi . "', '" . $deponoitu . "', '" . $aktiivisuustila . "', '" . $poistoperuste . "', '" . $inventaarionumero . "', '" . $paaluokka . "', '" . $erikoisluokka . "', '" . $hoito_id . "', '" . $sijoitus_id . "', '" . $taiteilija_id . "', '" . $omistaja . "', '" . $kokoelman_nimi . "', '" . $aiemmat_nimet . "', '" . $tekohetki . "', '" . $hankintatapa . "', '" . $hankintahinta . "', '" . $omistajuushistoria . "', '" . $hankinta_aika . "', '" . $hankinta_paikka . "', '" . $tekniikka . "', '" . $teoksen_mitat . "', '" . $kehyksen_mitat . "', '" . $kehyksen_materiaali . "', '" . $etupuolen_merkinnat . "', '" . $takapuolen_merkinnat. "', '" . $tekijanoikeustiedot . "', '" . $tekijanoikeuden_vapautuminen . "', '" . $teoksen_kunto . "', '" . $sisalto_kuvailu . "', '" . $tutkimusmateriaali . "', '" . $konservointiasiakirjat . "', '" . $vakuutusarvo . "', '" . $vakuutusarvon_selite. "', '" . $muu_tieto . "', '" . $nayttelytiedot . "', '" . $aukon_mitat. "', '" . $kuva_alan_mitat . "', '" . $jalustan_mitat . "', '" . $jalustan_materiaalit  . "', '" . $poistoajankohta . "');";

                    $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos teoksen lis‰‰minen onnistui
                    if ($tunnuksen_insert) {
                        echo "<p class = 'vp'>";
                        echo "Teos lis‰ttiin onnistuneesti.";
                        echo "</p>";
                    }
                    else {
                        echo "<p class = 'vp'>";
                        echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                        echo "</p>";
                    }
                }
            }
            elseif (strlen($taiteilija_id) == 0 && strlen($hoito_id) != 0 && strlen($sijoitus_id) != 0){

                $sql = "SELECT * FROM TEOS WHERE nimi = '" . $nimi . "'";
                $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);

                if ($tarkasta_nimi->num_rows == 1) {
                    echo "<p class = 'vp'>";
                    echo "Teos on jo tietokannassa";
                    echo "</p>";
                }
                else {
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan

                    $sql = "INSERT INTO TEOS (nimi, deponoitu, aktiivisuustila, poistoperuste, inventaarionumero, paaluokka, erikoisluokka, hoito_id, sijoitus_id, omistaja, kokoelman_nimi, teoksen_aiemmat_nimet, tekohetki, hankintatapa, hankintahinta, omistajuushistoria, hankinta_aika, hankinta_paikka, tekniikka, teoksen_mitat, kehyksen_mitat, kehyksen_materiaali, etupuolen_merkinnat, takapuolen_merkinnat, tekijanoikeustiedot, tekijanoikeuden_vapautuminen, teoksen_kunto, sisalto_kuvailu, tutkimusmateriaali, konservointiasiakirjat, vakuutusarvo, vakuutusarvon_selite, muu_tieto, nayttelytiedot, aukon_mitat, kuva_alan_mitat, jalustan_mitat, jalustan_materiaalit, poistoajankohta)
                        VALUES('" . $nimi . "', '" . $deponoitu . "', '" . $aktiivisuustila . "', '" . $poistoperuste . "', '" . $inventaarionumero . "', '" . $paaluokka . "', '" . $erikoisluokka . "', '" . $hoito_id . "', '" . $sijoitus_id . "', '" . $omistaja . "', '" . $kokoelman_nimi . "', '" . $aiemmat_nimet . "', '" . $tekohetki . "', '" . $hankintatapa . "', '" . $hankintahinta . "', '" . $omistajuushistoria . "', '" . $hankinta_aika . "', '" . $hankinta_paikka . "', '" . $tekniikka . "', '" . $teoksen_mitat . "', '" . $kehyksen_mitat . "', '" . $kehyksen_materiaali . "', '" . $etupuolen_merkinnat . "', '" . $takapuolen_merkinnat. "', '" . $tekijanoikeustiedot . "', '" . $tekijanoikeuden_vapautuminen . "', '" . $teoksen_kunto . "', '" . $sisalto_kuvailu . "', '" . $tutkimusmateriaali . "', '" . $konservointiasiakirjat . "', '" . $vakuutusarvo . "', '" . $vakuutusarvon_selite. "', '" . $muu_tieto . "', '" . $nayttelytiedot . "', '" . $aukon_mitat. "', '" . $kuva_alan_mitat . "', '" . $jalustan_mitat . "', '" . $jalustan_materiaalit  . "', '" . $poistoajankohta . "');";
               
                    $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos teoksen lis‰‰minen onnistui
                    if ($tunnuksen_insert) {
                        echo "<p class = 'vp'>";
                        echo "Teos lis‰ttiin onnistuneesti.";
                        echo "</p>";
                    }
                    else {
                        echo "<p class = 'vp'>";
                        echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                        echo "</p>";
                    }
                }
            } 
            elseif (strlen($taiteilija_id) != 0 && strlen($hoito_id) == 0 && strlen($sijoitus_id) == 0){

                $sql = "SELECT * FROM TEOS WHERE nimi = '" . $nimi . "'";
                $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);

                if ($tarkasta_nimi->num_rows == 1) {
                    echo "<p class = 'vp'>";
                    echo "Teos on jo tietokannassa";
                    echo "</p>";
                }
                else {
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan

                    $sql = "INSERT INTO TEOS (nimi, deponoitu, aktiivisuustila, poistoperuste, inventaarionumero, paaluokka, erikoisluokka, taiteilija_id, omistaja, kokoelman_nimi, teoksen_aiemmat_nimet, tekohetki, hankintatapa, hankintahinta, omistajuushistoria, hankinta_aika, hankinta_paikka, tekniikka, teoksen_mitat, kehyksen_mitat, kehyksen_materiaali, etupuolen_merkinnat, takapuolen_merkinnat, tekijanoikeustiedot, tekijanoikeuden_vapautuminen, teoksen_kunto, sisalto_kuvailu, tutkimusmateriaali, konservointiasiakirjat, vakuutusarvo, vakuutusarvon_selite, muu_tieto, nayttelytiedot, aukon_mitat, kuva_alan_mitat, jalustan_mitat, jalustan_materiaalit, poistoajankohta)
                        VALUES('" . $nimi . "', '" . $deponoitu . "', '" . $aktiivisuustila . "', '" . $poistoperuste . "', '" . $inventaarionumero . "', '" . $paaluokka . "', '" . $erikoisluokka . "', '" . $taiteilija_id . "', '" . $omistaja . "', '" . $kokoelman_nimi . "', '" . $aiemmat_nimet . "', '" . $tekohetki . "', '" . $hankintatapa . "', '" . $hankintahinta . "', '" . $omistajuushistoria . "', '" . $hankinta_aika . "', '" . $hankinta_paikka . "', '" . $tekniikka . "', '" . $teoksen_mitat . "', '" . $kehyksen_mitat . "', '" . $kehyksen_materiaali . "', '" . $etupuolen_merkinnat . "', '" . $takapuolen_merkinnat. "', '" . $tekijanoikeustiedot . "', '" . $tekijanoikeuden_vapautuminen . "', '" . $teoksen_kunto . "', '" . $sisalto_kuvailu . "', '" . $tutkimusmateriaali . "', '" . $konservointiasiakirjat . "', '" . $vakuutusarvo . "', '" . $vakuutusarvon_selite. "', '" . $muu_tieto . "', '" . $nayttelytiedot . "', '" . $aukon_mitat. "', '" . $kuva_alan_mitat . "', '" . $jalustan_mitat . "', '" . $jalustan_materiaalit  . "', '" . $poistoajankohta . "');";              

                    $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos teoksen lis‰‰minen onnistui
                    if ($tunnuksen_insert) {
                        echo "<p class = 'vp'>";
                        echo "Teos lis‰ttiin onnistuneesti.";
                        echo "</p>";
                    }
                    else {
                        echo "<p class = 'vp'>";
                        echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                        echo "</p>";
                    }
                }
            } 
            elseif (strlen($taiteilija_id) != 0 && strlen($hoito_id) == 0 && strlen($sijoitus_id) != 0){

                $sql = "SELECT * FROM TEOS WHERE nimi = '" . $nimi . "'";
                $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);

                if ($tarkasta_nimi->num_rows == 1) {
                    echo "<p class = 'vp'>";
                    echo "Teos on jo tietokannassa";
                    echo "</p>";
                }
                else {
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan
                    $sql = "INSERT INTO TEOS (nimi, deponoitu, aktiivisuustila, poistoperuste, inventaarionumero, paaluokka, erikoisluokka, sijoitus_id, taiteilija_id, omistaja, kokoelman_nimi, teoksen_aiemmat_nimet, tekohetki, hankintatapa, hankintahinta, omistajuushistoria, hankinta_aika, hankinta_paikka, tekniikka, teoksen_mitat, kehyksen_mitat, kehyksen_materiaali, etupuolen_merkinnat, takapuolen_merkinnat, tekijanoikeustiedot, tekijanoikeuden_vapautuminen, teoksen_kunto, sisalto_kuvailu, tutkimusmateriaali, konservointiasiakirjat, vakuutusarvo, vakuutusarvon_selite, muu_tieto, nayttelytiedot, aukon_mitat, kuva_alan_mitat, jalustan_mitat, jalustan_materiaalit, poistoajankohta)
                        VALUES('" . $nimi . "', '" . $deponoitu . "', '" . $aktiivisuustila . "', '" . $poistoperuste . "', '" . $inventaarionumero . "', '" . $paaluokka . "', '" . $erikoisluokka . "', '" . $sijoitus_id . "', '" . $taiteilija_id . "', '" . $omistaja . "', '" . $kokoelman_nimi . "', '" . $aiemmat_nimet . "', '" . $tekohetki . "', '" . $hankintatapa . "', '" . $hankintahinta . "', '" . $omistajuushistoria . "', '" . $hankinta_aika . "', '" . $hankinta_paikka . "', '" . $tekniikka . "', '" . $teoksen_mitat . "', '" . $kehyksen_mitat . "', '" . $kehyksen_materiaali . "', '" . $etupuolen_merkinnat . "', '" . $takapuolen_merkinnat. "', '" . $tekijanoikeustiedot . "', '" . $tekijanoikeuden_vapautuminen . "', '" . $teoksen_kunto . "', '" . $sisalto_kuvailu . "', '" . $tutkimusmateriaali . "', '" . $konservointiasiakirjat . "', '" . $vakuutusarvo . "', '" . $vakuutusarvon_selite. "', '" . $muu_tieto . "', '" . $nayttelytiedot . "', '" . $aukon_mitat. "', '" . $kuva_alan_mitat . "', '" . $jalustan_mitat . "', '" . $jalustan_materiaalit  . "','" . $poistoajankohta . "');";   

                    $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos teoksen lis‰‰minen onnistui
                    if ($tunnuksen_insert) {
                        echo "<p class = 'vp'>";
                        echo "Teos lis‰ttiin onnistuneesti.";
                        echo  "</p>";
                    }
                    else {
                        echo "<p class = 'vp'>";
                        echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                        echo "</p>";
                    }
                }
            } 
            elseif (strlen($taiteilija_id) == 0 && strlen($hoito_id) != 0 && strlen($sijoitus_id) == 0){

                $sql = "SELECT * FROM TEOS WHERE nimi = '" . $nimi . "'";
                $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);

                if ($tarkasta_nimi->num_rows == 1) {
                    echo "<p class = 'vp'>";
                    echo "Teos on jo tietokannassa";
                    echo "</p>";
                }
                else {
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan

                    $sql = "INSERT INTO TEOS (nimi, deponoitu, aktiivisuustila, poistoperuste, inventaarionumero, paaluokka, erikoisluokka, hoito_id, omistaja, kokoelman_nimi, teoksen_aiemmat_nimet, tekohetki, hankintatapa, hankintahinta, omistajuushistoria, hankinta_aika, hankinta_paikka, tekniikka, teoksen_mitat, kehyksen_mitat, kehyksen_materiaali, etupuolen_merkinnat, takapuolen_merkinnat, tekijanoikeustiedot, tekijanoikeuden_vapautuminen, teoksen_kunto, sisalto_kuvailu, tutkimusmateriaali, konservointiasiakirjat, vakuutusarvo, vakuutusarvon_selite, muu_tieto, nayttelytiedot, aukon_mitat, kuva_alan_mitat, jalustan_mitat, jalustan_materiaalit, poistoajankohta)
                        VALUES('" . $nimi . "', '" . $deponoitu . "', '" . $aktiivisuustila . "', '" . $poistoperuste . "', '" . $inventaarionumero . "', '" . $paaluokka . "', '" . $erikoisluokka . "', '" . $hoito_id . "', '" . $omistaja . "', '" . $kokoelman_nimi . "', '" . $aiemmat_nimet . "', '" . $tekohetki . "', '" . $hankintatapa . "', '" . $hankintahinta . "', '" . $omistajuushistoria . "', '" . $hankinta_aika . "', '" . $hankinta_paikka . "', '" . $tekniikka . "', '" . $teoksen_mitat . "', '" . $kehyksen_mitat . "', '" . $kehyksen_materiaali . "', '" . $etupuolen_merkinnat . "', '" . $takapuolen_merkinnat. "', '" . $tekijanoikeustiedot . "', '" . $tekijanoikeuden_vapautuminen . "', '" . $teoksen_kunto . "', '" . $sisalto_kuvailu . "', '" . $tutkimusmateriaali . "', '" . $konservointiasiakirjat . "', '" . $vakuutusarvo . "', '" . $vakuutusarvon_selite. "', '" . $muu_tieto . "', '" . $nayttelytiedot . "', '" . $aukon_mitat. "', '" . $kuva_alan_mitat . "', '" . $jalustan_mitat . "', '" . $jalustan_materiaalit  . "', '" . $poistoajankohta . "');";                 

                    $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos teoksen lis‰‰minen onnistui
                    if ($tunnuksen_insert) {
                        echo "<p class = 'vp'>";
                        echo "Teos lis‰ttiin onnistuneesti.";
                        echo "</p>";
                    }
                    else {
                        echo "<p class = 'vp'>";
                        echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                        echo "</p>";
                    }
                }
            } 
            elseif (strlen($taiteilija_id) == 0 && strlen($hoito_id) == 0 && strlen($sijoitus_id) != 0){

                $sql = "SELECT * FROM TEOS WHERE nimi = '" . $nimi . "'";
                $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);

                if ($tarkasta_nimi->num_rows == 1) {
                    echo "<p class = 'vp'>";
                    echo "Teos on jo tietokannassa";
                    echo "</p>";
                }
                else {
                    // Kirjoitetaan uuden taiteilijan tiedot tietokantaan
                    $sql = "INSERT INTO TEOS (nimi, deponoitu, aktiivisuustila, poistoperuste, inventaarionumero, paaluokka, erikoisluokka, sijoitus_id, omistaja, kokoelman_nimi, teoksen_aiemmat_nimet, tekohetki, hankintatapa, hankintahinta, omistajuushistoria, hankinta_aika, hankinta_paikka, tekniikka, teoksen_mitat, kehyksen_mitat, kehyksen_materiaali, etupuolen_merkinnat, takapuolen_merkinnat, tekijanoikeustiedot, tekijanoikeuden_vapautuminen, teoksen_kunto, sisalto_kuvailu, tutkimusmateriaali, konservointiasiakirjat, vakuutusarvo, vakuutusarvon_selite, muu_tieto, nayttelytiedot, aukon_mitat, kuva_alan_mitat, jalustan_mitat, jalustan_materiaalit, poistoajankohta)
                        VALUES('" . $nimi . "', '" . $deponoitu . "', '" . $aktiivisuustila . "', '" . $poistoperuste . "', '" . $inventaarionumero . "', '" . $paaluokka . "', '" . $erikoisluokka . "', '" . $sijoitus_id . "', '" . $omistaja . "', '" . $kokoelman_nimi . "', '" . $aiemmat_nimet . "', '" . $tekohetki . "', '" . $hankintatapa . "', '" . $hankintahinta . "', '" . $omistajuushistoria . "', '" . $hankinta_aika . "', '" . $hankinta_paikka . "', '" . $tekniikka . "', '" . $teoksen_mitat . "', '" . $kehyksen_mitat . "', '" . $kehyksen_materiaali . "', '" . $etupuolen_merkinnat . "', '" . $takapuolen_merkinnat. "', '" . $tekijanoikeustiedot . "', '" . $tekijanoikeuden_vapautuminen . "', '" . $teoksen_kunto . "', '" . $sisalto_kuvailu . "', '" . $tutkimusmateriaali . "', '" . $konservointiasiakirjat . "', '" . $vakuutusarvo . "', '" . $vakuutusarvon_selite. "', '" . $muu_tieto . "', '" . $nayttelytiedot . "', '" . $aukon_mitat. "', '" . $kuva_alan_mitat . "', '" . $jalustan_mitat . "', '" . $jalustan_materiaalit  . "', '" . $poistoajankohta . "');";

                    $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos teoksen lis‰‰minen onnistui
                    if ($tunnuksen_insert) {
                        echo "<p class = 'vp'>";
                        echo "Teos lis‰ttiin onnistuneesti.";
                        echo "</p>";
                    }
                    else {
                        echo "<p class = 'vp'>";
                        echo "Lis‰‰minen ep‰onnistui, yrit‰ uudelleen..";
                        echo "</p>";
                    }
                }
            }
        }
            else {
                echo "<p class = 'vp'>";
                echo "Yhteyden muodostaminen tietokantaan ep‰onnistui.";
                echo "</p>";
            }
    }
}