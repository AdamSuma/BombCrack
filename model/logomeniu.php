<script src="jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="jqFancyTransitions.1.8.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="css.css" type="text/css" media="screen">

<script language="JavaScript">

function autoSubmit()
{
    var formObject = document.forms['theForm'];
    formObject.submit();
}

</script>
</head>

<body class="body">
<div class="pagina">
  <div class="barasus"><p>SC GRELUS ANDREI SRL STR.ANA IPATESCU NR.14 Tel.0356-469320&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $linksus;?></p></div> 
<div class="logo"></div>
  <div class="meniu"><ul id="menu"><li><a href="index.php">Home</a></li>
  <li><a href="desprenoi.php">Despre noi</a></li>
  <li><a href="produse.php">Produse</a></li>
  <li><a href="sugestii.php">Sugestii</a></li>
  <li><a href="cum_cumpar.php">Cum cumpar</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li style="margin-left:110px; padding-left:80px; background-image:url(poze/cos1.jpg); background-repeat:no-repeat;"><a href="cumpara.php">Cos de cumparaturi (<?php echo $_SESSION['nr_produse'] ?>)</a></li>
  </ul>
  </div>
<div class="continut">