<?php
session_start();

include('verificare_user.php');
$mesaj='';
if (isset($_POST["email"])){


$email = stripslashes($_POST["email"]);
$email = strip_tags($email);
$email = mysql_real_escape_string($email);
include'conectare.php';

$intrebare_email=mysql_query("SELECT * FROM clienti WHERE email='$email' LIMIT 1");
$randuri_email=mysql_num_rows($intrebare_email);
if($randuri_email==1){
         while($rand=mysql_fetch_array($intrebare_email)){

    	$id_client=$rand["id_client"];
        $stare_cont_client=$rand["stare_cont_client"];
        $email=$rand["email"];
        $parola_clara=$rand["parola_clara"];
		$nume_client=$rand["nume_client"];
				        }
		$catre = "$email";
		// Change this to your site admin email
		$de_la = "pozecom@gmail.com";
		$subject = "Recuperare parola";
		//Begin HTML Email Message where you need to change the activation URL inside
		$message = '<html>
		<body bgcolor="#FFFFFF">
		Buna ' . $nume_client . ',
		<br /><br />
		Acesta este un mail pentru recuperarea parolei de acces pe site-ul nostru.
		<br /><br />
		Datele dumneavoastra de inregistrare sint:
		<br /><br />
	    Adresa de email: ' . $email . ' <br />
		Parola: ' . $parola_clara . '
		<br /><br />
		Va asteptam!
		<br /><br />
		Daca nu a-ti cerut dumneavoastra aceste date va rugam sa ne contactati.
		<br /><br />
		Va multumim!
		</body>
		</html>';
		// end of message
		$headers = "From: $de_la\r\n";
		$headers .= "Content-type: text/html\r\n";
		$catre= "$catre";
		// Finally send the activation email to the member
          mail($catre, $subject, $message, $headers);
    		// Then print a message to the browser for the joiner
		$mesaj.='Datele dumneavoastra v-au fost trimise pe email.Va asteptam!';
		
        }else{
		$mesaj.='Adresa de email introdusa nu a fost gasita in baza noastra de date!';
		}
		
        }
$cat_noua='';
 $cos='';
  if (!isset($_SESSION['total'])){
    $_SESSION['total']=0;
  }
  if (!isset($_SESSION['nr_produse'])){
    $_SESSION['nr_produse']=0;
  }
  if (($_SESSION['nr_produse']==0)||($_SESSION['total']==0)){
     $cos.='Nu aveti produse in cosul de cumparaturi';
  }else if($_SESSION['nr_produse']==1){
   $cos.='Aveti  '.$_SESSION['nr_produse'].' produs.<br/><br/>

   In valoare de  <b>'.$_SESSION['total'].'</b>&nbsp;Lei';

  }else if($_SESSION['nr_produse']>1){
   $cos.='Aveti  '.$_SESSION['nr_produse'].' produse.<br/><br/>

   In valoare de  <b>'.$_SESSION['total'].'</b>&nbsp;Lei';

  }
 $afisare_cele_mai_cautate='';
 include('conectare.php');
$cele_mai_cautate=mysql_query("SELECT * FROM produse ORDER BY vizualizari_produs DESC LIMIT 5");
while($rand_cele_mai_cautate=mysql_fetch_array($cele_mai_cautate)){

$denumire_cautat=$rand_cele_mai_cautate['denumire_produs'];
$id_produs_cautat=$rand_cele_mai_cautate['id_produs'];
$afisare_cele_mai_cautate.='<a href="produs.php?id_produs='. $id_produs_cautat .'"> '.$denumire_cautat.'</a><br/>';

}
$intrebare_categorie=mysql_query("SELECT * FROM categorii");
while($rand_categorie=mysql_fetch_array($intrebare_categorie)){
$id_categorie=$rand_categorie['id_categorie'];
$dotare_categorie=$rand_categorie['categorie'];
$cat_noua.='<li><a href="produse.php?cat='.$id_categorie.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="poze/sageata2.png" style="border: none;">&nbsp;&nbsp;'.$dotare_categorie.'</a></li>';
}
include'barasus.php';

?>
<title>Recuperare parola</title>
<?php
include'logomeniu.php';
?>
<div class="cutie_stinga">
<div class="cos">
<img src="poze/cos_imagine.jpg" />
<br /><br />
<h1><?php echo $cos ?></h1></div>

<div class="meniu_categorii">
<img src="poze/categorii.jpg" />
<ul class="meniu_vertical">
<?php echo $cat_noua;?>
</ul>
</div>
</div>
 <div class="cutie_mijloc">
  <br />
 <h3 align="center">Va rugam introduceti adresa de email</h3>
 <br />
<table align="center" cellpadding="5">
      <form action="recuperare_parola.php" method="post" enctype="multipart/form-data" name="recuperare_parola">
        <tr>
          <td class="style7"><div align="right">Email:</div></td>
          <td><input name="email" type="text" id="email" size="22" maxlength="64" /></td>
        </tr>
                <tr>
          <td>&nbsp;</td>
          <td align="center"><input name="Submit" type="submit" value="Recuperare" /></td>
        </tr>
		        <tr><td align="right"><a href="inregistrare.php">Nu am cont</a></td><td align="center"><a href="logare_user.php">Logare</a></td></tr>
      </form>
    </table>
    <br />
	     
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $mesaj;?>
        
    <br />
    <br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript: history.back(-1)">&laquo; Inapoi</a>
    </div>
      <div class="cutie_dreapta">
   <div class="anunt">
   <br />
   <br /> <br />Nu gasesti piesa dorita?</br>Contacteaza-ne si i-ti vom raspunde in cel mai scurt timp.<br /><br /><b align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tel.0356-416132</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sau<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Tel.0770-128204</b><br/> <br />   </div>


  <div class="cele_mai_cautate"><br/><br/><br/>
  <?php echo $afisare_cele_mai_cautate;?>

   <br/>

  </div>

  <div class="newsletter"><br/><br/><br />
    Inscrie-te la newsletter pentru a primii informatii despre produsele noi.
  <form action="cum_cumpar.php" method="post" name="newsletter">
  Email:<br/><input type="text" name="email"></br>
  <input type="submit" value="Inscrie-ma">
  </form>
  </div>
  </div>
<?php
include'barajos.php';
?>