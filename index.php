<?php
/**
 * PHP sisäänkirjautmis scripti
 *
 * Käyttää PHP $_SESSION
 *
 *

 * @var  $login
 *
 */
//Tarkistetaan minimi vaatimus PHP-versiolle
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("PHP kirjautminen vaatii vähintään version 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    //Lisätään PHP 5.5 salasanan hashing vanhempiin versioihin
    require_once("kirjastot/tarkastus_kirjasto.php");
}
require_once("luokat/Haku.php");
//Luodaan ilmentymä haku-oliosta
//Käsittelee hakuprosessin

//Sisällytetään konfiguraatio/tietokanta.php)
require_once("konfiguraatiot/tietokanta.php");
//Ladataan sisäänkirjautumis-luokka
require_once("luokat/Kirjaudu.php");
//Luodaan ilmentymä sisäänkirjautmis oliosta
//Käsittelee sisäänkirjautumisprosessin
$login = new Kirjaudu();
//Tarkistetaan onko käyttäjä kirjautunut sisään vai ei
if ($login->onKirjautunut() == true) {
    //Käyttäjä on kirjautunutn sisään
    //Näytetään sisäänkirjautumis-ikkuna
    include("nakymat/kirjautunut.php");
} else {
    // Käyttäjä ei ole kirjautunut
    // Pääsivu erillään, näytetään uloskirjauneen käyttäjän ikkuna
    include("nakymat/ei_kirjautunut.php");
}
//$hakeminen = new Haku();