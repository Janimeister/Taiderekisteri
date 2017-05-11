<?php
class Haku{
 
   
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
     * Funktio "__construct()" automaattisesti aloittaa toiminnan kun tämän luokan olio on luotu,
     */
    public function __construct(){
 
        if (isset($_POST["haku"])){
            $valittu = $_POST["hakuehto"];
            if($valittu == "inventaarionumero"){
                $this->HaeInventaario();
            }
            if($valittu == "taiteilija"){
              $this->HaeTaiteilija();
            }
            if($valittu == "teos"){
                $this->HaeTeosNimi();
            }
            if($valittu == "sijainti"){
                $this->HaeSijainti();
            }
            if($valittu == "paaluokka"){
                $this->HaePaaluokka();
            }
            if($valittu == "hankintatapa"){
                $this->HaeHankintatapa();
            }
            if($valittu == "hankinta_aika"){
                $this->HaeHankinta_aika();
            }
            if($valittu == "poistetut"){
                $this->HaePoistettu();
            }
            if($valittu == "vakuutusarvo"){
                $this->HaeVakuutusarvot();
            }
            if($valittu == "tekijanoikeus"){
                $this->HaeTekijanoikeusvapautuminen();
            }
            if($valittu == "kaikkisijainnit"){
                $this->HaeKaikkiSijainnit();
            }
            if($valittu == "kaikkirakennukset"){
                $this->HaeKaikkiRakennukset();
            }
            if($valittu == "kaikkitaiteilijat"){
                $this->HaeKaikkiTaiteilijat();
            }
            if($valittu == "kaikkiteokset"){
                $this->HaeKaikkiTeokset();
            }
            if($valittu == "kaikkihoidot"){
                $this->HaeKaikkiHoidot();
            }
        }
    }
 
 
    private function HaeInventaario(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $haku=$this->tietokanta_yhteys->real_escape_string($_POST['hakumuuttuja']);

                $sql = "SELECT nimi
                        FROM TEOS
                        WHERE inventaarionumero = '" . $haku . "';";
 
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
 
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<td>";
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Teoksen nimi: " . $tulosrivi["nimi"];
                        echo "<br>";
                    }
                    echo "<br>";
                
                    echo "Lisää tietoa teoksesta saat hakemalla sen nimellä";
                    echo "</tr>";
                    echo "</table>";
}
    else{
        echo "<p class = 'hakuvp'>";
        echo "Annetulla inventaarionumerolla ei löytynyt teosta";
        echo "</p>";
        //$this->virheet[] = "Haettua teosta ei löytynyt tietokannasta";
    }
}
            else {
                echo "<p class = 'hakuvp'>";
                echo "Virhe tietokantaan yhdistämisessä";
                echo "</p>";
                //$this->virheet[] = "Virhe tietokantaan yhdistämisessä.";
}
}
    private function HaeTaiteilija(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $haku=$this->tietokanta_yhteys->real_escape_string($_POST['hakumuuttuja']);
                $sql = "SELECT *
                        FROM TAITEILIJAT
                        WHERE nimi = '" . $haku . "';";
 
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                if ($haku_varmentaminen_tulos->num_rows == 1) {
                    echo "<table>";
                    echo "<tr>";
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "<td>Taiteilija ID: " . $tulosrivi['taiteilija_id'];
                        echo "<br>";
                        echo "Taiteilijan nimi: " . $tulosrivi["nimi"];
                        echo "<br>";
                        echo "Syntymäaika: " . $tulosrivi["syntyma_aika"];
                        echo "<br>";
                        echo "Kuolinaika: " . $tulosrivi["kuolinaika"];
                        echo "<br>";
                        echo "Syntymäpaikka: " . $tulosrivi["syntymapaikka"];
                        echo "<br>";
                        echo "Koulutus: " . $tulosrivi["koulutus"];
                        echo "<br>";
                        echo "Palkinnot: " . $tulosrivi["palkinnot"];
                        echo "<br>";
                        echo "Kirjallisuusviite: " . $tulosrivi["kirjallisuusviite"] . "</td>";
                        
                    }  
                    echo "</tr>";
                    echo "</table>";                   
   
    }
    else{   
        echo "<p class = 'hakuvp'>";
        echo "Haettua taiteilijaa ei löytynyt tietokannasta";
        echo "</p>";
        //$this->virheet2[] = "Haettua taiteilijaa ei löytynyt tietokannasta";
    }
}
            else {
                echo "<p class = 'hakuvp'>";
                echo "Virhe tietokantaan yhdistämisessä";
                echo "</p>";
                //$this->virheet2[] = "Virhe tietokantaan yhdistämisessä.";
}
}
    private function HaePaaluokka(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $haku=$this->tietokanta_yhteys->real_escape_string($_POST['hakumuuttuja']);

                $sql = "SELECT nimi, paaluokka
                        FROM TEOS
                        WHERE paaluokka = '" . $haku . "';";
 
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr>";
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "<td>Teoksen nimi: " . $tulosrivi["nimi"];
                        echo "<br>";
                        echo "Pääluokka: " . $tulosrivi["paaluokka"];
                        echo "<br>";
                    }
                    echo "<br>";
                    echo "Lisätietoa saat hakemalla teoksen nimellä</td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Annetulla pääluokalla ei löytynyt teoksia";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}

private function HaeTeosNimi(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $haku=$this->tietokanta_yhteys->real_escape_string($_POST['hakumuuttuja']);

                $sql = "SELECT *
                        FROM TEOS
                        WHERE nimi = '" . $haku . "';";
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr>";
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        
                        echo "<td><h2 class = 'hakuhead'>1. Kokoelmatiedot</h2>";
                        echo "Omistaja: " . $tulosrivi["omistaja"];
                        echo "<br>";
                        echo "Kokoelman nimi: " . $tulosrivi["kokoelman_nimi"];
                        echo "<br>";
                        echo "Inventaarionumero: " . $tulosrivi["inventaarionumero"];
                        echo "<br>";

                        echo "<h2 class = 'hakuhead'>2. Taiteilijatiedot</h2>";
                        if ($tulosrivi["taiteilija_id"]){
                            $sql4 = "SELECT TAITEILIJAT.nimi
                                    FROM TAITEILIJAT 
                                    INNER JOIN TEOS 
                                    ON TAITEILIJAT.taiteilija_id = TEOS.taiteilija_id;";
                            $haku_varmentaminen_tulos4 = $this->tietokanta_yhteys->query($sql4);
                            // Jos haettava tieto on olemassa
                            $tuloksien_maara4 = $haku_varmentaminen_tulos4->num_rows;
                            if ($haku_varmentaminen_tulos4->num_rows == 1) {
                            // Haetaan result row (objektina)
                            while($tulosrivi4=$haku_varmentaminen_tulos4->fetch_assoc()){
                                echo "Taiteilijan nimi: " . $tulosrivi4["TAITEILIJAT.nimi"];
                                }
                                echo "<br>";
                            }

                        }
                        else{
                            echo "Taiteilijaa ei tiedossa";
                        }

                        echo "<h2 class = 'hakuhead'>3. Teostiedot</h2>";
                        if ($tulosrivi["deponoitu"] == 1){
                            echo "Deponoitu";
                        }
                        if ($tulosrivi["deponoitu"] == 0){
                            echo "Ei deponoitu";
                        }
                        echo "<br>";
                        echo "Pääluokka: " . $tulosrivi["paaluokka"];
                        echo "<br>";
                        echo "Erikoisluokka: " . $tulosrivi["erikoisluokka"];
                        echo "<br>";
                        echo "Tekniikka: " . $tulosrivi["tekniikka"];
                        echo "<br>";
                        echo "Teoksen nimi: " . $tulosrivi["nimi"];
                        echo "<br>";
                        echo "<br>";
                        echo "Teoksen aiemmat nimet: " . $tulosrivi["teoksen_aiemmat_nimet"];
                        echo "<br>";
                        echo "Kuvaus: " . $tulosrivi["sisalto_kuvailu"];
                        echo "<br>";
                        echo "Tekohetki: " . $tulosrivi["tekohetki"];
                        echo "<br>";
                        echo "Teoksen mitat: " . $tulosrivi["teoksen_mitat"];
                        echo "<br>";
                        echo "Aukon mitat: " . $tulosrivi["aukon_mitat"];
                        echo "<br>";
                        echo "Kuva-alan mitat: " . $tulosrivi["kuva_alan_mitat"];
                        echo "<br>";
                        echo "Kehyksen mitat: " . $tulosrivi["kehyksen_mitat"];
                        echo "<br>";
                        echo "Kehyksen materiaali: " . $tulosrivi["kehyksen_materiaali"];
                        echo "<br>";
                        echo "Jalustan mitat: " . $tulosrivi["jalustan_mitat"];
                        echo "<br>";
                        echo "Jalustan materiaalit: " . $tulosrivi["jalustan_materiaalit"];
                        echo "<br>";
                        echo "Etupuolen merkinnat: " . $tulosrivi["etupuolen_merkinnat"];
                        echo "<br>";
                        echo "Takapuolen merkinnat: " . $tulosrivi["takapuolen_merkinnat"];

                        echo "<h2 class = 'hakuhead' class = 'lisayshead'>4. Kuntotiedot</h2>";
                        echo "Teoksen kunto: " . $tulosrivi["teoksen_kunto"];
                        echo "<br>";
                        echo "Konservointiasiakirjat: " . $tulosrivi["konservointiasiakirjat"];
                        echo "<br>";
                        if ($tulosrivi["hoito_id"]){
                            $sql2 = "SELECT HOITOHISTORIA.paivamaara, HOITOHISTORIA.toimenpide
                                    FROM HOITOHISTORIA
                                    INNER JOIN TEOS
                                    ON HOITOHISTORIA.hoito_id = TEOS.hoito_id;";
                            $haku_varmentaminen_tulos2 = $this->tietokanta_yhteys->query($sql2);
                            // Jos haettava tieto on olemassa
                            $tuloksien_maara2 = $haku_varmentaminen_tulos2->num_rows;
                            if ($haku_varmentaminen_tulos2->num_rows == 1) {
                            // Haetaan result row (objektina)
                            while($tulosrivi2=$haku_varmentaminen_tulos2->fetch_assoc()){
                                echo "Hoitotoimen päivämäärä: " . $tulosrivi2["HOITOHISTORIA.paivamaara"];
                                echo "<br>";
                                echo "Hoitotoimenpide: " . $tulosrivi2["HOITOHISTORIA.toimenpide"];
                                }
                                echo "<br>";
                            }
                        }
                        echo "<h2 class = 'hakuhead'>5. Poisto</h2>";

                        if ($tulosrivi["aktiivisuustila"] == 1){
                            echo "Aktiivinen";
                        }
                        if ($tulosrivi["aktiivisuustila"] == 0){
                            echo "Poistettu";
                        }
                        echo "<br>";
                        echo "Poisto peruste: " . $tulosrivi["poistoperuste"];
                        echo "<br>";
                        echo "Poistoajankohta: " . $tulosrivi["poistoajankohta"];

                        echo "<h2 class = 'hakuhead'>6. Sijoitus</h2>";

                        if ($tulosrivi["sijoitus_id"]){
                            $sql3 = "SELECT SIJOITUSHISTORIA.varasto, SIJOITUSHISTORIA.kerros, SIJOITUSHISTORIA.tilanumero, SIJOITUSHISTORIA.osasto, SIJOITUSHISTORIA.alku_pvm, SIJOITUSHISTORIA.loppu_pvm, SIJOITUSHISTORIA.vapaat_tiedot
                                    FROM SIJOITUSHISTORIA 
                                    INNER JOIN TEOS 
                                    ON SIJOITUSHISTORIA.sijoitus_id = TEOS.sijoitus_id;";
                            $haku_varmentaminen_tulos3 = $this->tietokanta_yhteys->query($sql3);
                            // Jos haettava tieto on olemassa
                            $tuloksien_maara3 = $haku_varmentaminen_tulos3->num_rows;
                            if ($haku_varmentaminen_tulos3->num_rows == 1) {
                            // Haetaan result row (objektina)
                            while($tulosrivi3=$haku_varmentaminen_tulos3->fetch_assoc()){
                                if ($tulosrivi3["SIJOITUSHISTORIA.varasto"] == 0){
                                    echo "Ei varastossa";
                                }
                                if ($tulosrivi3["SIJOITUSHISTORIA.varasto"] == 1){
                                    echo "Varastossa";
                                }
                                echo "<br>";
                                echo "Kerros: " . $tulosrivi3["SIJOITUSHISTORIA.kerros"];
                                echo "<br>";
                                echo "Tilanumero: " . $tulosrivi3["SIJOITUSHISTORIA.tilanumero"];
                                echo "<br>";
                                echo "Osasto: " . $tulosrivi3["SIJOITUSHISTORIA.osasto"];
                                echo "<br>";
                                echo "Alku pvm: " . $tulosrivi3["SIJOITUSHISTORIA.alku_pvm"];
                                echo "<br>";
                                echo "Loppu pvm: " . $tulosrivi3["SIJOITUSHISTORIA.loppu_pvm"];
                                echo "<br>";
                                echo "Muita tietoja: " . $tulosrivi3["SIJOITUSHISTORIA.vapaat_tiedot"];
                                }
                                echo "<br>";
                            }
                        }

                        echo "<h2 class = 'hakuhead'>7. Hankintatiedot</h2>";

                        echo "<br>";
                        echo "Hankintatapa: " . $tulosrivi["hankintatapa"];
                        echo "<br>";
                        echo "Hankintahinta: " . $tulosrivi["hankintahinta"];
                        echo "<br>";
                        echo "Omistajuushistoria: " . $tulosrivi["omistajuushistoria"];
                        echo "<br>";
                        echo "Hankinta-aika: " . $tulosrivi["hankinta_aika"];
                        echo "<br>";
                        echo "Hankintapaikka: " . $tulosrivi["hankinta_paikka"];
                        echo "<br>";

                        echo "<h2 class = 'hakuhead'>8. Arvotiedot</h2>";

                        echo "<br>";
                        echo "Vakuutusarvo: " . $tulosrivi["vakuutusarvo"];
                        echo "<br>";
                        echo "Vakuutusarvon selite: " . $tulosrivi["vakuutusarvon_selite"];

                        echo "<h2 class = 'hakuhead'>9. Tekijänoikeustiedot</h2>";

                        echo "<br>";
                        echo "Tekijanoikeusteidot: " . $tulosrivi["tekijanoikeustiedot"];
                        echo "<br>";
                        echo "Tekijanoikeuden vapautuminen: " . $tulosrivi["tekijanoikeuden_vapautuminen"];
                        echo "<br>";

                        echo "<h2 class = 'hakuhead'>10. Kuvatiedot</h2>";

                        echo "<h2 class = 'hakuhead'>11. Arkisto- ja tutkimusmateriaali</h2>";

                        echo "<br>";
                        echo "Tutkimusmateriaali: " . $tulosrivi["tutkimusmateriaali"];
                        echo "<br>";
                        echo "Näyttelytiedot: " . $tulosrivi["nayttelytiedot"];
                        echo "<br>";

                        echo "<h2 class = 'hakuhead'>12. Muuta</h2>";
                        echo "<br>";
                        echo "Muut tiedot: " . $tulosrivi["muu_tieto"];
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";
                        
                        echo "<img src='kuvat/".$tulosrivi["teos_id"] .".jpg' alt='Teokselle ei ole kuvaa'>" . "</td>";
                        echo "<br>";
                        echo "<object data = './kuvat/". $tulosrivi["teos_id"]  .".pdf' type = 'application/pdf'><iframe src = './kuvat/" . $tulosrivi["teos_id"] .".pdf' type = 'application/pfd'>";
                        echo "</iframe></object>";
                    } 
                    echo "</tr>";
                    echo "</table>";             
                }        
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Annetulla teoksen nimellä ei löytynyt teoksia";
                    echo "</p>";
                }
    }
    else{
        echo "<p class = 'hakuvp'>";
        echo "Virhe tietokantaan yhdistämisessä";
        echo "</p>";
    }
}
 
    private function HaeSijainti(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $haku=$this->tietokanta_yhteys->real_escape_string($_POST['hakumuuttuja']);

                $sql = "SELECT TEOS.nimi
                        FROM TEOS
                        INNER JOIN SIJOITUSHISTORIA
                        ON TEOS.sijoitus_id = SIJOITUSHISTORIA.sijoitus_id
                        WHERE SIJOITUSHISTORIA.osasto = '" . $haku . "';";
               $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr><td>";
                    $tulosten_lkm = 0;
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Teoksen nimi: " . $tulosrivi["TEOS.nimi"];
                        echo "<br>";
                        $tulosten_lkm++;
                    }
                     echo "<br>";
                    echo "Teoksia löytyi " . $tulosten_lkm . " kappaletta";
                    echo "<br>";
                    echo "Lisätietoa saat teoksesta hakemalla sen nimellä</td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Annetulla osastolla ei löytynyt teoksia";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}
    private function HaeHankintatapa(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $haku=$this->tietokanta_yhteys->real_escape_string($_POST['hakumuuttuja']);

                $sql = "SELECT nimi
                        FROM TEOS
                        WHERE hankintatapa = '" . $haku . "';";
   
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr><td>";
                    $tulosten_lkm = 0;
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Teoksen nimi: " . $tulosrivi["nimi"];
                        echo "<br>";
                        $tulosten_lkm++;
                    }
                    echo "<br>";
                    echo "Teoksia löytyi " . $tulosten_lkm . " kappaletta";
                    echo "<br>";
                    echo "Lisätietoa teoksesta saat hakemalla sen nimellä</td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Annetulla hankitatavalla ei löytynyt teoksia";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}
    private function HaeHankinta_aika(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $haku=$this->tietokanta_yhteys->real_escape_string($_POST['hakumuuttuja']);

 
                $sql = "SELECT nimi
                        FROM TEOS
                        WHERE YEAR(hankinta_aika) = '" . $haku . "';";
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr><td>";
                         $tulosten_lkm = 0;
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Teoksen nimi: " . $tulosrivi["nimi"];
                        echo "<br>";
                        $tulosten_lkm++;
                    }
                    echo "<br>";
                    echo "Teoksia löytyi " . $tulosten_lkm . " kappaletta";
                    echo "<br>";
                    echo "Lisätietoa teoksesta saat hakemalla sen nimellä<td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Annetulla hankintavuodella ei löytynyt teoksia";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}
 
private function HaePoistettu(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $haku=$this->tietokanta_yhteys->real_escape_string($_POST['hakumuuttuja']);

 
                $sql = "SELECT nimi
                        FROM TEOS
                        WHERE aktiivisuustila = '" . $haku . "';";
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr><td>";
                         $tulosten_lkm = 0;
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Teoksen nimi: " . $tulosrivi["nimi"];
                        echo "<br>";
                        $tulosten_lkm++;
                    }
                    echo "<br>";
                    echo "Teoksia löytyi " . $tulosten_lkm . " kappaletta";
                    echo "<br>";
                    echo "Lisätietoa teoksesta saat hakemalla sen nimellä<td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Käytöstä poistettuja teoksia ei löytynyt. Muista että 0:lla haetaan poistettuja teoksia ja 1:llä aktiivisia teoksia";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}
 
private function HaeVakuutusarvot(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $haku=$this->tietokanta_yhteys->real_escape_string($_POST['hakumuuttuja']);

 
                $sql = "SELECT nimi, vakuutusarvo
                        FROM TEOS;";
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr>";
                    echo "<td>";
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Teoksen nimi: " . $tulosrivi["nimi"];
                        echo "<br>";
                        echo "Vakuutusarvo: " . $tulosrivi["vakuutusarvo"];
                        echo "<br>";
                    }
                    echo "Lisätietoa teoksesta saat hakemalla sen nimellä</td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Vakuutusarvoja ei löytynyt.";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}
private function HaeTekijanoikeusvapautuminen(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $haku=$this->tietokanta_yhteys->real_escape_string($_POST['hakumuuttuja']);

 
                $sql = "SELECT nimi, tekijanoikeuden_vapautuminen
                        FROM TEOS
                        WHERE YEAR(tekijanoikeuden_vapautuminen) = '" . $haku . "';";
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr>";
                    echo "<td>";
                         $tulosten_lkm = 0;
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        if ($tulosrivi["tekijanoikeuden_vapautuminen"] < CURDATE()){
                            echo "Teoksen nimi: " . $tulosrivi["nimi"];
                            echo "<br>";
                            echo "Tekijanoikeuden vapautuminen: " . $tulosrivi["tekijanoikeuden_vapautuminen"];
                            echo "<br>";
                            $tulosten_lkm++;
                        }
                        echo "<br>";
                        echo "Teoksia löytyi " . $tulosten_lkm . " kappaletta";
                        echo "<br>";
                    }
                    echo "Lisätietoa teoksesta saat hakemalla sen nimellä</td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Tekijänoikeus ei ole vapautunut yhdestäkän teoksesta";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}
private function HaeKaikkiSijainnit(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
 
                $sql = "SELECT *
                        FROM SIJOITUSHISTORIA;";
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr><td>";
                    $tulosten_lkm = 0;
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Sijoitus ID: " . $tulosrivi["sijoitus_id"];
                        echo "<br>";
                        if ($tulosrivi["varasto"] == 0){
                            echo "Ei varastossa";
                        }
                        if ($tulosrivi["varasto"] == 1){
                            echo "Varastossa";
                        }
                        echo "<br>";
                        echo "Kerros: " . $tulosrivi["kerros"];
                        echo "<br>";
                        echo "Tilanumero: " . $tulosrivi["tilanumero"];
                        echo "<br>";
                        echo "Osasto: " . $tulosrivi["osasto"];
                        echo "<br>";
                        echo "Alku pvm: " . $tulosrivi["alku_pvm"];
                        echo "<br>";
                        echo "Loppu pvm: " . $tulosrivi["loppu_pvm"];
                        echo "<br>";
                        echo "Muut tiedot: " . $tulosrivi["vapaat_tiedot"];
                        echo "<br>";
                        echo "Rakennus ID: " . $tulosrivi["rakennus_id"];
                        echo "<br>";
                     $tulosten_lkm++;
                    }
                    echo "<br>";
                    echo "Sijainteja löytyi " . $tulosten_lkm . " kappaletta</td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Sijainteja ei löytynyt.";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}
private function HaeKaikkiRakennukset(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
 
                $sql = "SELECT *
                        FROM RAKENNUS;";
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr><td>";
                    $tulosten_lkm = 0;
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Rakennus ID: " . $tulosrivi["rakennus_id"];
                        echo "<br>";
                        echo "Rakennuksen nimi: " . $tulosrivi["rakennuksen_nimi"];
                        echo "<br>";
                        echo "Kerrokset: " . $tulosrivi["kerrokset"];
                        echo "<br>";
                          $tulosten_lkm++;
                    }
                    echo "<br>";
                    echo "Rakennuksia löytyi " . $tulosten_lkm . " kappaletta</td>";                    
                    echo "</tr>";
                    echo "</table>";
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Rakennuksia ei löytynyt";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}
 
private function HaeKaikkiTaiteilijat(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
 
                $sql = "SELECT taiteilija_id, nimi
                        FROM  TAITEILIJAT;";
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr><td>";
                    $tulosten_lkm = 0;
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Taiteilija ID: " . $tulosrivi["taiteilija_id"];
                        echo "<br>";
                        echo "Taiteilijan nimi: " . $tulosrivi["nimi"];
                        echo "<br>";
                         $tulosten_lkm++;
                    }
                    echo "<br>";
                    echo "Taiteilijoita löytyi " . $tulosten_lkm . " kappaletta";
                     echo "<br>";
                    echo "Lisätietoa taiteilijasta saat hakemalla hänen nimellä</td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Taiteilijoita ei löytynyt.";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}
private function HaeKaikkiTeokset(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
 
                $sql = "SELECT teos_id, nimi
                        FROM TEOS;";
                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                     echo "<table>";
                    echo "<tr><td>";
                    $tulosten_lkm = 0;
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Teos ID: " . $tulosrivi["teos_id"];
                        echo "<br>";
                        echo "Teoksen nimi: " . $tulosrivi["nimi"];
                        echo "<br>";
                        $tulosten_lkm++;
                    }
                    echo "<br>";
                    echo "Teoksia löytyi " . $tulosten_lkm . " kappaletta";
                     echo "<br>";
                    echo "Lisätietoa teoksesta saat hakemalla sen nimellä</td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Teoksia ei löytynyt.";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}

private function HaeKaikkiHoidot(){
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä ð    toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
 
                $sql = "SELECT *
                        FROM HOITOHISTORIA;";

                $haku_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos haettava tieto on olemassa
                $tuloksien_maara = $haku_varmentaminen_tulos->num_rows;
                if ($haku_varmentaminen_tulos->num_rows >= 1) {
                    // Haetaan result row (objektina)
                    echo "<table>";
                    echo "<tr><td>";
                    $tulosten_lkm = 0;
                    while($tulosrivi=$haku_varmentaminen_tulos->fetch_assoc()){
                        echo "Hoito ID: " . $tulosrivi["hoito_id"];
                        echo "<br>";
                        echo "Huoltotoimenpiteen päivämäärä: " . $tulosrivi["paivamaara"];
                        echo "<br>";
                        echo "Huoltotoimenpide: " . $tulosrivi["toimenpide"];
                        echo "<br>";
                        echo "Huollon tekija: " . $tulosrivi["tekija"];
                        echo "<br>";
                    
                      $tulosten_lkm++;
                    }
                    echo "<br>";
                    echo "Hoitotietoja löytyi " . $tulosten_lkm . " kappaletta";
                    echo "<br>";
                    echo "Lisätietoa teoksesta saat hakemalla sen nimellä</td>";
                    echo "</tr>";
                    echo "</table>";
 
   
    }
 
                else{
                    echo "<p class = 'hakuvp'>";
                    echo "Teoksille olevia hoitotoimenpiteitä ei löytynyt";
                    echo "</p>";
                }
}
else{
    echo "<p class = 'hakuvp'>";
    echo "Virhe tietokantaan yhdistämisessä";
    echo "</p>";
}
}
}