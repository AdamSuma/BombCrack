<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';
$mesaj='';
$rezultat_masina=$masina=$subcategorie_masina= $rezultat_subcategorie='';
include('conectare.php');

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

$masini = mysql_query("SELECT * FROM masina");
         while($row = mysql_fetch_array($masini))
        {
            $rezultat_masina.="<option value=\"$row[id_masina]\" " . ($masina == $row["id_masina"] ? " selected" : "") . ">$row[masina]</option>";
        }
 if($masina != null && is_numeric($masina))
    {
     $subcategorie_masini = mysql_query("SELECT id_subcategorie_masina, subcategorie_masina FROM subcategorie_masina WHERE id_masina = $masina ");
        
        while($row = mysql_fetch_array($subcategorie_masini))
        {
           $rezultat_subcategorie.="<option value=\"$row[id_subcategorie_masina]\" " . ($subcategorie_masina == $row["id_subcategorie_masina"] ? " selected" : "") . ">$row[subcategorie_masina]</option>";
        }
        }



if((isset($_GET['masina']))&&(strlen($_GET['masina'])>0)&&(strlen($_GET['subcategorie_masina'])>0)&&(strlen($_GET['motorizare'])>0)){

$masina=$_GET['masina'];
$model=$_GET['subcategorie_masina'];
$motorizare=$_GET['motorizare'];
$verifica_motorizare=mysql_query("SELECT motorizare FROM motorizare  WHERE id_subcategorie_masina='$model' AND motorizare='$motorizare'")or die(mysql_error());
$raspuns_verificare_motorizare=mysql_num_rows($verifica_motorizare);
if($raspuns_verificare_motorizare==1){
$mesaj.="<font size='-1' color='#DC143C'>Exista deja o motorizare cu aceasta denumire!Datele nu au fost adaugate.</font>";
}else if($raspuns_verificare_motorizare==0){
$adauga_motorizare=mysql_query("INSERT INTO  motorizare  (id_subcategorie_masina ,motorizare ) VALUES ('$model','$motorizare')")or die(mysql_error());
$verifica_adauga_motorizare=mysql_affected_rows();
if($verifica_adauga_motorizare==1){
$mesaj.="<font size='-1' color='#DC143C'>A-ti adaugat cu succes datele!</font>";
}else if($verifica_adauga_motorizare==0){
$mesaj.="<font size='-1' color='#DC143C'>A aparut o eroare la introducerea datelor!</font>";
}
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
<div class="fspatiuprodus"><br/><h1 align="center">Adauga model de masina</h1><br />
<h1 align="center"><font size='-1' color='#808080'>Cand adaugati un model de masina trebuie obligatoriu sa adaugati si o motorizare.</font></h1>
 <h1 align="center"><?php echo $mesaj;?></h1>
<form enctype="multipart/form-data" action="adauga_motorizare.php" method="get" name="theForm"/>
<table align="center" border="0" cellpadding="5">
<tr><td align="right"><b>Masina:</b></td><td><select name="masina" onChange="autoSubmit();"><option value="0">Alege masina</option><?php echo $rezultat_masina;?> </select></td></tr>
<tr><td align="right"><b>Model:</b></td><td> <select name="subcategorie_masina" onChange="autoSubmit();"><option value="0">Alege model</option><?php echo $rezultat_subcategorie;?></select></td></tr>
<tr><td align="right"><b>Motorizare:</b></td><td><input type="text" name="motorizare" /></td></tr>
<tr>
	<td align="right"><a href="admin_motorizare.php">Inapoi</a></td>
	<td><input type="submit" value="Adauga"></td>
	</tr>
</table>
</form>
</div>

<?php
include'admin_barajos.php';
?>