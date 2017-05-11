<?php
/**
 * PHP sisäänkirjautmis scripti
 *
 * Käyttää PHP $_SESSION

 */
//Tarkistetaan minimi vaatimus PHP-versiolle
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("PHP kirjautminen vaatii vähintään version 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    //Lisätään PHP 5.5 salasanan hashing vanhempiin versioihin
    require_once("kirjastot/tarkastus_kirjasto.php");
}
//Sisällytetään konfiguraatio/tietokanta.php)
require_once("konfiguraatiot/tietokanta.php");
//Ladataan rekisteröitymis-luokka
require_once("luokat/Rekisteroityminen.php");
//Luodaan ilmentymä rekisteröitymis-oliosta
//Käsittelee rekisteröitymisprosessin
$rekisterointi = new Rekisteroityminen();
//Näytetään rekisteröinti-näkymä (lomake + viestit)
include("nakymat/rekisteroidy.php");
