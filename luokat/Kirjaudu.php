<?php

class Kirjaudu
{
    /**
     * @var object Tietokantayhteys
     */
    private $tietokanta_yhteys = null;
    /**
     * @var array Virhe ilmoituksien lajitelma
     */
    public $virheet = array();
    /**
     * @var array Ilmoituksien lajitelma
     */
    public $ilmoitukset = array();
    /**
     * Funktio "__construct()" automaattisesti aloittaa toiminnan kun tämän luokan olio on luotu,
     * "$login = new Login();"
     */
    public function __construct()
    {
        // Luodaan/luetaan sessio (pakollista)
        session_start();
        // Tarkastetaan mahdolliset kirjautumistoiminnot
        // Jos yritettiin kirjautua ulos(Kun painetaan uloskirjautumis-näppäintä)
        if (isset($_GET["logout"])) {
            $this->kirjaudu_ulos();
        }
        // Kirjautuminen POST-datalla(Jos kirjautumis lomake on täytetty)
        elseif (isset($_POST["login"])) {
            $this->kirjaudu_sisaan();
        }
    }
    /**
     * Kirjautuminen
     */
    private function kirjaudu_sisaan()
    {
        // Tarkastetaan kirjautumislomakkeen tiedot
        if (empty($_POST['nimi'])) {
            $this->virheet[] = "Ei käyttäjänimeä.";
        } elseif (empty($_POST['salasana'])) {
            $this->virheet[] = "Ei salasanaa.";
        } elseif (!empty($_POST['nimi']) && !empty($_POST['salasana'])) {
            // Luodaan tietokanta yhteys käytttäen tietokanta.php:n vakioita, jotka ladattiin index.php:ssä
            $this->tietokanta_yhteys = new mysqli(TIETOKANTA_HOST, TIETOKANTA_KAYTTAJA, TIETOKANTA_SALASANA, TIETOKANTA_NIMI);
            // Vaihdetaan utf8 encodeen ja tarkastetaan se
            if (!$this->tietokanta_yhteys->set_charset("utf8")) {
                $this->virheet[] = $this->tietokanta_yhteys->virhe;
            }
            // Jos ei virheitä yhteydessä (= toimiva tietokantayhteys)
            if (!$this->tietokanta_yhteys->connect_errno) {
                // real_escape POST arvot
                $nimi = $this->tietokanta_yhteys->real_escape_string($_POST['nimi']);
                // Tietokanta kysely, hakee kaikki käyttäjän tiedot (sallii kirjautumisen sähköpostin avulla käyttäjänimi kentässä
                $sql = "SELECT nimi, sposti, salasana
                        FROM KAYTTAJA
                        WHERE nimi = '" . $nimi . "' OR sposti = '" . $nimi . "';";
                $kirjautumisen_varmentaminen_tulos = $this->tietokanta_yhteys->query($sql);
                // Jos käyttäjä on olemassa
                if ($kirjautumisen_varmentaminen_tulos->num_rows == 1) {
                    // Haetaan result row (objektina)
                    $tulosrivi = $kirjautumisen_varmentaminen_tulos->fetch_object();
                    // Käyttetään PHP 5.5's password_verify() funktiota tarkistamaan sopiiko annettu salasana
                    // käyttäjän salasanan hajautusarvoon
                    if (password_verify($_POST['salasana'], $tulosrivi->salasana)) {
                        // Kirjoitetaan käyttäjä data PHP SESSION:iin (tiedosto palvelimella)
                        $_SESSION['nimi'] = $tulosrivi->nimi;
                        $_SESSION['sposti'] = $tulosrivi->sposti;
                        $_SESSION['kirjautumis_status'] = 1;
                    } else {
                        $this->virheet[] = "Väärä salasana.";
                    }
                } else {
                    $this->virheet[] = "Väärä käyttäjätunnus.";
                }
            } else {
                $this->virheet[] = "Virhe tietokantaan yhdistämisessä.";
            }
        }
    }
    /**
     * perform the logout
     */
    public function kirjaudu_ulos()
    {
        // poistetaan käyttäjän istunto/sessio
        $_SESSION = array();
        session_destroy();
        // Palautetaan pieni ilmoitus
        $this->ilmoitukset[] = "Olet kirjautunut ulos";
    }
    /**
     * Palautetaan nykyinen kirjatumisen tila
     * @return boolean käyttäjän kirjautumis_status
     */
    public function onKirjautunut()
    {
        if (isset($_SESSION['kirjautumis_status']) AND $_SESSION['kirjautumis_status'] == 1) {
            return true;
        }
        // Oletus return
        return false;
    }
}
