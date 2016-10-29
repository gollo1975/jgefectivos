<?	include ("../conexion/conexion.php");

	if (isset($_GET['action']) ) $action = $_GET['action'];
?>
<html>
	<head>
		<title>Control de Ingresos :: JGEfectivo</title>
    	<link rel="stylesheet" type="text/css" href="../formatos/estilos.css" />
		<script type="text/javascript" src="../validar/validar.js"></script>
	</head>
<body>	
	<table width="250" border="0" cellspacing="0" cellpadding="0" class = "tablainterna">
		<tr>
			<td>
				<table width="250" border="0" align="center" cellpadding="0" cellspacing="0" class = "tablainterna">
				<? 
					$consulta = "select idMenu, nombreMenu from menu order by nombreMenu";
					$res = mysqli_query($cnn, $consulta); 
					if (!$res)  
		
						exit(mysqli_error()); 
					while ($row = mysqli_fetch_array($res)) {
					
				?>
					<tr>
						<td height="10" valign="top">
							<table width="250" border="0" cellspacing="5" cellpadding="0" class = "tablainterna">
								<tr>
									<td bgcolor="#F5F5F5"><a href="javascript:disp<? echo $row['idMenu']?>()"><? echo $row['nombreMenu']?></a></td>
								</tr>
							</table>
						</td>
					</tr>
					<script language="javascript">
						function disp<? echo $row['idMenu']?>()	{
						
							if(document.getElementById("disp<? echo $row['idMenu']?>").style.display == "none")
					
								document.getElementById("disp<? echo $row['idMenu']?>").style.display = "";
							else
					
								document.getElementById("disp<? echo $row['idMenu']?>").style.display = "none";
						}
					</script>
					<tr>
						<td valign="top">
							<div id="disp<? echo $row['idMenu']?>" style="display:none">
							<? 
								$usuario = $_SESSION ["usuario"];
								$consulta2 = "select submenu.idSubMenu, submenu.nombreSubMenu, submenu.url FROM menu inner join submenu on menu.idMenu = submenu.idMenu inner join permiso on submenu.idSubMenu = permiso.idSubmenu inner join accesonomina on permiso.usuario = accesonomina.usuario inner join rol on accesonomina.idRol = rol.idRol where submenu.idMenu='".$row['idMenu']."' and accesonomina.usuario = '$usuario' order by nombreSubMenu";
								$res2 = mysqli_query($cnn, $consulta2);
								if (!$res2)  
							
									exit(mysql_error()); 
									while ($row2 = mysqli_fetch_array($res2)) {	
							?>
									
										<table width="250" border="0" cellpadding="0" cellspacing="2" class = "tablainterna">
											<tr>
												<td><img src="../imagen/imagesCA0D8OMI.jpg"></td>
												<td> <a href="<? echo $row2['url']?>">  <? echo $row2['nombreSubMenu']?>
														</a>
												</td>
											</tr>
										</table>
							<?		}	?>
							</div> 
						</td>
					</tr>
				<?	}	?>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>