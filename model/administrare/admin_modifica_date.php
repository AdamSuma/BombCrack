
<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';

$mesaj='';

$intrebare_firma=mysql_query("SELECT * FROM date_firma");
while($randuri_firma=mysql_fetch_array($intrebare_firma)){

$nume_firma=$randuri_firma['nume_firma'];
$nr_registru_comert=$randuri_firma['nr_reg_comert'];
$cod_fiscal=$randuri_firma['cod_fiscal'];
$sediul=$randuri_firma['sediul'];
$judetul=$randuri_firma['judetul'];
$contul=$randuri_firma['contul'];
$banca=$randuri_firma['banca'];
$capital_social=$randuri_firma['capital_social'];
}
if(isset($_POST['nume_firma'])){
$nume_firma=$_POST['nume_firma'];
$nr_registru_comert=$_POST['nr_registru_comert'];
$cod_fiscal=$_POST['cod_fiscal'];
$sediul=$_POST['sediul'];
$judetul=$_POST['judetul'];
$contul=$_POST['contul'];
$banca=$_POST['banca'];
$capital_social=$_POST['capital_social'];
$modifica_date_firma=mysql_query("UPDATE date_firma SET nume_firma='$nume_firma',cod_fiscal='$cod_fiscal',nr_reg_comert='$nr_registru_comert',sediul='$sediul',judetul='$judetul',contul='$contul',banca='$banca',capital_social='$capital_social' WHERE id_date_firma='1'");
$verificare_modificari=mysql_affected_rows();
if ($verificare_modificari=1){
$mesaj.='A-ti modificat datele cu succes';
}else if($verificare_modificari=0){
$mesaj.='Datele nu au fost modificate!';
}
}






?>


<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;ACTIUNI</h3>
</br>
<ul class="meniu_vertical">
<li><a href="admin_modifica_date.php"><img src="../poze/document.gif" border="0" alt="" />Modifica date de facturare</a></li>


</ul>


</div>
<div class="spatiudreapta_comenzi"></br></br></br>
<table width="600" align="center" cellpadding="5">
  <form action="admin_modifica_date.php" method="post" enctype="multipart/form-data">
    <tr>
      <td colspan="2"><font color="#FF0000"><?php echo "$mesaj"; ?></font></td>
    </tr>
    <tr>
      <td width="163"><div align="right">Nume firma:</div></td>
      <td width="409"><input name="nume_firma" type="text" size="50" value='<?php echo "$nume_firma";?>'/>
      </td>
    </tr>
        </tr>
    <tr>
      <td><div align="right">Nr.Reg.Com. </div></td>
      <td>
        <input name="nr_registru_comert" type="text" size="50" value='<?php echo "$nr_registru_comert";?>'/>
      </td>
    </tr>
    <tr>
      <td><div align="right">Cod fiscal: </div></td>
      <td>
        <input name="cod_fiscal" type="text" size="50" value='<?php echo "$cod_fiscal";?>'/>
      </td>
    </tr>
    <tr>
      <td><div align="right">Sediul: </div></td>
      <td>
        <input name="sediul" type="text" size="50" value='<?php echo "$sediul";?>'/>
      </td>
    </tr>
          <tr>
      <td><div align="right">Judet: </div></td>
      <td>
        <input name="judetul" type="text" size="50" value='<?php echo "$judetul";?>'/>
      </td>
    </tr>
	<tr>
      <td><div align="right">Contul: </div></td>
      <td>
        <input name="contul" type="text" size="50" value='<?php echo "$contul";?>'/>
      </td>
    </tr>
	<tr>
      <td><div align="right">Banca: </div></td>
      <td>
        <input name="banca" type="text" size="50" value='<?php echo "$banca";?>'/>
      </td>
    </tr>
	<tr>
      <td><div align="right">Capital social: </div></td>
      <td>
        <input name="capital_social" type="text" size="50" value='<?php echo "$capital_social";?>'/>
      </td>
    </tr>
        <tr>
      <td><div align="right"></div></td>
      <td><input type="submit" name="Submit" value="Modifica" /></td>
    </tr>
  </form>
</table>
			

</div>





<?php
include'admin_barajos.php';
?>