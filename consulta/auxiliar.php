<?
 session_start();
?>
<html>
<head>
<title> Datos del Empleado</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>

<?
 if(session_is_registered("xsession")):
     include("../conexion.php");
     $consulta="select empleado.*,zona.zona,municipio.municipio 'ciudad' from empleado,zona,municipio where
               zona.codzona=empleado.codzona and
               empleado.codmuni=municipio.codmuni and
               empleado.cedemple='$cedemple'";
     $resultado=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resultado);
     if($registros==0):
     ?>
      <script language="javascript">
          alert("El Documento no existe en la base de datos:")
          history.back()
        </script>
<?
    else:
      while($filas=mysql_fetch_array($resultado)):
?>
      <center><h4><u>Registro Empleado</u></h4></center>
       <form action="" method="post">
        <table border="0" align="center">
         <tr class="fondo">
           <td colspan="2"><br></td>
         </tr>
          <tr>
            <td><b>Cod_Empleado:</b></td>
            <td><input type="text" name="codemple" value="<?echo $filas["codemple"];?>"readonly size="15"class="cajas"></td>
            </tr>
             <tr>
                   <td><b>Cédula:</b></td>
                   <td><input type="text"  value="<?echo $filas["cedemple"];?>" readonly
                      size="15" class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Nombre 1:</b></td>
                   <td><input type="text"  value="<?echo $filas["nomemple"];?>" readonly
                      size="45" class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Nombre 2:</b></td>
                   <td><input type="text" value="<?echo $filas["nomemple1"];?>" readonly
                      size="45" class="cajas"></td>
                 </tr>
                 <td><b>Apellido 1:</b></td>
                   <td><input type="text" value="<?echo $filas["apemple"];?>" readonly
                      size="45" class="cajas"></td>
                 </tr>
                 <td><b>Apellido 2:</b></td>
                   <td><input type="text"  value="<?echo $filas["apemple1"];?>" readonly size="45" class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Dirección:</b></td>
                   <td><input type="text"  value="<?echo $filas["diremple"];?>" readonly
                      size="45" class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Teléfono:</b></td>
                   <td><input type="text"  value="<?echo $filas["telemple"];?>" readonly
                      size="15"  class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Municipio:</b></td>
                   <td><input type="text"  value="<?echo $filas["ciudad"];?>"readonly
                      size="45" class="cajas"></td>
                 </tr>
                 <tr>
                   <td><b>Barrio:</b></td>
                   <td><input type="text"  value="<?echo $filas["municipio"];?>"readonly
                      size="45" class="cajas"></td>
                 </tr>
				 <tr>
                 <td><b>Sexo:</b></td>
                   <td><input type="text" name="sexo" value="<?echo $filas["sexo"];?>" readonly
                      size="15"  class="cajas"></td>
                 </tr>
				 <tr>
                  <td><b>Rh:</b></td>
                   <td><input type="text" name="sexo" value="<?echo $filas["rh"];?>" readonly
                      size="15"  class="cajas"></td>
                 </tr>
				 <tr>
                  <td><b>Fecha_Nac.:</b></td>
                   <td><input type="text" name="sexo" value="<?echo $filas["fechanac"];?>" readonly
                      size="15"  class="cajas"></td>
                 </tr>
                 <td><b>Estado_Civil:</b></td>
                   <td><input type="text"  value="<?echo $filas["estcivil"];?>" readonly
                      size="15" class="cajas"></td>
                 </tr>
                 <td><b>Cuenta:</b></td>
                   <td><input type="text"  value="<?echo $filas["cuenta"];?>" readonly
                      size="15"  class="cajas"></td>
                 </tr>
                 <td><b>Celular:</b></td>
                   <td><input type="text"  value="<?echo $filas["celular"];?>" readonly
                      size="15" class="cajas"></td>
                 </tr>
                 <td><b>Zona:</b></td>
                   <td><input type="text"  value="<?echo $filas["zona"];?>" readonly
                      size="45"  class="cajas"></td>
                 </tr>
                  <td><b>Email:</b></td>
                   <td><input type="text"  value="<?echo $filas["email"];?>" size="45" readonly
                      class="cajas"></td>
                 </tr>
                 <td><b>Nivel_Arp:</b></td>
                   <td><input type="text"  value="<?echo $filas["nivel"];?>" readonly
                      size="15"  class="cajas"></td>
                 </tr>
                  <td><b>%Eps:</b></td>
                   <td><input type="text"  value="<?echo $filas["eps"];?>"  readonly
                      size="15"  class="cajas"></td>
                 </tr>
                  <td><b>%Pensión:</b></td>
                   <td><input type="text"  value="<?echo $filas["pension"];?>" readonly
                      size="15"  class="cajas"></td>
                 </tr>

 <?
     endwhile;
   endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;   

 ?>
 </table>

 </form>
</body>
</html>
