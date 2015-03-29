<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';
$mesaj_eroare='';
include('conectare.php');
if((isset($_POST['masina']))&&(strlen($_POST['masina'])>0)&&(strlen($_POST['model'])>0)&&(strlen($_POST['motorizare'])>0)){

$masina=$_POST['masina'];
$model=$_POST['model'];
$motorizare=$_POST['motorizare'];
$verifica_masina=mysql_query("SELECT masina FROM masina WHERE masina='$masina'")or die(mysql_error());
$raspuns_verificare_masina=mysql_num_rows($verifica_masina);
if($raspuns_verificare_masina==1){
$mesaj_eroare.="<font size='-1' color='#DC143C'>Exista deja o masina cu aceasta denumire,pentru a adauga model click <a href='clasificare_trimitere.php'>Aici</a>!</font>";
}else if($raspuns_verificare_masina==0){

$adauga_masina=mysql_query("INSERT INTO masina (masina) VALUES ('$masina')")or die(mysql_error());
$id_masina=mysql_insert_id();
$adauga_model=mysql_query("INSERT INTO  subcategorie_masina  (id_masina,subcategorie_masina ) VALUES ('$id_masina','$model')")or die(mysql_error());
$id_model=mysql_insert_id();
$adauga_motorizare=mysql_query("INSERT INTO  motorizare  (id_subcategorie_masina ,motorizare ) VALUES ('$id_model','$motorizare')")or die(mysql_error());
$verifica_adauga_motorizare=mysql_affected_rows();
if($verifica_adauga_motorizare==1){
$mesaj_eroare.="<font size='-1' color='#DC143C'>A-ti adaugat cu succes datele!</font>";
}else if($verifica_adauga_motorizare==0){
$mesaj_eroare.="<font size='-1' color='#DC143C'>A aparut o eroare la introducerea datelor!</font>";
}
}
}else if((isset($_POST['masina']))&&(strlen($_POST['masina'])==0)){

$mesaj_eroare.="<font size='-1' color='#DC143C'>Nu a-ti introdus masina!</font>";

}else if((isset($_POST['masina']))&&(strlen($_POST['model'])==0)){

$mesaj_eroare.="<font size='-1' color='#DC143C'>Nu a-ti introdus model!</font>";

}else if((isset($_POST['masina']))&&(strlen($_POST['motorizare'])==0)){

$mesaj_eroare.="<font size='-1' color='#DC143C'>Nu a-ti introdus motorizare!</font>";

}
?>
<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;ACTIUNI</h3>
</br>
<ul class="meniu_vertical">
<li><a href="adauga_produs.php"><img src="../poze/document.gif" border="0" alt="" />Adauga produs</a></li>
<li><a href="adauga_categorie.php"><img src="../poze/document.gif" border="0" alt="" />Adauga categorie</a></li>
<li><a href="adauga_masina.php"><img src="../poze/document.gif" border="0" alt="" />Adauga masina</a></li>
<li><a href="adauga_model.php"><img src="../poze/document.gif" border="0" alt="" />Adauga model</a></li>
<li><a href="adauga_motorizare.php"><img src="../poze/document.gif" border="0" alt="" />Adauga motorizare</a></li>
<ul>
</div>
<div class="fspatiuprodus"><br/><h1 align="center">Adauga o masina</h1><br />
<h1 align="center"><font size='-1' color='#808080'>Cand adaugati o masina este obligatoriu sa adaugati cel putin un model si o motorizare.</font></h1>
 <h1 align="center"><?php echo $mesaj_eroare;?></h1>
<form enctype="multipart/form-data" action="adauga_masina.php" method="post" name="formular_adaugare_masina"/>
<table align="center" border="0" cellpadding="5">
<tr><td align="right"><b>Masina:</b></td><td><input type="text" name="masina" /></td></tr>
<tr><td align="right"><b>Model:</b></td><td><input type="text" name="model" /></td></tr>
<tr><td align="right"><b>Motorizare:</b></td><td><input type="text" name="motorizare" /></td></tr>
<tr>
	<td align="right"><a href="admin_produse.php">Inapoi</a></td>
	<td><input type="submit" value="Adauga"></td>
	</tr>
</table>
</form>
</div>

<?php
include'admin_barajos.php';
?>