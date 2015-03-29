 <?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';




$randuri='';
 if ((isset($_POST["criteriu"]))&&(strlen($_POST["criteriu"])>0)){
 include('conectare.php');
 $criteriu=$_POST["criteriu"];
 $intrebare = mysql_query("SELECT * FROM furnizori WHERE denumire_firma LIKE '%".$criteriu."%'");
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
 <tr><th>Nume client</th><th>Cod fiscal</th><th>nr_registru_comert</th><th>Sediu</th><th>Actiune</th></tr>';
 while($row=mysql_fetch_array($intrebare)){
$id_furnizor=$row['id_furnizor'];
$denumire_firma=$row['denumire_firma'];
$cod_fiscal=$row['cod_fiscal'];
$nr_registru_comert=$row['nr_reg_com'];
$sediul=$row['sediul'];
  
$randuri.='<tr><td>'.$denumire_firma.'</td><td>'.$cod_fiscal.'</td><td>buc</td><td>'.$nr_registru_comert.'</td><td>'.$sediul.'</td><td><a href="admin_receptii.php?id_furnizor='.$id_furnizor.'">Adauga</a></td></tr>';

      
    }
}
 
?>
<h1>Cauta client:</h1>
<form method="post" action="admin_adauga_furnizor.php">
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