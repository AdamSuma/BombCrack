<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';

include'conectare.php';
$mesaj='';
if(isset($_GET['id_produs'])){

$id_produs=$_GET['id_produs'];

  $sterge_produs=mysql_query("DELETE FROM produse WHERE id_produs='$id_produs' LIMIT 1");
  $verificare_stergere=mysql_affected_rows();
  if($verificare_stergere=1){
  header('Location:admin_produse.php');
  }else if($verificare_stergere=0){
  $mesaj.='Nu sa putut sterge produsul!';
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
<div class="fspatiuprodus">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $mesaj; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="admin_produse.php">Inapoi</a>

</div>
<?php
include'admin_barajos.php';
?>