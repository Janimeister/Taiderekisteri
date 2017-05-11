<?php
// N‰ytt‰‰ lisays-olion mahdolliset virheet

if (isset($lisays)) {
    if ($lisays->virheet) {
        echo "<textarea rows = '1' columns = '10' type = 'text'>";
        foreach ($lisays->virheet as $virhe) {
            echo $virhe;
        }
        echo "</textarea>";
    }
    if ($lisays->ilmoitukset) {
        echo "<textarea rows = '1' columns = '10' type = 'text'>";
        foreach ($lisays->ilmoitukset as $ilmoitus) {
            echo $ilmoitus;
        }
        echo "</textarea>";
    }
}
?>
<html>
    <title>Teoksen lis‰ys</title>
    <body>
        <head>
            <script type="text/javascript" src="modernizr-latest.js"></script>
            <meta name=viewport content="width=device-width, initial-scale=1">
            <link rel = "stylesheet" type = "text/css" href = "Lisaystyylit.css?version=51">
        </head>

        <!-- register form -->
        <div class = "lisaysdiv">
        <form method="post" action="../lisays.php" class = "lisaysf" name="lisaysterform">
            <fieldset>
                <legend>Lis‰‰ Teos</legend>

                <h2 class = 'lisayshead'>1. Kokoelmatiedot</h2>
                <br>
                    <label for="input_Omistaja">Omistaja (v‰hint‰‰n 2 merkki‰, enint‰‰n 50 merkki‰)</label>
                    <input id="input_Omistaja" class="teos" type="text" pattern="{2,50}" name="omistaja" />
                <br><br><br>
                    <label for="input_kokoelma">Kokoelman nimi (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>
                    <input id="input_kokoelma" class="teos" type="text" pattern="{2,60}" name="kokoelman_nimi" />
                <br><br><br>
                    <label for="input_inventaarionumero">Inventaarionumero (enint‰‰n 6 merkki‰)</label>
                    <input id="input_inventaarionumero" class="teos" type="text" pattern="{1,6}" name="inventaarionumero" />
                <br>
                <h2 class = 'lisayshead'>2. Taiteilijatiedot</h2>
                <br>
                  <label for="input_taiteilija_id"> Taiteilija-id (olemassaoleva)</label>
                    <input id="input_taiteilija_id" class="teos" type="text" pattern="[0-9]{1,6}" name="taiteilija_id" />
                <br>
                <h2 class = 'lisayshead'>3. Teostiedot</h2>
                <br>
                     <label for="input_deponoitu">Deponoitu (0 eli ei-deponoitu tai 1 eli deponoitu)</label>
                    <input id="input_deponoitu" class="teos" type="text" pattern="[0-1]{1}" name="deponoitu"/>
                <br><br><br>
                    <label for="input_paaluokka">P‰‰luokka (v‰hint‰‰n 2 merkki‰, enint‰‰n 20 merkki‰)</label>
                    <input id="input_paaluokka" class="teos" type="text" pattern="{2,20}" name="paaluokka" />
                <br><br><br>

                    <label for="input_erikoisluokka">Erikoisluokka (v‰hint‰‰n 2 merkki‰, enint‰‰n 20 merkki‰)</label>
                    <input id="input_erikoisluokka" class="teos" type="text" pattern="{2,20}" name="erikoisluokka" />
                <br><br><br>

                 <label for="input_tekniikka">Tekniikka (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>
                    <input id="input_tekniikka" class="teos" type="text" pattern="{2,60}" name="tekniikka" />
                <br><br><br>
                    <label for="input_nimi">Teoksen nimi (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>
                    <input id="input_nimi" class="teos" type="text" pattern="{2,60}" name="nimi" required />
                <br><br><br>
                    <label for="input_aiemmat_nimet">Teoksen aiemmat nimet (v‰hint‰‰n 2 merkki‰, enint‰‰n 100 merkki‰)</label>
                    <input id="input_aiemmat_nimet" class="teos" type="text" pattern="{2,100}" name="aiemmat_nimet" />
                <br><br><br>
                <label for="input_aiheen_kuvailu">Teoksen sis‰llˆn kuvailu (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>
                    <input id="input_aiheen_kuvailu" class="teos" type="text" pattern="{2,150}" name="sisalto_kuvailu" />
                <br><br><br>
                 <label for="input_tekohetki">Tekohetki (muotoa 2000-01-31)</label>
                    <input id="input_tekohetki" class="teos" type="date" placeholder="YYYY-MM-DD" name="tekohetki" pattern=".{6,}" />
                <br><br><br>
                 <label for="input_teoksen_mitat">Teoksen mitat (korkeus X leveys)</label>
                    <input id="input_teoksen_mitat" class="teos" type="text" pattern="[xX0-9 ]{2,30}" name="teoksen_mitat" />
                <br><br><br>
                 <label for="input_aukon_mitat">Aukon mitat (korkeus X leveys)</label>
                    <input id="input_aukon_mitat" class="teos" type="text" pattern="[xX0-9 ]{2,30}" name="aukon_mitat" />
                <br><br><br>
                <label for="input_kuva_alan_mitat">Kuva-alan mitat (korkeus X leveys)</label>
                    <input id="input_kuva-alan_mitat" class="teos" type="text" pattern="[xX0-9 ]{2,30}" name="kuva_alan_mitat" />
                <br><br><br>
                <label for="input_kehyksen_mitat">Kehyksen mitat (korkeus X leveys)</label>
                    <input id="input_kehyksen_mitat" class="teos" type="text" pattern="[xX0-9 ]{2,30}" name="kehyksen_mitat" />
                <br><br><br>
                 <label for="input_kehyksen_materiaali">Kehyksen materiaali (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>
                    <input id="input_kehyksen_materiaali" class="teos" type="text" pattern="{2,60}" name="kehyksen_materiaali" />
                <br><br><br>
                <label for="input_jalustan_mitat">Jalustan mitat (korkeus X leveys)</label>
                    <input id="input_jalustan_mitat" class="teos" type="text" pattern="[xX0-9 ]{2,30}" name="jalustan_mitat" />
                <br><br><br>
                <label for="input_jalustan_materiaali">Jalustan materiaalit (v‰hint‰‰n 2 merkki‰, enint‰‰n 30 merkki‰)</label>
                    <input id="input_jalustan_materiaali" class="teos" type="text" pattern="{2,30}" name="jalustan_materiaalit" />
                <br><br><br>
                 <label for="input_etupuolen_merkinnat">Etupuolen merkinn‰t (mit‰ merkinnˆiss‰ lukee, v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>
                    <input id="input_etupuolen_merkinnnat" class="teos" type="text" pattern="{2,150}" name="etupuolen_merkinnat" />
                <br><br><br>
                 <label for="input_kaantopuolen_merkinnat">K‰‰ntˆpuolen merkinnat (mit‰ merkinnˆiss‰ lukee, v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>
                    <input id="input_kaantopuolen_merkinnnat" class="teos" type="text" pattern="{2,150}" name="takapuolen_merkinnat" />
                <br>
                <h2 class = 'lisayshead' class = 'lisayshead'>4. Kuntotiedot</h2>
                <br>
                <label for="input_teoksen_kunto">Teoksen kunto (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>
                    <input id="input_teoksen_kunto" class="teos" type="text" pattern="{2,60}" name="teoksen_kunto" />
                <br><br><br>
                <label for="input_konservointiasiakirjat">Konservointiasiakirjat (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>
                    <input id="input_konservointiasiakirjat" class="teos" type="text" pattern="{2,150}" name="konservointiasiakirjat" />
                <br><br><br>
                  <label for="input_hoito_id"> Hoito-id (olemassaoleva)</label>
                    <input id="input_hoito_id" class="teos" type="text" pattern="[0-9]{1,6}" name="hoito_id" />
                <br>
                <h2 class = 'lisayshead'>5. Poisto</h2>
                <br>
                     <label for="input_aktiivisuustila"> Aktiivisuustila (0 eli ei-aktiivinen tai 1 eli aktiivinen)</label>
                    <input id="input_aktiivisuustila" class="teos" type="text" pattern="[0-1]{1}" name="aktiivisuustila" required />
                <br><br><br>
                    <label for="input_poistoperuste">Poistoperuste (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>
                    <input id="input_poistoperuste" class="teos" type="text" pattern="{2,60}" name="poistoperuste" />
                <br><br><br>
                    <label for="input_poistoajankohta">Poistoajankohta (muotoa 2001-01-31)</label>
                    <input id="input_poistoajankohta" class="teos" type="date" placeholder="YYYY-MM-DD" name="poistoajankohta" />
                 <br>
                 <h2 class = 'lisayshead'>6. Sijoitus</h2>
                 <br>
                  <label for="input_Sijoitus_id"> Sijoitus-id (olemassaoleva)</label>
                    <input id="input_Sijoitus_id" class="teos" type="text" pattern="[0-9]{1,6}" name="sijoitus_id" />
                <br>
                <h2 class = 'lisayshead'>7. Hankintatiedot</h2>
                <br>
                    <label for="input_hankintatapa">Hankintatapa (v‰hint‰‰n 2 merkki‰, enint‰‰n 60 merkki‰)</label>
                    <input id="input_hankintatapa" class="teos" type="text" pattern="{2,60}" name="hankintatapa" />
                <br><br><br>
                    <label for="input_hankintahinta"> Hankintahinta (enint‰‰n 10 merkki‰ joista 2 on desimaaleja, erota desimaalit pisteell‰)</label>
                    <input id="input_hankintahinta" class="teos" type="text" pattern="[0-9.]{0,10}" name="hankintahinta" />
                <br><br><br>
                    <label for="input_hankinta_aika">Hankinta-aika (muotoa 2000-01-31)</label>
                    <input id="input_hankinta_aika" class="teos" type="date" placeholder="YYYY-MM-DD" name="hankinta_aika" pattern=".{6,}" />
                <br><br><br>
                   <label for="input_hankintapaikka">Hankintapaikka (v‰hint‰‰n 2 merkki‰, enint‰‰n 20 merkki‰)</label>
                    <input id="input_hankintapaikka" class="teos" type="text" pattern="{2,60}" name="hankinta_paikka" />
                <br><br><br>
                    <label for="input_omistajuushistoria">Omistajuushistoria (v‰hint‰‰n 2 merkki‰, enint‰‰n 100 merkki‰)</label>
                    <input id="input_omistajuushistoria" class="teos" type="text" pattern="{2,100}" name="omistajuushistoria" />
                <br>
                <h2 class = 'lisayshead'>8. Arvotiedot</h2>
                <br>
                    <label for="input_vakuutusarvo"> Vakuutusarvo (enint‰‰n 10 merkki‰ joista 2 on desimaaleja, erota desimaliit pisteell‰)</label>
                    <input id="input_vakuutusarvo" class="teos" type="text" pattern="[0-9.]{0,10}" name="vakuutusarvo" />
                <br><br><br>
                    <label for="input_vakuutusarvon_selite">Vakuutusarvon selite (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>
                    <input id="input_vakuutusarvon_selite" class="teos" type="text" pattern="{2,150}" name="vakuutusarvon_selite" />
                <br>
                <h2 class = 'lisayshead'>9. Tekij‰noikeustiedot</h2>
                <br>
                    <label for="input_tekijanoikeustiedot">Tekijanoikeustiedot (v‰hint‰‰n 2 merkki‰, enint‰‰n 100 merkki‰)</label>
                    <input id="input_tekijanoikeustiedot" class="teos" type="text" pattern="{2,100}" name="tekijanoikeustiedot" />
                <br><br><br>
                  <label for="input_tekijanoikeuden_vapautuminen">Tekijanoikeuden vapautuminen (muotoa 2000-01-31)</label>
                    <input id="input_tekijanoikeuden_vapautuminen" class="teos" type="date" placeholder="YYYY-MM-DD" name="tekijanoikeuden_vapautuminen" pattern=".{6,}" />
                <br>
                <h2 class = 'lisayshead'>10. Kuvatiedot</h2>
                <br>
                <h2 class = 'lisayshead'>11. Arkisto- ja tutkimusmateriiali</h2>
                <br>
                <label for="input_tutkimusmateriaali">Tutkimusmateriaali (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>
                    <input id="input_tutkimusmateriaali" class="teos" type="text" pattern="{2,150}" name="tutkimusmateriaali" />
                <br><br><br>
                <label for="input_nayttelytiedot">Nayttelytiedot (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>
                    <input id="input_nayttelytiedot" class="teos" type="text" pattern="{2,150}" name="nayttelytiedot" />
                <br>
                <h2 class = 'lisayshead'>12. Muuta</h2>
                <br>
                <label for="input_muutieto">Muu tieto (v‰hint‰‰n 2 merkki‰, enint‰‰n 150 merkki‰)</label>
                    <input id="input_muutieto" class="teos" type="text" pattern="{2,150}" name="muu_tieto" />
                <br><br><br>
                <input type="submit"  name="lisays_teos" value="Lis‰‰ teos" />
            </fieldset>
        </form>
        </div>
        <br><br><br>
        <!-- backlink -->
        <div class link>
            <a href="../index.php" class = "peru">Peruuta</a>
        </div>
    </body>
</html>