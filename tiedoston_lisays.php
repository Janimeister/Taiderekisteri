<?php
$ds          = DIRECTORY_SEPARATOR;  //1
 
$tallennuskansio = 'kuvat';   //2
 
if (!empty($_FILES)) {
     
    $valiaikainentalletus = $_FILES['file']['tmp_name'];          //3             
      
    $polku = dirname( __FILE__ ) . $ds. $tallennuskansio . $ds;  //4
     
    $kohdekansio =  $polku. $_FILES['file']['name'];  //5
 
    move_uploaded_file($valiaikainentalletus,$kohdekansio); //6
     
}
?>