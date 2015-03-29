<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';


$mesaj_eroare='';

$rezultat_furnizor='';
include'conectare.php';
$intrebare_furnizor=mysql_query("SELECT * FROM furnizori");
while($rand_furnizor=mysql_fetch_array($intrebare_furnizor)){
$id_furnizor=$rand_furnizor['id_furnizor'];
$denumire_firma=$rand_furnizor['denumire_firma'];
$rezultat_furnizor.='<option value='.$rand_furnizor['id_furnizor'].'>'.$rand_furnizor['denumire_firma'].'</option>';
}




if((isset($_POST['id_produs']))&&(strlen($_POST['id_produs'])>0)&&(strlen($_POST['denumire'])>1)&&(strlen($_POST['pret_produs'])>0)){
$id_produs=$_POST['id_produs'];
$denumire_produs=$_POST['denumire'];
$um_produs=$_POST['um_produs'];
$descriere_produs=$_POST['descriere_produs'];
$pret_produs=$_POST['pret_produs'];
$producator=$_POST['producator'];
$furnizor=$_POST['furnizor'];



$verificare=mysql_query("SELECT id_produs FROM produse WHERE id_produs=$id_produs");
$raspuns_randuri=mysql_num_rows($verificare);
if($raspuns_randuri==1){

$mesaj_eroare.="<font size='-1' color='#DC143C'>Exista deja un produs cu acest cod,introdu alt cod pentru produs!</font>";


}else{



$introducere=mysql_query("INSERT INTO produse ( id_produs,denumire_produs,um_produs,descriere_produs,stoc_produs,pret_produs,producator,furnizor ) values ( '$id_produs','$denumire_produs','$um_produs','$descriere_produs','0','$pret_produs','$producator','$furnizor' )");
$raspuns_introducere=mysql_affected_rows();
if($raspuns_introducere==1){

$mesaj_eroare.="<font size='-1' color='#0000CD'>A-ti introdus cu succes produsul in baza de date!</font>";

}else if($raspuns_introducere==0){

$mesaj_eroare.="<font size='-1' color='#DC143C'>A aparut o eroare la introducerea produsului in baza de date!</font>";
}

$sql2="select id_produs from produse where id_produs='$id_produs'";
		mysql_query($sql2) or die(mysql_error());
		$id_nou=mysql_result(mysql_query($sql2),0);
		$id_nou=$id_nou.".jpg";
		$target_path = "poze/poze_produse/";
		$target_path = $target_path . $id_nou;
        move_uploaded_file($_FILES['poza']['tmp_name'], $target_path);




}
}else if((isset($_POST['id_produs']))&&(strlen($_POST['id_produs'])==0)){
$mesaj_eroare.="<font size='-1' color='#DC143C'>Nu ai introdus cod produs</font>";
}else if((isset($_POST['id_produs']))&&(strlen($_POST['denumire'])<2)){
$mesaj_eroare.="<font size='-1' color='#DC143C'>Denumirea trebuie sa aiba cel putin 2 caractere</font>";
}else if((isset($_POST['id_produs']))&&(strlen($_POST['pret_produs'])==0)){
$mesaj_eroare.="<font size='-1' color='#DC143C'>Nu ai introdus pret pentru produs</font>";
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
<div class="fspatiuprodus"><br/><h1 align="center">Adaugare produs</h1><br />
 <h1 align="center"><?php echo $mesaj_eroare?></h1>
<form enctype="multipart/form-data" action="adauga_produs.php" method="post" name="formular_adaugare_produse">
<table align="center" border="0" cellpadding="5">
<tr><td align="right"><b>Cod:</b></td><td><input type="text" name="id_produs" /></td></tr>
<tr><td align="right"><b>Denumire:</b></td><td><input type="text" name="denumire" /></td></tr>
<tr><td align="right"><b>UM:</b></td><td><select name="um_produs">
<option value="buc">Buc</option>
<option value="bax">Bax</option>
<option value="cm">Cm</option>
<option value="g">G</option>
<option value="kg">KG</option>
<option value="ml">ML</option>
<option value="pac">Pac</option>
</select></td></tr>
<tr><td align="right"><b>Descriere:</b></td><td><textarea name="descriere_produs" rows="4" cols="20"> </textarea></td></tr>
<tr><td align="right"><b>Pret vinzare cu TVA:</b></td><td><input type="text" name="pret_produs" /></td></tr>
<tr><td align="right"><b>Producator:</b></td><td><input type="text" name="producator" /></td></tr>
<tr><td align="right"><b>Furnizor:</b></td><td><select name="furnizor"><option value="">Selecteaza</option><?php echo $rezultat_furnizor?></select></td></tr>
<tr><td align="right"><b>Poza:</b></td><td><input type="file" name="poza"></td></tr>
<tr>
	<td align="right"><a href="admin_produse.php">Inapoi</a></td>
	<td><input type="submit" name="adauga_produs" value="Adauga Produs"></td>
	</tr>
</table>
</form>
</div>
<?php
include'admin_barajos.php';
?>