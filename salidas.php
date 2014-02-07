 <html>

<head><title>Entregas</title>
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
      
      
        <h1>Configuracion de Entregas</h1>
        <?php
        
       require_once('BIN/controler.php');
       
					$db= new dbManager();
					$db->configuracion("salidas.php");
			if(ISSET($_COOKIE["message"])){
				?> <h2><?php echo($_COOKIE["message"]); ?></h2> 
				<?php			
			}		

	///your code here 
	if(ISSET($_POST["idpet"])){
		$valida=true;
		$message="";
		if(!$db->valida($_POST["idart"],true)){
					$valida=false;
					$message="articulo incorrecto";				
				
				}
		if(!$db->valida($_POST["cant"],true)){
					$valida=false;
					$message="cantidad incorrecta";				
				
				}
		if(!$db->valida($_POST["idus"],true)){
					$valida=false;
					$message="usuario incorrecto";				
				
				}
				
	   if(!$db->valida($_POST["idusrecibe"],true)){
					$valida=false;
					$message="usuario incorrecto";				
				
				}
				
		if(!$db->valida($_POST["idpet"],true)){
					$valida=false;
					$message="peticion incorrecta";				
				
				}
	    if(!$db->valida($_POST["disponibles"],true)){
					$valida=false;
					$message="disponibles incorrecto";				
				
				}	
		if($valida==true){
				if(intval($_POST["cant"])>intval($_POST["disponibles"])){
				
					 $db->generaRequicision($_POST["idart"],$_POST["cant"],$_POST["idpet"],$_POST["idus"]);
					 ?> <h2>Se genero peticion de aprobacion Aprobacion </h2>  <?php
				}else{
					$db->generaSalida($_POST["idart"],$_POST["cant"],$_POST["idus"],$_POST["idusrecibe"],$_POST["idpet"]);
					//se generan las cookies para entregar los recibos
						if($_COOKIE["userrecibo"]==""){					
					
					setcookie("userrecibo",$_POST["idusrecibe"]);
					}else{
						//echo("hola");
						setcookie("userrecibo",$_COOKIE["userrecibo"].",".$_POST["idusrecibe"]);	
					}
					if($_COOKIE["cant"]==""){
					setcookie("cant",$_POST["cant"]);
					}else
					{
					//echo("hola2");
						setcookie("cant",$_COOKIE["cant"].",".$_POST["cant"]);					
					
					}
					if($_COOKIE["idart"]==""){
					setcookie("idart",$_POST["idart"]);
					}else
					{
					//echo("hola3");
						setcookie("idart",$_COOKIE["idart"].",".$_POST["idart"]);					
					
					}
					setcookie("message","Salida Generada Correctamente");
					header("location:salidas.php");
				
				
				}		
			
		}else{
			?> <h2><?php echo($message); ?></h2> <?php 
		}
		
	}
	if(ISSET($_POST["id_art"])){
	    if($_POST["id_art"]!="0"){
				$valida=true;
				$message="";
				if(!$db->valida($_POST["id_art"],true)){
					$valida=false;
					$message="articulo incorrecto";				
				
				}
				if(!$db->valida($_POST["cant"],true)){
					$valida=false;
					$message="cantidad incorrecta";				
				}
				if(!$db->haySuficientes($_POST["id_art"],$_POST["cant"])){
					$valida=false;
					$message="No hay suficientes articulos para Satisfacer la demanda";				
				
				}
				if($valida==true){
					$db->generaSalidasinPet($_POST["id_art"],$_POST["cant"],$_COOKIE["idUs"]);
					?><h2>Se reporto la salida correctamente</h2> <?php
				}else
				{
					?><h2><?php echo($message); ?></h2><?php 
				}							
			}	    
	}
	//---------------------------

      ?>
     
        <table class="tab" align="center" border="1" >
        
        <tr >
				<th style="color:black;" colspan="10" align="center" ><center>Generar Salida Sin Peticion</center></th>
			</tr>       
			<form action="salidas.php" method="post">
			<tr>
			<th>Nombre del Articulo</th>
			<th>Cantidad</th>	
			<th colspan="3" align="center"><center>Generar</center></th>		
			</tr>
			<tr>
			<td>
			<?php 
					
					$p= $db->getProductosL();
					$ids=explode(',', $p[0]);
					$np=explode(',', $p[1]);				
				?>
				<select name="id_art" class="stab" >
				<option value="0">Ninguno</option>
				<?php
				if($ids[0]!="")
				 for($i=0;$i<count($ids);$i++){
					?><option value="<?php echo($ids[$i]); ?>"><?php echo($np[$i]); ?></option> <?php				 
				 } 
				?>	
				</select>			
			</td>	
			<td><input type="text" name="cant" class="prec" id="cant"/></td>	
			<td colspan="3"><center><input type="submit" class="button" value="GENERAR"/></center></td>	
			</tr>
			</form>
			<tr >
				<th style="color:black;" colspan="10" align="center" ><center>Resumen de Peticiones</center></th>
			</tr>       
			
			<tr>
			<th>Articulo</th>
			<th>Cantidad</th>	
			<th>Disponibles</th>
			<th>Fecha</th>
			<th>Req. Ap.*</th>
			<th>Usuario</th>
			<th>Departamento</th>
			<th>Entregar</th>		
			</tr>
			<tr>
				<?php 
					$detp= $db->getDetallePeticiones();
					$idpet=explode(",",$detp[0]);
					$npet=explode(",",$detp[1]);
					$cantpet=explode(",",$detp[2]);
					$dispet=explode(",",$detp[3]);
               $fechapet=explode(",",$detp[4]);  
               $nuspet=explode(",",$detp[5]);
               $dept=explode(",",$detp[6]); 
               $idusrecibe=explode(",",$detp[7]);  
               $idarticulos=explode(",",$detp[8]); 
               for($i=0;$i<count($idpet);$i++){
						?>
						<form action="salidas.php" method="post" >
						<tr>
							<td><center><?php echo($npet[$i]); ?></center></td>		
							<td><center><input type="text" name="cant" class="prec"  value="<?php echo($cantpet[$i]); ?>" />	</center></td>	
							<td><center><?php echo($dispet[$i]); ?></center></td>	
							<td><center><?php echo($fechapet[$i]); ?></center></td>	
							<td><center><?php if(intval($dispet[$i])<intval($cantpet[$i])){echo("s");}else{echo("n");} ?></center></td>	
							<td><center><?php echo($nuspet[$i]); ?></center></td>	
							<td><center><?php echo($dept[$i]); ?></center></td>	
							<td><center>
							
							<input type="hidden" name="idart" value="<?php echo($idarticulos[$i]); ?>" />		
							
							<input type="hidden" name="idus" value="<?php echo($_COOKIE['idUs']); ?>" />	
							<input type="hidden" name="idusrecibe" value="<?php echo($idusrecibe[$i]); ?>" />	
							<input type="hidden" name="idpet" value="<?php echo($idpet[$i]); ?>" />	
							<input type="hidden" name="disponibles" value="<?php echo($dispet[$i]); ?>" />
							<input type="submit" class="button" value="ENTREGAR"/>			
							<input type="hidden" name="disponibles" value="<?php echo($dispet[$i]); ?>" />
							</center></td>	
							
						</tr>						
							</form>		
						<?php               
               
               }?>
</table>
<span style="font-size:0.6em;">*.- Requiere Aprobacion de a cuerdo a la candidad original la cual se puede modificar</span>
<span style="font-size:0.6em;">*.- Antes de hacer cualquier entrega debes tener habilitados los POP UPS para esta página</span>
<br/>
<?php
if(ISSET($_COOKIE["userrecibo"])){
?>
<a href="firma_salida.php" target="_blank" id="salida" onclick="document.getElementById('salida').style.display = 'none';">Generar Recibo</a>
<?php
}
?>
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