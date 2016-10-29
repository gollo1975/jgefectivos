<html>

<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<body>
<script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
              </script>
<?
include("../conexion.php");
$con="select examen.* from examen where examen.estado='ACTIVO' and examen.nro='$nro'";
$res=mysql_query($con) or die("Error al buscar examenes");
$reg=mysql_num_rows($res);
if($reg!=0):
   while($filas=mysql_fetch_array($res)):
      ?>
      <div align="center"><u><h5>Datos del Examen</h5></u></div>
      <form action="grabarnomina.php" method="post">
         <table border="0" align="center">
            <tr><td><br></td></tr>
              <tr>
	         <td><b>Consecutivo:</b></td>
	         <td><input type="text" name="conse" value="<?echo $nro;?>"size="10" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="conse"></td>
	      </tr>
               <tr>
	         <td><b>Documento:</b></td>
	         <td><input type="text" name="cedula" value="<?echo $cedula;?>"size="15" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
	      </tr>
              <tr>
	         <td><b>Empleado:</b></td>
	         <td><input type="text" name="nombre" value="<?echo $nombre;?>"size="45" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
	      </tr>
              <tr>
	         <td><b>Zona:</b></td>
	         <td><input type="text" name="zona" value="<?echo $zona;?>"size="45" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona"></td>
	      </tr>
              <tr>
	         <td><b>Proveedor:</b></td>
	         <td><input type="text" name="provedor" value="<?echo $provedor;?>"size="45" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="provedor"></td>
	      </tr>
              <tr>
	         <td><b>Radicado:</b></td>
	         <td><input type="text" name="radicado" value="<?echo $filas["radicado"];?>"size="10" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="radicado"></td>
	      </tr>
              <tr>
	         <td><b>F_Nomina:</b></td>
	         <td><input type="text" name="fechan" value="<?echo date("Y-m-d");?>"size="10" maxlength="10"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechan"></td>
	      </tr>
            <tr><td><br></td></tr>
             <td colspan="3">
             <input type="submit" value="Descargar" class="boton"></td>
         </table>
      </form>
      <?
   endwhile;
else:
   ?>
      <script language="javascript">
        alert("Este Examen ya esta cancelado ?")
        history.back()
      </script>
    <?
endif;

?>
</body>
</html>
