 <?php
include'verificare.php';



include'admin_barasus.php';
include'admin_logomeniu.php';

if(isset($_POST['fisier'])){
        $nume_nou="stoc".".csv";
		$target_path = "../administrare/fisiere_importate/";
		$target_path = $target_path . $nume_nou;
        move_uploaded_file($_FILES['fisier']['tmp_name'], $target_path);

include'conectare.php';

$introdu="LOAD DATA LOCAL INFILE 'C:/wamp/www/administrare/fisiere_importate/stoc.csv' INTO TABLE preluare_stoc FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'(id_preluare, stoc_preluare,pret_preluare,denumire_preluare)";
$raspuns=mysql_query($introdu) or die (mysql_error());
$cautare=mysql_query("SELECT * FROM preluare_stoc WHERE id_preluare NOT IN (SELECT id_produs FROM produse)");
$raspuns=mysql_num_rows($cautare);
if($raspuns>0){
while($rind=mysql_fetch_array($raspuns){

$id_preluare=$rind['id_preluare'];
$denumire_preluare=$rind['denumire_preluare'];
$stoc_preluare=$rind['stoc_preluare'];
$pret_preluare=$rind['pret_preluare'];
$introducere=mysql_query("INSERT INTO produse (id_produs,denumire_produs,stoc_produs,pret_produs) VALUES ('$id_preluare','$denumire_preluare','$stoc_preluare','$pret_preluare')");
}
}
$cautare1=mysql_query("SELECT * FROM preluare_stoc WHERE id_preluare IN (SELECT id_produs FROM produse)");
$raspuns1=mysql_num_rows($cautare1);
if($raspuns1>0){
while($rind1=mysql_fetch_array($raspuns1){

$id_preluare1=$rind1['id_preluare'];
$denumire_preluare1=$rind1['denumire_preluare'];
$stoc_preluare1=$rind1['stoc_preluare'];
$pret_preluare1=$rind1['pret_preluare'];
$actualizare=mysql_query("UPDATE produse SET denumire_produs='$denumire_preluare1',stoc_produs='$stoc_preluare1',pret_produs='$pret_preluare1' WHERE id_produs='$id_preluare1'");

}
}
}
?>

<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;Mesaje</h3>
</br>
<ul class="meniu_vertical">
<li><a href="admin_initializare.php"><img src="../poze/document.gif" border="0" alt="" />Initializare stoc</a></li>
<li><a href="admin_actualizare.php"><img src="../poze/document.gif" border="0" alt="" />Actualizare stoc</a></li>
</ul>


</div>
<div class="spatiu_mesaj"></br></br></br>
<form enctype="multipart/form-data" action="admin_actualizare.php" method="post" name="formular_actualizare_produse">
<table align="center" border="0" cellpadding="5">
<tr><td align="right"><b>Introdu fisierul:</b></td><td><input type="file" name="fisier"></td></tr>
<tr>
	<td><input type="submit" value="Actualizeaza"></td>
	</tr>
</table>




<form>
</div>

<?php
include'admin_barajos.php';
?>