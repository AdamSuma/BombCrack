<?php
session_start();

include('verificare_user.php');
$mesaj_eroare="";
$continut="";
if (isset($_GET['id_produs'])){
   $id_produs=$_GET['id_produs'];
    } else{
   $id_produs=1;
 }
if (isset($_GET['actiune']))
$actiune=$_GET['actiune'];
	else
 $actiune="sterge";
 switch($actiune)
 {
 case "adauga":
 if(isset($_SESSION['cos'][$id_produs]))
     $_SESSION['cos'][$id_produs]++;
           else
      $_SESSION['cos'][$id_produs]=1;
       header("location:cumpara.php");
 break;
  case "scade":

  if((isset($_SESSION['cos'][$id_produs])&&($_SESSION['cos'][$id_produs])>1))
     $_SESSION['cos'][$id_produs]--;
     header("location:cumpara.php");
  break;
   case "modifica":
  
  if (isset($_POST["bucati"])) 
  $bucati=$_POST["bucati"];
  if($bucati<1){
$bucati=1;
} 
  $_SESSION['cos'][$id_produs]=$bucati; 
      break;
	  
   case "sterge":
   unset($_SESSION['cos'][$id_produs]);
    break;

 }


 if(isset($_SESSION['cos']))
 {
   $numar_produse=count($_SESSION['cos']);
   $_SESSION['nr_produse']=$numar_produse;
   include 'conectare.php';
   $pret_total=0;
   $pret_total_fara_tva=0;
   $cos='';
    $cos.='<br/><h1 align="center"><img src="poze/cos.png" border="0" alt="" />&nbsp;&nbsp;&nbsp;<font size=5 face="Lucida Handwriting">Cos de Cumparaturi</font></h1>

	<font size="2"><table border="1" cellspacing="0" cellpadding="4" width="100%"><tr bgcolor="#B8CAE2">
	       
			<td align="center"><b>-</b></td>
			<td align="center"><b>Buc</b></td>
			<td align="center"><b>+</b></td>
			<td align="center"><b>Poza</b></td>
			<td align="center"><b>Cod</b></td>
			<td align="center"><b>Produs</b></td>
			<td align="center"><b>Pret FTVA</b></td>
			<td align="center"><b>Pret cu TVA</b></td>
			<td align="center"><b>Total FTVA</b></td>
			<td align="center"><b>Total cu TVA</b></td>
			<td align="center"><b>Sterge</b></td>
			
			
			</tr>';
if ((isset($_POST["cumparaturi"]))&&(isset($_SESSION['id_client']))){

$data=date("Ymd");
$sql_comanda="insert into comanda(id_client,data_comanda,total_comanda,stare_comanda) values ('".$_SESSION['id_client']."','$data','".$_SESSION['total']."','nepreluata')";
mysql_query($sql_comanda)or die(mysql_error());
$id_comanda=mysql_insert_id();
}else if((isset($_POST["cumparaturi"]))&&(!isset($_SESSION['id_client']))){

$mesaj_eroare.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:red"><b>Pentru a comanda trebuie sa fiti logat</b></span>';

}
  
  foreach($_SESSION['cos']as $id_produs =>$x)
{
$intrebare=mysql_query("SELECT * FROM produse WHERE id_produs=$id_produs");
$rand=mysql_fetch_array($intrebare);
      $denumire_produs=$rand['denumire_produs'];
      $pret=$rand['pret_produs'];
	  $pret_fara_tva=$pret/1.24;
	  $pret_fara_tva=round($pret_fara_tva,2);
      $linie_produs=$pret*$x;
	  $linie_produs_fara_tva=$linie_produs/1.24;
	  $linie_produs_fara_tva=round($linie_produs_fara_tva,2);	  
      $pret_total=$pret_total+$linie_produs;
	  $pret_total_fara_tva=$pret_total/1.24;
	  $pret_total_fara_tva=round($pret_total_fara_tva,2);
      $_SESSION['total']=$pret_total;
      $_SESSION['id_produs']=$rand['id_produs'];
	  $adresa_imagine="poze/poze_produse/".$rand['id_produs'].".jpg";
				if(file_exists($adresa_imagine))
					{
						$imagine='<img src="'.$adresa_imagine.'" width="60" height="50">';
					}
					else
						{
							$imagine= '<div style="width:60px; height:50px; border:1px black  solid; background-color:#cccccc;">Fara Imagine</div>';
						}
						
      if ((isset($_POST["cumparaturi"]))&&(isset($_SESSION['id_client']))){
$sql_vanzari=mysql_query("insert into vanzari(id_comanda,id_produs,bucati) values('".$id_comanda."' ,'".$_SESSION['id_produs']."','".$x."')");
$numar_randuri=mysql_affected_rows();
if($numar_produse=$numar_randuri){
unset($_SESSION['cos'][$id_produs]);
$_SESSION['total']=0;
header('location:confirmare_primire_comanda.php');
}
$mesaj_eroare.='Va multumim,comanda dumneavoastra a fost primita.';
}

   $cos.='<tr><form action="cumpara.php?id_produs='.$id_produs.'&actiune=modifica" name="form" method="POST">
   
   
   
   <td>
						<a href="cumpara.php?id_produs='.$id_produs.'&actiune=scade" style=color:#000000;text-decoration:none font-family:"Times New Roman" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true">-</a>
							</td>
							<td align="center">
							    
								<input type="text" name="bucati" size="1" maxlength="3" value="'.$x.'"/>
								<input type="submit" value="&#10003;"/>
								
							</td>
							</form>
							<td align="center">
						<a href="cumpara.php?id_produs='.$id_produs.'&actiune=adauga" style=color:#000000;text-decoration:none font-family:"Times New Roman" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true">+</a>
							</td>
							<td align="center">'.$imagine.'</td>
							<td align="center">'.$id_produs.'</td>
							<td>
								<b>'.$denumire_produs.'</b>
							</td>
							<td align="center">
								'.$pret_fara_tva.' lei
							</td>
							<td align="center">
								'.$pret.' lei
							</td>
							<td align="center">
								<b>'.$linie_produs_fara_tva.' lei</b>
							</td>
							<td align="center">
								<b>'.$linie_produs.' lei</b>
							</td>
							<td align="center" ><a href="cumpara.php?id_produs='.$id_produs.'&actiune=sterge" style=color:#ff0000;text-decoration:none font-family:"Times New Roman" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true">x</a>
							</td>
						</tr>';  
}
  $cos.='<tr>
					<td colspan="7" align="right"><b align="center">Total in Cos</b></td>
					<td><b>Total fara TVA</b></td>
					<td align="center">
							<span style="color:red" ><b>'.$pret_total_fara_tva.' lei</b></span>
					</td>
					<td><b>Total cu TVA</b></td>
					<td align="center">
						<span style="color:red" ><b>'.$pret_total.' lei</b></span>
					</td>
				</tr></table></font><br/><table width=100%><tr><td align="right">
                <form action="cumpara.php" method="post" name="cumparaturi" value="true">
 <input type="hidden" name="cumparaturi" >
 <a href="produse.php"><img src="poze/cautare.gif" border="0" alt="" />&nbsp;Inapoi la produse</a>
 <input type="submit" value="comanda"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 </form></td></tr></table><br/></br>';


 if ($pret_total==0){
  $cos='</br><h3 align="center">Cosul de cumparaturi este gol</h3></br></br>
 <a href="produse.php"><img src="poze/cautare.gif" border="0" alt="" />&nbsp;Inapoi la lista produse</a></br></br>';
 }
 }else{

 $cos='</br><h3 align="center">Cosul de cumparaturi este gol</h3></br></br>
 <a href="produse.php"><img src="poze/cautare.gif" border="0" alt="" />&nbsp;Inapoi la lista produse</a></br></br>';

 }
 if(!isset($_SESSION['id_client'])){
 
 $continut.='<h3>Pentru a putea trimite comanda trebuie sa fiti logat!</h3></br>
 Pentru a va loga click &nbsp;<a href="logare_user.php">aici</a></br>
 Daca nu aveti cont va puteti inregistrati &nbsp;<a href="inregistrare.php">aici</a>';
 }else if(isset($_SESSION['id_client'])){
 
 $continut.='Pentru a va modifica datele de facturare click &nbsp;<a href="client.php?id_client=' . $userid . '">aici</a>';
 }
 include'barasus.php';
 ?>
 <title>Cos de cumparaturi</title>
 <?php

include'logomeniu.php';
?>
<div class="pasi_cumparaturi"></div>
<div class="cos_cumparaturi">
<?php
  echo $cos;
  echo $mesaj_eroare;
  echo $continut;
?>
</div>
<?php
include'barajos.php';
?>

