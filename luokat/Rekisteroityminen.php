<?php

class Rekisteroityminen
{
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
     * "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->rekisteroi_uusi_kayttaja();
        }
    }
    /**
     * Käsittelee ja toteuttaa rekisteröinti prosessin. Tarkastaa virheiden varalta
     * ja luo uuden käyttäjän jos kaikki on ok
     */
    private function rekisteroi_uusi_kayttaja()
    {
        if (empty($_POST['nimi'])) {
            $this->virheet[] = "Ei käyttäjänimeä.";
        } elseif (empty($_POST['uusi_salasana']) || empty($_POST['toisto_salasana'])) {
            $this->virheet[] = "Ei salasanaa";
        } elseif ($_POST['uusi_salasana'] !== $_POST['toisto_salasana']) {
            $this->virheet[] = "Salasanat eivät vastaa toisiaan";
        } elseif (strlen($_POST['uusi_salasana']) < 6) {
            $this->virheet[] = "Salasanan tulee olla vähintään 6 merkkiä";
        } elseif (strlen($_POST['nimi']) > 64 || strlen($_POST['nimi']) < 2) {
            $this->virheet[] = "Käyttäjänimen tulee olla 2-64 merkkiä";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['nimi'])) {
            $this->virheet[] = "Käyttäjänimi ei saa sisältää erikoismerkkejä";
        } elseif (empty($_POST['sposti'])) {
            $this->virheet[] = "Ei sähköpostia";
        } elseif (strlen($_POST['sposti']) > 64) {
            $this->virheet[] = "Sähköposti ei saa olla yli 64 merkkiä";
        } elseif (!filter_var($_POST['sposti'], FILTER_VALIDATE_EMAIL)) {
            $this->virheet[] = "Sähköposti ei ole oikeassa muodossa";
        } elseif (!empty($_POST['nimi'])
            && strlen($_POST['nimi']) <= 64
            && strlen($_POST['nimi']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['nimi'])
            && !empty($_POST['sposti'])
            && strlen($_POST['sposti']) <= 64
            && filter_var($_POST['sposti'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['uusi_salasana'])
            && !empty($_POST['toisto_salasana'])
            && ($_POST['uusi_salasana'] === $_POST['toisto_salasana'])
        ) {
            // Luodaan tietokantayhteys
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // escape, lisäkis poistetaan mahdollinen (html/javascript-) koodi (tietoturva)
                $nimi = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['nimi'], ENT_QUOTES));
                $sposti = $this->tietokanta_yhteys->real_escape_string(strip_tags($_POST['sposti'], ENT_QUOTES));
                $tuleva_salasana = $_POST['uusi_salasana'];
                // Cryptaa käyttäjän salasanan PHP 5.5's password_hash() funktiolla, tuloksena 60 merkin
                // hash string. PASSWORD_DEFAULT vakio on määritelty PHP 5.5, tai jos käytät
                // PHP 5.3/5.4, salasanan hajatukseen käytettävän tarkastus_kirjaston avulla
                $salasana = password_hash($tuleva_salasana, PASSWORD_DEFAULT);
                // Tarkistetaan onko käyttäjänimi tai sähköposti jo olemassa
                $sql = "SELECT * FROM KAYTTAJA WHERE nimi = '" . $nimi . "' OR sposti = '" . $sposti . "';";
                $tarkasta_nimi = $this->tietokanta_yhteys->query($sql);
                if ($tarkasta_nimi->num_rows == 1) {
                    $this->virheet[] = "Käyttäjänimi tai sähköposti on jo käytössä";
                } else {
                    // Kirjoitetaan uuden käyttäjän tiedot tietokantaan
                    $sql = "INSERT INTO KAYTTAJA (nimi, salasana, sposti)
                            VALUES('" . $nimi . "', '" . $salasana . "', '" . $sposti . "');";
                    $tunnuksen_insert = $this->tietokanta_yhteys->query($sql);
                    // Jos käyttäjän lisääminen onnistui
                    if ($tunnuksen_insert) {
                        $this->ilmoitukset[] = "Tunnus luotiin onnistuneesti.";
                    } else {
                        $this->virheet[] = "Rekisteröityminen epäonnistui, yritä uudelleen..";
                    }
                }
            } else {
                $this->virheet[] = "Tietokantaan muodostaminen epäonnistui.";
            }
        } else {
            $this->virheet[] = "Tuntematon virhe.";
        }
    }
}
