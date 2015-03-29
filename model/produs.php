 <?php
session_start();

include('verificare_user.php');

$id_produs=$_GET['id_produs'];
	include_once "conectare.php";
$cautare=mysql_query("SELECT * FROM produse WHERE id_produs='$id_produs' LIMIT 1");
$randuri_cautare=mysql_num_rows($cautare);
if($randuri_cautare==1){
    while($row=mysql_fetch_array($cautare)){
   $id_produs=$row['id_produs'];
   $denumire_produs =$row['denumire_produs'];
   $pret_produs=$row['pret_produs'];
   $stoc_produs=$row['stoc_produs'];
   $descriere_produs=$row['descriere_produs'];
   $producator=$row['producator'];
   $poza=$row['poza'];
   $vizualizari=$row['vizualizari_produs'];
   $adresa_imagine="poze/poze_produse/".$row['id_produs'].".jpg";
				if(file_exists($adresa_imagine))
					{
						$imagine='<img src="'.$adresa_imagine.'" width="200" height="150">';
					}
					else
						{
							$imagine= '<div style="width:200px; height:150px; border:1px black  solid; background-color:#cccccc;">Fara Imagine</div>';
						}
   $produs='<div style="produs"><table border="1" width=100% cellspacing=5 cellpadding=2><tr><td rowspan=3 width="150">'.$imagine.'</td><tr><td align="center" width="580">Produs:<a href="comanda.php?id_produs=' . $id_produs . '">Comanda</a></td></tr><tr><td align="center" width="580" height="20">'.$denumire_produs.'</td></tr><tr></tr><td align="center"><b>Cod produs:</b></td><td align="left">'.$id_produs.'</td><tr><td align="center"><b>Pret:</b></td><td align="left">'.$pret_produs.'</td></tr><tr><td align="center"><b>Stoc:</b></td><td align="left" width="" height="20">'.$stoc_produs.'</td></tr><tr><td align="center"><b>Producator:</b></td><td align="left" width="" height="20">'.$producator.'</td></tr><tr><td align="center"><b>Pretabil pentru masina:</b></td><td align="left" width="" height="20"></td></tr><tr><td height="60" align="center"><b>Specificatii:</b></td><td align="left">'.$descriere_produs.'</td></tr><tr><td><b>Alte produse din aceeasi categorie:<b></td><td>.</td></tr></table></div>';
   }
  }
  $_cautat=substr($denumire_produs,0,4);  
$cautare_potriviri=mysql_query("SELECT * FROM produse WHERE denumire_produs LIKE '%".$_cautat."%' AND id_produs!=$id_produs LIMIT 3");  
$randuri_potriviri=mysql_num_rows($cautare_potriviri);
if($randuri_potriviri>1){
   $produs_cautat=''; 
    while($row1=mysql_fetch_array($cautare_potriviri)){
   $id_produsc=$row1['id_produs'];
   $denumire_produsc =$row1['denumire_produs'];
   $pret_produs_cautat=$row1['pret_produs'];
   $adresa_imagine1="poze/poze_produse/".$row1['id_produs'].".jpg";
				if(file_exists($adresa_imagine1))
					{
						$imagine1='<img src="'.$adresa_imagine1.'" width="80" height="60">';
					}
					else
						{
							$imagine1= '<div style="width:80px; height:60px;>Fara Imagine</div>';
						}
   $produs_cautat.='<h1><br/>'.$imagine1.'<a href="produs.php?id_produs='. $id_produsc .'"><h5>'.$denumire_produsc.'</a></h5><h4>'.$pret_produs_cautat.'&nbsp;lei</h4><hr align="center" width="50%" size="1" color="#DDDDDD" noshade></h1>';
  }
}
 $produs='<div style="produs"><table border="0" width=100% cellspacing=2 cellpadding=0><tr><td rowspan=3 width="150">'.$imagine.'<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='.$adresa_imagine.'><span>Mareste imaginea</span></a></td><tr><td align="center" width="580" height="20"><a href="cumpara.php?id_produs=' . $id_produs . '&actiune=adauga"><img src="poze/adaugaincos.png"></a><hr align="center" width="50%" size="1" color="#DDDDDD" noshade><b>Produs:</b></td></tr><tr><td align="center" width="580" height="20"><h6>'.$denumire_produs.'</h6><br/>Vizualizari:<b>'.$vizualizari.'</b></td></tr><th align="center"><hr align="center" width="100%" size="1" color="#DDDDDD" noshade>Cod produs:</th><td align="left"><hr align="center" width="0px" size="1" color="#DDDDDD" noshade>'.$id_produs.'</td><tr><td align="center"><hr align="center" width="100%" size="1" color="#DDDDDD" noshade><b>Pret:</b></td><td align="left"><hr align="center" width="0px" size="1" color="#DDDDDD" noshade>'.$pret_produs.'&nbsp;lei</td></tr><tr><td align="center"><hr align="center" width="100%" size="1" color="#DDDDDD" noshade><b>Stoc:</b></td><td align="left" width="" height="20"><hr align="center" width="0px" size="1" color="#DDDDDD" noshade>'.$stoc_produs.'</td></tr><tr><td align="center"><hr align="center" width="100%" size="1" color="#DDDDDD" noshade><b>Producator:</b></td><td align="left" width="" height="20"><hr align="center" width="0px" size="1" color="#DDDDDD" noshade>'.$producator.'</td></tr><tr><td align="center"><hr align="center" width="100%" size="1" color="#DDDDDD" noshade><b>Pretabil pentru masina:</b></td><td align="left" width="" height="20"></td></tr><tr><td height="60" align="center"><hr align="center" width="100%" size="1" color="#DDDDDD" noshade><b>Specificatii:</b></td><td align="left"><hr align="center" width="0px" size="1" color="#DDDDDD" noshade>'.$descriere_produs.'</td></tr><tr><td align="center" colspan=2><hr align="center" width="100%" size="1" color="#DDDDDD" noshade><b>Alte produse asemanatoare:</b></br></br>'.$produs_cautat.'</td></tr></table></div>';
$vizualizare=$vizualizari+1;
$adauga_vizualizare=mysql_query("UPDATE produse SET vizualizari_produs=$vizualizare WHERE id_produs='$id_produs'");
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
 include'barasus.php';
?>
<title><?php echo $denumire_produs;?> </title>
 <?php

include'logomeniu.php';
?>
<div class="cutie_stinga">
 <div class="cos">
<img src="poze/cos_imagine.jpg" />
<br /><br />
<?php echo $cos ?></div>


</div>
<div class="cutie_mijloc_mare">
<br />
 <?php echo $produs;?>
  </div>


<?php
include'barajos.php';
?>