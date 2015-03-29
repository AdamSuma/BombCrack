 <?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';




$randuri='';
 if ((isset($_POST["criteriu"]))&&(strlen($_POST["criteriu"])>0)){
 include('conectare.php');
 $criteriu=$_POST["criteriu"];
 $intrebare = mysql_query("SELECT * FROM clienti WHERE nume_cumparator LIKE '%".$criteriu."%'");
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
$id_client=$row['id_client'];
$nume_cumparator=$row['nume_cumparator'];
$cod_fiscal=$row['cod_fiscal'];
$nr_registru_comert=$row['nr_registru_comert'];
$strada_client=$row['strada_client'];
  
$randuri.='<tr><td>'.$nume_cumparator.'</td><td>'.$cod_fiscal.'</td><td>buc</td><td>'.$nr_registru_comert.'</td><td>'.$strada_client.'</td><td><a href="admin_facturi.php?id_client='.$id_client.'">Adauga</a></td></tr>';

      
    }
}
 
?>
<h1>Cauta client:</h1>
<form method="post" action="admin_adauga_client.php">
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