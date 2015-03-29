<?php
session_start();
include('verificare_user.php');
if ((isset($_POST["email"]))&& isset($_POST["parola"])){


$email = stripslashes($_POST["email"]);
$email = strip_tags($email);
$email = mysql_real_escape_string($email);
$parola=preg_replace('#[^A-Za-z0-9]#i','',md5($_POST["parola"]));

include'conectare.php';

$intrebare_user1=mysql_query("SELECT * FROM clienti WHERE email='$email' AND parola_client='$parola' AND stare_cont_client='acceptat' LIMIT 1");
$randuri_user1=mysql_num_rows($intrebare_user1);
if($randuri_user1==1){
     $ultima_logare=mysql_query("UPDATE clienti SET ultima_logare=now() WHERE email='$email' AND parola_client='$parola'AND stare_cont_client='acceptat' LIMIT 1");
    while($rand=mysql_fetch_array($intrebare_user1)){

    	$id_client=$rand["id_client"];
        $username=$rand["nick_client"];
        $stare_cont_client=$rand["stare_cont_client"];
        $email=$rand["email"];
        $nivel_client=$rand["nivel_client"];
        $stare_cont_client=$rand["stare_cont_client"];
        $parola_client=$rand["parola_client"];
		$mesagerie=$rand["mesagerie"];
        }
        $_SESSION["id_client"]=$id_client;
        $_SESSION["nick_client"]=$username;
        $_SESSION["email"]=$email;
        $_SESSION["nivel_client"]=$nivel_client;
        $_SESSION["parola_client"]=$parola_client;
		$_SESSION["mesagerie"]=$mesagerie;
        header("location:index.php");
        exit();
        }else{
        header("location:date_logare_user_eronate.php");
        exit();
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
$cele_mai_cautate=mysql_query("SELECT * FROM produse WHERE stare_produs NOT LIKE 'ascuns' ORDER BY vizualizari_produs DESC LIMIT 5");
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
<title>Logare clienti</title>
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
 <h3 align="center">Va rugam introduceti adresa de email si parola</h3>
 <br />
<table align="center" cellpadding="5">
      <form action="logare_user.php" method="post" enctype="multipart/form-data" name="logform" id="logform" onsubmit="return validate_form ( );">
        <tr>
          <td class="style7"><div align="right">Email:</div></td>
          <td><input name="email" type="text" id="email" size="22" maxlength="64" /></td>
        </tr>
        <tr>
          <td class="style7"><div align="right">Parola:</div></td>
          <td><input name="parola" type="password" id="parola" size="24" maxlength="24" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center"><input name="Submit" type="submit" value="Logare" /></td>
        </tr>
        <tr><td align="right"><a href="inregistrare.php">Nu am cont</a></td><td align="center"><a href="recuperare_parola.php">Am uitat parola</a></td></tr>
      </form>
    </table>
    <br />
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