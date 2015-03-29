 <?php
session_start();

include('verificare_user.php');


if((isset($_SESSION['id_client']))&&(isset($_SESSION['email']))&&(isset($_SESSION['parola_client']))){
$id_client=$_SESSION['id_client'];
$parola_client=$_SESSION['parola_client'];
$email=$_SESSION['email'];
	include_once "conectare.php";
$verificare=mysql_query("SELECT * FROM clienti WHERE id_client='$id_client'LIMIT 1");
$randuri_verificare=mysql_num_rows($verificare);
if($randuri_verificare==1){
    while($rand=mysql_fetch_array($verificare)){
        $verifica_id_client=$rand["id_client"];
        $verifica_parola_client=$rand['parola_client'];
       	$verifica_email=$rand["email"];
   }
if(($id_client==$verifica_id_client)&&($parola_client==$verifica_parola_client)&&($email==$verifica_email)){


$intrebare_user=mysql_query("SELECT * FROM clienti WHERE id_client='$id_client'LIMIT 1");
$randuri_user=mysql_num_rows($intrebare_user);
if($randuri_user==1){
    while($rand=mysql_fetch_array($intrebare_user)){

		$nume_client=$rand['nume_client'];
        $nick_client=$rand["nick_client"];
        $nume_cumparator=$rand["nume_cumparator"];
		$nr_registru_comert=$rand["nr_registru_comert"];
		$cod_fiscal=$rand["cod_fiscal"];
		$strada_client=$rand["strada_client"];
		$judet_client=$rand["judet_client"];
		$localitate_client=$rand["localitate_client"];
		$email=$rand["email"];
		$telefon=$rand["telefon"];

	$errorMsg = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Spatiile notate cu * sint obligatorii";
}
}
}else{
  echo " Nu ai ce cauta aici! ";
  exit();
   }
 }
 }else{
 echo "Nu ai ce cauta aici!" ;
 exit();
 }
 if (isset($_POST['nume_client'])){
	//Connect to the database through our include
	include_once "conectare.php";
	// Filter the posted variables
	$nume_client = preg_replace("[^A-Za-z0-9]", "", $_POST['nume_client']); // filter everything but numbers and letters
	$nick_client = preg_replace("[^A-Z a-z0-9]", "", $_POST['nick_client']);
    $nume_cumparator = preg_replace("[^A-Z a-z0-9]", "", $_POST['nume_cumparator']);
    $nr_registru_comert = preg_replace("[^A-Z a-z0-9]", "", $_POST['nr_registru_comert']);
    $cod_fiscal = preg_replace("[^A-Z a-z0-9]", "", $_POST['cod_fiscal']);
    $strada_client = preg_replace("[^A-Z a-z0-9]", "", $_POST['strada_client']); // filter everything but spaces, numbers, and letters
	$judet_client = preg_replace("[^A-Z a-z0-9]", "", $_POST['judet_client']); // filter everything but spaces, numbers, and letters
	$localitate_client = preg_replace("[^A-Z a-z0-9]", "", $_POST['localitate_client']); // filter everything but spaces, numbers, and letters
	$telefon = preg_replace("[^0-9]", "", $_POST['telefon']); // filter everything but lowercase letters
	$email = stripslashes($_POST['email']);
	$email = strip_tags($email);
	$email = mysql_real_escape_string($email);
	$ip=$_SERVER['REMOTE_ADDR'];

    // Check to see if the user filled all fields with
	// the "Required"(*) symbol next to them in the join form
	// and print out to them what they have forgotten to put in
	if((!$nume_client) || (!$nick_client) || (!$telefon) || (!$localitate_client) || (!$strada_client) || (!$email) || (!$nume_cumparator)){

		$errorMsg = "Nu ai introdus corect urmatorul camp!<br /><br />";
		if(!$nume_client){
			$errorMsg .= "Nume";
		} else if(!$nick_client){
			$errorMsg .= "Nick";
		} else if(!$nume_cumparator){
			$errorMsg .= "Nume sau Firma";
		} else if(!$telefon){
		    $errorMsg .= "Telefon";
	   } else if(!$localitate_client){
	       $errorMsg .= "Localitate";
	   } else if(!$strada_client){
	       $errorMsg .= "Strada";
	   } else if(!$email){
	       $errorMsg .= "Adresa Email";
	   } else if(!$parola_client){
	       $errorMsg .= "Parola";
	   }
	} else {
 $sql = mysql_query("UPDATE clienti SET nume_client='$nume_client',nick_client='$nick_client',email='$email',nume_cumparator='$nume_cumparator',nr_registru_comert='$nr_registru_comert',cod_fiscal='$cod_fiscal',strada_client='$strada_client',judet_client='$judet_client' ,localitate_client='$localitate_client' ,telefon='$telefon' WHERE id_client='$id_client'LIMIT 1")or die (mysql_error());
 $verificare_modificari=mysql_affected_rows();
 if ($verificare_modificari=1){
  $errorMsg = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ai modificat cu succes!<br /><br />";
 }else if($verificare_modificari=0){
  $errorMsg = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date introduse nu s-au modificat<br /><br />";
 }
 }
 }
$cere_mesaje=mysql_query("SELECT * FROM mesaje WHERE id_client='$userid' and stare_mesaj='necitit' order by id_mesaj DESC LIMIT 15");
$mesaje_necitite=mysql_num_rows($cere_mesaje);

 include'barasus.php';
 ?>
 <title>Modificare date</title>
 <?php

include'logomeniu.php';
?>
<div class="spatiu_meniu_client"><br/></br></br></br></br>
<ul class="meniu_vertical">
<li><a href="schimba_par.php?id=<?php echo $userid;?>"><img src="poze/lacat.jpg" border="0" alt="" />&nbsp;Schimba parola</a></li>
<li><a href="client.php?id=<?php echo $userid;?>"><img src="poze/document.gif" border="0" alt="" />&nbsp;Modifica date de facturare</a></li>
<li><a href="comenzi_client.php?id=<?php echo $userid;?>"><img src="poze/cos.gif" border="0" alt="" />&nbsp;Comenzi trimise</a></li>
<li><a href="tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Trimite mesaj catre suport</a></li>
<li><a href="raspuns_tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Mesaje(<?php echo $mesaje_necitite;?>)</a></li>
 </ul>
</div>
<div class="spatiudreapta_mic">
</br></br>
 <table width="600" align="center" cellpadding="5">
  <form action="client.php" method="post" enctype="multipart/form-data">
    <tr>
      <td colspan="2"><font color="#FF0000"><?php echo "$errorMsg"; ?></font></td>
    </tr>
    <tr>
      <td width="163"><div align="right">Nume si prenume:</div></td>
      <td width="409"><input name="nume_client" type="text" value='<?php echo "$nume_client";?>'/><font size="-2" color="#006600">*(nume si prenume persoana de contact)</font>
      </td>
    </tr>
      <tr>
      <td><div align="right">Nick: </div></td>
      <td><input name="nick_client" type="text" value='<?php echo "$nick_client";?>'/><font size="-2" color="#006600">*</font>
      </td>
    </tr>
     <tr>
      <td><div align="right">Email: </div></td>
      <td><input name="email" type="text" value='<?php echo "$email";?>'/><font size="-2" color="#006600">*</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Nume sau Firma: </div></td>
      <td><input name="nume_cumparator" type="text" value='<?php echo "$nume_cumparator";?>'/><font size="-2" color="#006600">*(nume si prenume sau denumire firma)</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Nr.Reg.Com. </div></td>
      <td>
        <input name="nr_registru_comert" type="text" value='<?php echo "$nr_registru_comert";?>'/><font size="-2" color="#006600">(se complecteaza doar de persoane juridice)</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Cod fiscal sau CNP: </div></td>
      <td>
        <input name="cod_fiscal" type="text" value='<?php echo "$cod_fiscal";?>'/><font size="-2" color="#006600">(cod fiscal- persoana juridica sau CNP - persoana fizica)</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Strada: </div></td>
      <td>
        <input name="strada_client" type="text" value='<?php echo "$strada_client";?>'/><font size="-2" color="#006600">*</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Localitate: </div></td>
      <td>
        <input name="localitate_client" type="text" value='<?php echo "$localitate_client";?>'/><font size="-2" color="#006600">*</font>
      </td>
    </tr>
      <tr>
      <td><div align="right">Judet: </div></td>
      <td>
        <input name="judet_client" type="text" value='<?php echo "$judet_client";?>'/><font size="-2" color="#006600">*</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Telefon: </div></td>
      <td>
        <input name="telefon" type="text" value='<?php echo "$telefon";?>'/><font size="-2" color="#006600">*</font>
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
include'barajos.php';
?>