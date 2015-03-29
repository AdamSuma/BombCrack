 <?php
session_start();

include('verificare_user.php');

$errorMsg = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Spatiile notate cu * sint obligatorii";
// First we check to see if the form has been submitted
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
	$parola_client = preg_replace("[^A-Za-z0-9]", "", $_POST['parola_client']); // filter everything but numbers and letters
    $ip=$_SERVER['REMOTE_ADDR'];
    // Check to see if the user filled all fields with
	// the "Required"(*) symbol next to them in the join form
	// and print out to them what they have forgotten to put in
	if((!$nume_client) || (!$nick_client) || (!$telefon) || (!$localitate_client) || (!$strada_client) || (!$email) || (!$nume_cumparator) ||(!$parola_client)){

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
	// Database duplicate Fields Check
	$sql_username_check = mysql_query("SELECT id_client FROM clienti WHERE nick_client='$nick_client' LIMIT 1");
	$sql_email_check = mysql_query("SELECT id_client FROM clienti WHERE email='$email' LIMIT 1");
	$username_check = mysql_num_rows($sql_username_check);
	$email_check = mysql_num_rows($sql_email_check);
	if ($username_check > 0){
		$errorMsg = "<u>Ne pare rau:</u><br />Numele exista deja in baza noastra de date.Va rugam incercati cu altul.";
	} else if ($email_check > 0){
		$errorMsg = "<u>Ne pare rau:</u><br />Adresa de email introdusa se afla deja in baza noastra de date.Incearca cu alta adresa.";
	} else {
		// Add MD5 Hash to the password variable
       $hashedPass = md5($parola_client);
		// Add user info into the database table, claim your fields then values
		$sql = mysql_query("INSERT INTO clienti (nume_client,nick_client,parola_client,nivel_client,email,nume_cumparator,nr_registru_comert,cod_fiscal,strada_client,judet_client ,localitate_client ,telefon,stare_cont_client, ip_client, data_logare_client)
		VALUES('$nume_client','$nick_client','$hashedPass','1','$email','$nume_cumparator','$nr_registru_comert','$cod_fiscal','$strada_client','$judet_client','$localitate_client','$telefon','','$ip', now())") or die (mysql_error());
		// Get the inserted ID here to use in the activation email
		$id_client = mysql_insert_id();
		// Start assembly of Email Member the activation link
		$to = "$email";
		// Change this to your site admin email
		$from = "pozecom@gmail.com";
		$subject = "Termina inregistrarea";
		//Begin HTML Email Message where you need to change the activation URL inside
		$message = '<html>
		<body bgcolor="#FFFFFF">
		Buna ' . $nume_client . ',
		<br /><br />
		Trebuie sa parcurgi acest pas penru a termina inregistrarea.
		<br /><br />
		Va rugam sa dati click aici &gt;&gt;
		<a href="http://localhost/activare.php?id_client=' . $id_client . '">
		Activeaza acum</a>
		<br /><br />
		Datele dumneavoastra de inregistrare:
		<br /><br />
	    Adresa de email: ' . $email . ' <br />
		Parola: ' . $parola_client . '
		<br /><br />
		Multumim!
		</body>
		</html>';
		// end of message
		$headers = "From: $from\r\n";
		$headers .= "Content-type: text/html\r\n";
		$to = "$to";
		// Finally send the activation email to the member

          mail($to, $subject, $message, $headers);
    		// Then print a message to the browser for the joiner
		print "<br /><br /><br /><h4>D-n(ule)(a) $nick_client, mai trebuie parcurs inca un pas pentru a va verifica identitatea:</h4><br />
		V-am trimis un link la adresa de email introdusa de dumneavoastra: $email<br /><br />
		<strong><font color=\"#990000\">Va rugam verificati in Inbox la adresa de mail de mai sus</font></strong> si dati click pe linkul de activare <br />
		Linkul se afla in mesajul primit. Dupa acest pas va puteti loga cu datele introduse de dumneavoastra.";
		exit(); // Exit so the form and page does not display, just this success message
	} // Close else after database duplicate field value checks
  } // Close else after missing vars check
} //Close if $_POST
include'barasus.php';
 ?>
 <title>Inregistrare clienti</title>
 <?php
 include'logomeniu.php';
 ?>
<div class="spatiustinga"></div>
<div class="spatiudreapta">
 <table width="600" align="center" cellpadding="5">
  <form action="inregistrare.php" method="post" enctype="multipart/form-data">
    <tr>
      <td colspan="2"><font color="#FF0000"><?php echo "$errorMsg"; ?></font></td>
    </tr>
    <tr>
      <td width="163"><div align="right">Nume si prenume:</div></td>
      <td width="409"><input name="nume_client" type="text" /><font size="-2" color="#006600">*(nume si prenume persoana de contact)</font>
      </td>
    </tr>
      <tr>
      <td><div align="right">Nick: </div></td>
      <td><input name="nick_client" type="text"/><font size="-2" color="#006600">*</font>
      </td>
    </tr>
     <tr>
      <td><div align="right">Email: </div></td>
      <td><input name="email" type="text"/><font size="-2" color="#006600">*</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Nume sau Firma: </div></td>
      <td><input name="nume_cumparator" type="text" /><font size="-2" color="#006600">*(nume si prenume sau denumire firma)</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Nr.Reg.Com. </div></td>
      <td>
        <input name="nr_registru_comert" type="text" /><font size="-2" color="#006600">(se complecteaza doar de persoane juridice)</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Cod fiscal sau CNP: </div></td>
      <td>
        <input name="cod_fiscal" type="text" /><font size="-2" color="#006600">(cod fiscal- persoana juridica sau CNP - persoana fizica)</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Strada: </div></td>
      <td>
        <input name="strada_client" type="text" /><font size="-2" color="#006600">*</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Localitate: </div></td>
      <td>
        <input name="localitate_client" type="text" /><font size="-2" color="#006600">*</font>
      </td>
    </tr>
      <tr>
      <td><div align="right">Judet: </div></td>
      <td>
        <input name="judet_client" type="text" /><font size="-2" color="#006600">*</font>
      </td>
    </tr>
    <tr>
      <td><div align="right">Telefon: </div></td>
      <td>
        <input name="telefon" type="text" /><font size="-2" color="#006600">*</font>
      </td>
    </tr>
    <tr>
      <td><div align="right"> Parola: </div></td>
      <td><input name="parola_client" type="password" /><font size="-2" color="#006600">*(doar litere si cifre)</font></td>
    </tr>
       <tr>
      <td><div align="right"></div></td>
      <td><input type="submit" name="Submit" value="Inregistrare" /></td>
    </tr>
  </form>
</table>

 </div>
<?php
include'barajos.php';
?>