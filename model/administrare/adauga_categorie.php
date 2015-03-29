<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';
$mesaj_eroare='';
$mesaj_eroare1='';
$mesaj_eroare2='';
$rezultat_categorie='';
include('conectare.php');
//adauga categorie
if((isset($_POST["categorie"]))&&(strlen($_POST["categorie"])>0)){
$categorie=$_POST["categorie"];
$verificare_categorie=mysql_query("SELECT categorie FROM categorii WHERE categorie='$categorie'");
$randuri_raspuns=mysql_num_rows($verificare_categorie);
if($randuri_raspuns==1){
$mesaj_eroare.="<font size='-1' color='#DC143C'>Exista deja o categorie identica!</font>";
}else if($randuri_raspuns==0){
$introdu_categorie=mysql_query("INSERT INTO categorii (categorie) VALUES ('$categorie')");
$verificare_introducere=mysql_affected_rows();

if($verificare_introducere==1){
$mesaj_eroare.="<font size='-1' color='#0000CD'>A-ti introdus cu succes categoria!</font>";

}else if($verificare_introducere==0){
 $mesaj_eroare.="<font size='-1' color='#DC143C'>A aparut o eroare la inserarea in baza de date!</font>";
}
}
}
//sterge categorie
$intrebare_categorie=mysql_query("SELECT * FROM categorii");
while($rand_categorie=mysql_fetch_array($intrebare_categorie)){
$id_categorie=$rand_categorie['id_categorie'];
$dotare_categorie=$rand_categorie['categorie'];
$rezultat_categorie.="<option value=\"$rand_categorie[id_categorie]\">$rand_categorie[categorie]</option>";
}
if((isset($_POST['sterge_categorie']))&&(strlen($_POST['sterge_categorie'])>0)){

$id_sterge_categorie=$_POST['sterge_categorie'];
$verifica_legaturi_cat=mysql_query("SELECT * FROM clasificare_piese WHERE id_categorie='$id_sterge_categorie'");
$raspuns_verificare=mysql_num_rows($verifica_legaturi_cat);
if($raspuns_verificare>0){
$mesaj_eroare1.="<font size='-1' color='#DC143C'>Nu puteti sterge categoria pentru ca sint produse legate de aceasta categorie!</font>";
}
if($raspuns_verificare==0){
$sterge_categoria=mysql_query("DELETE FROM categorii WHERE id_categorie='$id_sterge_categorie'LIMIT 1");
$raspuns_stergere=mysql_affected_rows();
if($raspuns_stergere==1){
$mesaj_eroare1.="<font size='-1' color='#0000CD'>A-ti sters cu succes categoria!</font>";

}else if($raspuns_stergere==1){
$mesaj_eroare1.="<font size='-1' color='#DC143C'>A aparut o eroare la stergerea categoriei!</font>";
}
}
}
//modifica categorie
if((isset($_POST['modifica_categorie']))&&(strlen($_POST['modifica_categorie'])>0)&&(strlen($_POST['denumire_noua_categorie'])>0)){

$modifica_categorie=$_POST['modifica_categorie'];
$denumire_noua_categorie=$_POST['denumire_noua_categorie'];
$verifica_modificare_categorie=mysql_query("SELECT * FROM categorii WHERE categorie='$denumire_noua_categorie'");
$raspuns_verificare_modificare=mysql_num_rows($verifica_modificare_categorie);
if($raspuns_verificare_modificare>0){
$mesaj_eroare2.="<font size='-1' color='#DC143C'>Exista inca o categorie cu acceasi denumire,nu puteti avea 2 categorii cu denumiri identice!</font>";
}
if($raspuns_verificare_modificare==0){
$modifica_categoria=mysql_query("UPDATE categorii SET categorie='$denumire_noua_categorie'WHERE id_categorie='$modifica_categorie'");
$raspuns_modificare=mysql_affected_rows();
if($raspuns_modificare==1){

$mesaj_eroare2.="<font size='-1' color='#0000CD'>A-ti modificat cu succes categoria!</font>";

}else if($raspuns_modificare==0){

$mesaj_eroare2.="<font size='-1' color='#DC143C'>A aparut o eroare la modificarea datelor!</font>";
}
}else if((isset($_POST['modifica_categorie']))&&(strlen($_POST['modifica_categorie'])==0)){

$mesaj_eroare2.="<font size='-1' color='#DC143C'>Nu a-ti selectat o categorie pentru modificare!</font>";

}else if((isset($_POST['modifica_categorie']))&&(strlen($_POST['denumire_noua_categorie'])==0)){

$mesaj_eroare2.="<font size='-1' color='#DC143C'>Nu a-ti introdus denumirea noua pentru categorie!</font>";

}
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
</ul>


</div>
<div class="spatiudreapta"><br/><h1 align="center">Adauga o categorie de produse</h1><br />
 <h1 align="center"><?php echo $mesaj_eroare;?></h1>
<form enctype="multipart/form-data" action="adauga_categorie.php" method="post" name="formular_adaugare_categorie"/>
<table align="center" border="0" cellpadding="5">
<tr><td align="right"><b>Denumire categorie:</b></td><td><input type="text" name="categorie" /></td></tr>
<tr>
	<td align="right"><a href="clasificare_trimitere.php">Inapoi</a></td>
	<td><input type="submit" value="Adauga categorie"></td>
	</tr>
</table>
</form>



<br/><h1 align="center">Sterge o categorie de produse</h1><br />
 <h1 align="center"><?php echo $mesaj_eroare1;?></h1>
<form enctype="multipart/form-data" action="adauga_categorie.php" method="post" name="formular_stergere_categorie"/>
<table align="center" border="0" cellpadding="5">
<tr><td align="right"><b>Denumire categorie:</b></td><td><select name="sterge_categorie" ><option value="">Alege o categorie</option><?php echo $rezultat_categorie;?></select></td></tr>
<tr>
	<td align="right"><a href="clasificare_trimitere.php">Inapoi</a></td>
	<td><input type="submit" value="Sterge categorie"></td>
	</tr>
</table>
</form>
<h1 align="center"><font size='-1' color='#808080'>Atentie pentru putea sterge o categorie trebuie sa mutati produsele legate de aceasta categorie la alta categorie!</font></h1>

<br/><h1 align="center">Modifica denumirea unei categorii de produse</h1><br />
 <h1 align="center"><?php echo $mesaj_eroare2;?></h1>
<form enctype="multipart/form-data" action="adauga_categorie.php" method="post" name="formular_modificare_categorie"/>
<table align="center" border="0" cellpadding="5">
<tr><td align="right"><b>Categorie:</b></td><td><select name="modifica_categorie" ><option value="">Alege o categorie</option><?php echo $rezultat_categorie;?></select></td></tr>
<tr><td align="right"><b>Denumire noua:</b></td><td><input type="text" name="denumire_noua_categorie" /></td></tr>
<tr>
	<td align="right"><a href="clasificare_trimitere.php">Inapoi</a></td>
	<td><input type="submit" value="Modifica categoria"></td>
	</tr>
</table>
</form>

</div>
<?php
include'admin_barajos.php';
?>