<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';

include'conectare.php';

if(isset($_GET['id_produs'])){

$id_produs=$_GET['id_produs'];

  $intrebare=mysql_query("SELECT * FROM produse WHERE id_produs='$id_produs' ");
  while($rand=mysql_fetch_array($intrebare)){

$denumire_produs=$rand['denumire_produs'];
$um_produs=$rand['um_produs'];
$descriere_produs=$rand['descriere_produs'];
$pret_produs=$rand['pret_produs'];
$producator=$rand['producator'];
$furnizor=$rand['furnizor'];
$adresa_imagine="../poze/poze_produse/".$rand['id_produs'].".jpg";
				if(file_exists($adresa_imagine))
					{
						$imagine='<img src="'.$adresa_imagine.'" width="80" height="60">';
					}
					else
						{
							$imagine= '<div style="width:80px; height:60px; border:1px black  solid; background-color:#cccccc;">Fara Imagine</div>';
						}

}
}
if(isset($_POST['id_produs'])){
$id_produs=$_POST['id_produs'];
$denumire_produs=$_POST['denumire_produs'];
$um_produs=$_POST['um_produs'];
$descriere_produs=$_POST['descriere_produs'];
$pret_produs=$_POST['pret_produs'];
$producator=$_POST['producator'];
$introducere=mysql_query("UPDATE produse SET denumire_produs='$denumire_produs',um_produs='$um_produs',descriere_produs='$descriere_produs',pret_produs='$pret_produs',producator='$producator' WHERE id_produs='$id_produs'") or die (mysql_error());

$sql2="select id_produs from produse where id_produs='$id_produs'";
		mysql_query($sql2) or die(mysql_error());
		$id_nou=mysql_result(mysql_query($sql2),0);
		$id_nou=$id_nou.".jpg";
		$target_path = "../poze/poze_produse/";
		$target_path = $target_path . $id_nou;
        move_uploaded_file($_FILES['poza']['tmp_name'], $target_path);

$adresa_imagine="../poze/poze_produse/".$id_produs.".jpg";
				if(file_exists($adresa_imagine))
					{
						$imagine='<img src="'.$adresa_imagine.'" width="80" height="60">';

					}
					else
						{
							$imagine= '<div style="width:80px; height:60px; border:1px black  solid; background-color:#cccccc;">Fara Imagine</div>';
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
<ul>


</div>
<div class="fspatiuprodus"><br/><h1 align="center">Modificare produs</h1>
<form enctype="multipart/form-data" action="modifica_produs.php" method="post" name="formular_modificare_produse">
<table align="center" border="0" cellpadding="5">
<tr><td align="right"><b>Cod:</b></td><td><input type="text" name="id_produs" value="<?php echo $id_produs;?>"/></td></tr>
<tr><td align="right"><b>Denumire:</b></td><td><input type="text" name="denumire_produs" size="50" value="<?php echo $denumire_produs;?>" /></td></tr>
<tr><td align="right"><b>UM:</b></td><td><select name="um_produs" value="<?php echo $um_produs;?>">
<option value="buc">Buc</option>
<option value="bax">Bax</option>
<option value="cm">Cm</option>
<option value="g">G</option>
<option value="kg">KG</option>
<option value="ml">ML</option>
<option value="pac">Pac</option>
</select></td></tr>
<tr><td align="right"><b>Descriere:</b></td><td><textarea name="descriere_produs" rows="4" cols="20"><?php echo $descriere_produs;?></textarea></td></tr>
<tr><td align="right"><b>Pret vinzare cu TVA:</b></td><td><input type="text" name="pret_produs" value="<?php echo $pret_produs;?>"/></td></tr>
<tr><td align="right"><b>Producator:</b></td><td><input type="text" name="producator" value="<?php echo $producator;?>"/></td></tr>
<tr><td align="right"><b>Poza:</b></td><td><?php echo $imagine;?><a href="sterge_poza.php?id_produs=<?php echo $id_produs;?>">Sterge poza</a></td></tr>
<tr><td align="right"><b>Poza:</b></td><td><input type="file" name="poza"></td></tr>
<tr>
	<td align="right"><a href="admin_produse.php">Inapoi</a></td>
	<td><input type="submit" name="modifica_produs" value="Modifica Produs"></td>
	</tr>
</table>
</form>

</div>
<?php
include'admin_barajos.php';
?>