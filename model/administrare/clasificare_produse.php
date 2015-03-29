<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';
$mesaj='';
$id_produs='';
$denumire_produs='';
if((isset($_GET['id_produs']))&&(strlen($_GET['id_produs'])>0)){

$id_produs=$_GET['id_produs'];
 include'conectare.php';

$intrebare=mysql_query("SELECT denumire_produs FROM produse WHERE id_produs=$id_produs");
$raspuns=mysql_num_rows($intrebare);
if($raspuns>0){
while($rand=mysql_fetch_array($intrebare)){

$denumire_produs=$rand['denumire_produs'];
}


 }
 }

$rezultat_categorie='';
$rezultat_masina='';
$rezultat_subcategorie='';
$rezultat_motorizare='';
include'conectare.php';

$intrebare_categorie=mysql_query("SELECT * FROM categorii");
while($rand_categorie=mysql_fetch_array($intrebare_categorie)){
$id_categorie=$rand_categorie['id_categorie'];
$dotare_categorie=$rand_categorie['categorie'];
$rezultat_categorie.='<option value='.$rand_categorie['id_categorie'].'>'.$rand_categorie['categorie'].'</option>';
}

 $masina = $subcategorie_masina = $motorizare = ''; 

$conn = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('licenta',$conn);



if(isset($_GET["masina"]))
{
    $masina = $_GET["masina"];
}

if(isset($_GET["subcategorie_masina"]) && is_numeric($_GET["subcategorie_masina"]))
{
    $subcategorie_masina = $_GET["subcategorie_masina"];
}

if(isset($_GET["motorizare"]) && is_numeric($_GET["motorizare"]))
{
    $motorizare = $_GET["motorizare"];
}

$sql = "SELECT * FROM masina";
        $masini = mysql_query($sql,$conn);

        while($row = mysql_fetch_array($masini))
        {
            $rezultat_masina.="<option value=\"$row[id_masina]\" " . ($masina == $row["id_masina"] ? " selected" : "") . ">$row[masina]</option>";
        }
 if($masina != null && is_numeric($masina))
    {
     $sql = "SELECT id_subcategorie_masina, subcategorie_masina FROM subcategorie_masina WHERE id_masina = $masina ";
        $subcategorie_masini = mysql_query($sql,$conn);

        while($row = mysql_fetch_array($subcategorie_masini))
        {
           $rezultat_subcategorie.="<option value=\"$row[id_subcategorie_masina]\" " . ($subcategorie_masina == $row["id_subcategorie_masina"] ? " selected" : "") . ">$row[subcategorie_masina]</option>";
        }
        }
      if($subcategorie_masina != null && is_numeric($subcategorie_masina) && $masina != null)
    {
    $sql = "SELECT id_motorizare,motorizare FROM motorizare WHERE id_subcategorie_masina = $subcategorie_masina ";
        $motorizari = mysql_query($sql,$conn);

        while($row = mysql_fetch_array($motorizari))
        {
            $rezultat_motorizare.="<option value=\"$row[id_motorizare]\" " . ($motorizare == $row["id_motorizare"] ? " selected" : "") . ">$row[motorizare]</option>";
        }
        }

if((isset($_GET['adauga_produs']))&&(strlen($_GET['id_produs'])>0)&&(($_GET['categorie'])>0)){
$id_produs=$_GET['id_produs'];
$id_masina=$_GET['masina'];
$id_subcategorie_masina=$_GET['subcategorie_masina'];
$id_motorizare=$_GET['motorizare'];
$id_categorie=$_GET['categorie'];




$introducere=mysql_query("INSERT INTO clasificare_piese ( id_masina,id_subcategorie_masina,id_motorizare,id_produs,id_categorie ) values ( '$id_masina','$id_subcategorie_masina','$id_motorizare','$id_produs','$id_categorie')");
$raspuns=mysql_affected_rows();
if($raspuns==1){
  $mesaj.='A-ti introdus cu succes datele';
header('refresh: 4; url=http://localhost/administrare/clasificare_produse.php');
}
}else if((isset($_GET['id_produs']))&&(strlen($_GET['id_produs'])==0)){

$mesaj.='Nu sint date suficiente';
header('refresh: 4; url=http://localhost/administrare/clasificare_produse.php');
}else if((!isset($_GET['id_produs']))||(strlen($_GET['id_produs'])==0)){

$mesaj.='Nu sint date suficiente';
header('refresh: 4; url=http://localhost/administrare/admin_produse.php');
}else if(isset($_GET['adauga_produs'])&&(($_GET['categorie'])==0)){
$mesaj.='Nu ai selectat o categorie';

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
<li><a href="adauga_producator.php"><img src="../poze/document.gif" border="0" alt="" />Adauga producator</a></li>
<ul>


</div>
<div class="fspatiuprodus"><br/><h1 align="center">Clasificare produs</h1>
<form enctype="multipart/form-data"  method="get" name="theForm">
<table align="center" border="0" cellpadding="5">
<tr><td align="right"><b>Cod:</b></td><td><input type="text" name="id_produs"size="20" value="<?php echo $id_produs;?>"/></td></tr>
<tr><td align="right"><b>Denumire:</b></td><td><?php echo $denumire_produs;?></td></tr>
<tr><td align="right"><b>Masina:</b></td><td><select name="masina" onChange="autoSubmit();"><option value="0">Alege masina</option><?php echo $rezultat_masina;?> </select></td></tr>
<tr><td align="right"><b>Model:</b></td><td> <select name="subcategorie_masina" onChange="autoSubmit();"><option value="0">Alege model</option><?php echo $rezultat_subcategorie;?></select></td></tr>
<tr><td align="right"><b>Motorizare:</b></td><td> <select name="motorizare" onChange="autoSubmit();"><option value="0">Alege motorizare</option><?php echo $rezultat_motorizare;?></select></td></tr>
<tr><td align="right"><b>Categorie:</b></td><td><select name="categorie"><option value="0">Selecteaza</option><?php echo $rezultat_categorie;?></select></td></tr>
<tr>
	<td></td>
	<td><input type="submit" name="adauga_produs" value="Adauga"></td>
    	</tr>
        <tr><td></td><td style=" color: #FF0000"><b><?php echo $mesaj;?></b></td></tr>
</table>
</form>

<a href="admin_produse.php">Inapoi</a>
</div>
<?php
include'admin_barajos.php';
?>