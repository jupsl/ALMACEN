<html>

<head><title>Proveedores</title>
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

<?php

//Code Here

	
?>
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
      
      
        <h1>Administracion de Proveedores</h1>
        <?php
       require_once('BIN/controler.php');
       
					$db= new dbManager();
					$db->configuracion("proveedores.php");
		if(ISSET($_POST["idelimina"])){
			$db->borraProveedor($_POST["idelimina"]);
			?><h2>Borrado Correctamente</h2><?php
		}
		if(ISSET($_POST["idmodifica"])){
					if($_POST["txtnombre"]!=""){
			         
			         	
			         	$_POST["txtnombre"]=strtoupper($_POST["txtnombre"]);
			         	$_POST["txtdescripcion"]=strtoupper($_POST["txtdescripcion"]);
			         	$_POST["txtdireccion"]=strtoupper($_POST["txtdireccion"]);
			         	$valida=true;
			         	$message="";
			         	if(!$db->valida($_POST["txtnombre"],false)){
			         		$valida=false;
			         		$message="Nombre no válido";
			         		}
			         	if(!$db->valida($_POST["txtdescripcion"],false)){
			         		$valida=false;
			         		$message="Descripcion no válida";
			         		}
			         	if(!$db->valida($_POST["txtdireccion"],false)){
			         	
			         		$valida=false;
			         		$message="Direccion no valida";
			         		}
			         	
			        if($valida==true) 	
			        $db->editarProveedor($_POST["txtnombre"],$_POST["txtdescripcion"],$_POST["txtdireccion"],$_POST["idmodifica"]);
			        
        				else{
        				?><h2><?php echo($message); ?></h2> <?php
        				}
					
					}


			}
		
      if(ISSET($_POST["noma"])){
      
      	if($_POST["noma"]!=""){
      		
      			
      			
      	$_POST["noma"]=strtoupper($_POST["noma"]);
      	$_POST["desa"]=strtoupper($_POST["desa"]);
      	$_POST["dira"]=strtoupper($_POST["dira"]);
      	$valida=true;
      	$message="";
      	
      	if(!$db->valida($_POST["noma"],false)){
			         		$valida=false;
			         		$message="nombre no valido";
			         		}
			 if(!$db->valida($_POST["desa"],false)){
			         		$valida=false;
			         		$message="Descripcion no valida";
			         		}
			 if(!$db->valida($_POST["dia"],false)){
			         		$valida=false;
			         		$message="Direccion no Válida";
			         		}
			
      	if($valida==true){
      		$db->agregaProveedor($_POST["noma"],$_POST["desa"],$_POST["dira"]);
      		?>
      		<h2>Producto Agregado Correctamente</h2> 
      		<?php
      		}else{
      		?>
      		<h2><?php echo($message); ?></h2> 
      		<?php
      		}
      	}else{
      	
      		?>
      		<h2>Faltan algunos datos por llenar</h2>
      		<?php
      	}
      
      }
      ?>
        <form action="proveedores.php" method="post">
        <table class="tab" align="center" border="1" >
			<tr >
				<th style="color:black;" colspan="10" align="center" ><center>Agregar Proveedor</center></th>
			
			<tr>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th>Direccion</th>	
			<th colspan="2">Agregar</th>		
			</tr>
			<tr>
				
				<td><input type="text" name="noma" /></td>
				<td><input type="text" name="desa" /></td>
				<td><input type="text" name="dira" /></td>
				
				<td colspan="2"><center><input class="button" type="submit" value="AGREGAR" /></center></td>				
			</tr>
        
     </form>
     
<tr >
				<th style="color:black;" colspan="10" align="center" ><center>Proveedores Existentes</center></th>
			</tr>       
			
			<tr>
			<th>Nombre</th>
			<th>Descripcion</th>
			<th>Direccion</th>	
			<th>Editar</th>	
			<th>Borrar</th>	
			</tr>
			<tr>
			<?php
			$prov= $db->getProovedoresEn();
			$idprov=explode(",",$prov[0]);
			$names=explode(",",$prov[1]);
			$desc=explode(",",$prov[2]);
			$dir=explode(",",$prov[3]);
			if($idprov[0]!=""){
				for($i=0;$i<count($idprov);$i++){
				if(!ISSET($_POST["idprov"])){				
				?>
				<form action="proveedores.php" method="post">				
				<tr>
				<td><input type="hidden" name="idprov" value="<?php echo($idprov[$i]);?>"/><?php  echo($names[$i]); ?></td>
				<td><?php echo($desc[$i]); ?></td>	
				<td><?php echo($dir[$i]); ?></td>
				<td ><center><input type="submit" class="button" value="EDITAR"/></center></td></form>		
				<td><form action="proveedores.php" method="post"><center><input type="hidden" name="idelimina" value="<?php echo($idprov[$i]);?>"/><input type="submit" class="button" value="ELIMINAR"/></center></form></td>	
				</tr>
				
				<?php		
				}else{
							if($_POST["idprov"]==$idprov[$i]){
						
				?>
							<form action="proveedores.php" method="post">				
				<tr>
				<td><input type="hidden" name="idmodifica" value="<?php echo($idprov[$i]);?>"/><input type="text" name="txtnombre" value="<?php  echo($names[$i]); ?>"/></td>
				<td><input type="text" name="txtdescripcion" value="<?php echo($desc[$i]); ?>"/></td>	
				<td><input type="text" name="txtdireccion" value="<?php echo($dir[$i]); ?>"/></td>
				
				<td ><center><input type="submit" class="button" value="GUARDAR"/></center></td></form>
				<td><form action="proveedores.php" method="post"><center><input type="submit" class="button" value="CANCELAR"/></center></form></td>	
				
				</tr>
								
								
				
					<?php
										
							
							}else{
							?>
				<form action="proveedores.php" method="post">				
				<tr>
				<td><input type="hidden" name="idart" value="<?php echo($idprov[$i]);?>"/><?php  echo($names[$i]); ?></td></form>
				<td><?php echo($desc[$i]); ?></td>	
				<td><?php echo($dir[$i]); ?></td>
				<td><input type="submit" class="button" value="EDITAR"/></td>	
				<td><form action="proveedores.php" method="post"><center><input type="hidden" name="idelimina" value="<?php echo($idprov[$i]);?>"/><input type="submit" class="button" value="ELIMINAR"/></center></form></td>		
				</tr>
				
				<?php	
							}
					}		
				
				}
			}
			?>
</table>
    <footer>
      <p>&copy; 2013 Secretaria de Analisis de la Informacion, Evaluacion y Seguimiento  | <a href="http://www.prichihuahua.org.mx">Comite Directivo Estatal Chih.</a></p>
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



</div>

</body>
</html>