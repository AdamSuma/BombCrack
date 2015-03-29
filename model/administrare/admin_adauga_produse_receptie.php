 <?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';




$randuri='';
 if ((isset($_POST["criteriu"]))&&(strlen($_POST["criteriu"])>0)){
 include('conectare.php');
 $criteriu=$_POST["criteriu"];
 $intrebare = mysql_query("SELECT * FROM produse WHERE denumire_produs LIKE '%".$criteriu."%'");
 $num_rows = mysql_num_rows($intrebare);
 if ($num_rows>1){
 echo " Sau gasit $num_rows rezultate";
  }
 else if ($num_rows==1){
 echo "Sa gasit un singur rezultat";
 }

 else  {
 echo "Nu sa gasit nici un rezultat";
 }

$randuri.= '<table with="800"align="center" border="1">
 <tr><th>Cod produs</th><th>Denumire</th><th>UM</th><th>Pret</th><th>Stoc</th><th>Actiune</th></tr>';
 while($row=mysql_fetch_array($intrebare)){
$cod_produs=$row['id_produs'];
$denumire_produs=$row['denumire_produs'];
$pret_produs=$row['pret_produs'];
$stoc_produs=$row['stoc_produs'];
  
$randuri.='<tr><td>'.$cod_produs.'</td><td>'.$denumire_produs.'</td><td>buc</td><td>'.$pret_produs.'</td><td>'.$stoc_produs.'</td><td><a href="admin_receptii.php?fid_produs='.$cod_produs.'&actiune=adauga">Adauga</a></td></tr>';

      
    }

 }
 
?>

<h1>Cautare piese auto</h1>
<form method="post" action="admin_adauga_produse_receptie.php">
<input type="hidden" name="selectat" />

<label>Criteriu de cautare:<input type="text" name="criteriu"/></label>
<input type="submit" value="Cauta"/>
</form>







<?php
echo $randuri;
?>
</table>









<?php
include'admin_barajos.php';
?>