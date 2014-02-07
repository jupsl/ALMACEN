<html>

<head>
<title>LOG IN</title>
<link href='IMAGES/LOGO.png' rel='shortcut icon' type='image/png'>

	<LINK REL="stylesheet" HREF="CSS/stylem.css" TYPE="text/css">
	<meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>

</head>
<body>



<!---------------------------------->
<div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.html">Control<span class="logo_colour">_Almacen</span></a></h1>
          <h2>Comite Directivo Estatal PRI Chih.</h2>
        </div>
      </div>
      <?php require_once("menu.php");?>
    </header>
    <div id="site_content">
      <div id="sidebar_container">
        <div class="gallery">
          <ul class="images">
            <li class="show"><img width="450" height="450" src="images/1.jpg" alt="photo_one" /></li>
            <li><img width="450" height="450" src="images/2.jpg" alt="photo_two" /></li>
            <li><img width="450" height="450" src="images/3.jpg" alt="photo_three" /></li>
            <li><img width="450" height="450" src="images/4.jpg" alt="photo_four" /></li>
            <li><img width="450" height="450" src="images/5.jpg" alt="photo_five" /></li>
          </ul>
        </div>
      </div>
      <div id="content">
        <h1>LogIn</h1>
        <p>
     
        <?php



	//require_once('menu.php');

	
   //echo($_SERVER['HTTP_USER_AGENT']);
  include_once("BIN/controler.php");
  if(ISSET($_POST['cs'])){
  			setcookie("useralmacen", "");
     		setcookie("nivel", "");
     		setcookie('idUs' ,"");
     		setcookie('page' ,"");
     		setcookie('message' ,"");
     		header('Location: LogIn.php');
  	}
 if(ISSET($_POST['us'])){
 		if($_POST['us']!="" && $_POST['pw']!=""){
     	$db= new dbManager();
     	$values= $db->autenticar($_POST['us'],$_POST['pw']);
     	if($values[0]!=""){
     		setcookie("useralmacen", $values[1]);
     		setcookie("nivel", $values[0]);
     		setcookie('idUs' ,$values[2]);
     		header('Location: LogIn.php');
     		}else {
     			
     			?>
     			
     			<div align="center" class="tituloerror">Fallo de Autenticar</div>
     			
     			<?php
     			}
     			}
 	}
?>
        	 <?php
					if(!ISSET($_COOKIE["useralmacen"])){
	
				?>
				<div class="cuerpo">
<form action="LogIn.php"  method="post" >
<table class="logintable" align="center" border="1"   >
<tr>
<td><div class="titulologin">USUARIO</div></th><th><input type="text" name="us" class="uslogin"/></td>

</tr>
<tr>
<td><div class="titulologin">PASSWORD</div></th><th><input type="password" name="pw" class="pwlogin"/></td>
</tr>
<tr>
<td  align="center"><center><img src="images/LOGO.png" alt="" width="50 height="50" class="imagelogin"></center></td>
<td align="center" >
<center><input type="submit" value="ENTRAR" class="button"/></center>
</td>
</tr>

</table>
</form>
</div>
<?php
}else {

	
	?>
	
	<div class="cuerpo">
	<form action="LogIn.php"  method="post" >
	<table class="logintable" align="center" border="1">
	<tr><td><div class="titulologin">BIENVENIDO&nbsp;<?php echo($_COOKIE["useralmacen"]); ?>  </div></td></tr>
	<tr><td align="center"><center><input type="submit" value="Cerrar Session" name="cs" class="button"/></center></td></tr>
	</table>
	
	</form>
	</div>
	<?php
	if(ISSET($_COOKIE['page'])){
			header('Location: '.$_COOKIE['page']);
			setcookie("page", "");	
		}
	 //echo($_COOKIE['nivel']);
	}
	
?>

        </p>
                
      </div>
    </div>
    <footer>
      <p>&copy; 2013 Secretaria de Analisis de la Informacion, Evaluacion y Seguimiento | <a href="http://www.prichihuahua.org.mx">Comite Directivo Estatal Chih.</a></p>
    </footer>
  </div>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/image_fade.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    });
  </script>
<!---------------------------------->

</body>
</html>