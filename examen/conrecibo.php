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
                      function chequearcampos()
                    {
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de Identidad ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        document.getElementById("matrec").submit();

                    }
              </script>
<?
if(!isset($cedula)):
?>
  <div align="center"><h5><u>Recibo de Control</u></h5></div>
  <form action="" method="post" id="matrec">
     <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr>
            <td><b>Documento de Identidad:&nbsp;</b></td>
            <td><input type="text" name="cedula" size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
        </tr>
       <tr><td><br></td></tr>
       <td colspan="3">
       <input type="button" value="Buscar" class="boton" onclick="chequearcampos()"></td>
     </table>
  </form>
<?
else:
   include("../conexion.php");
    $con1="select examenomina.nombre from examenomina where examenomina.cedula='$cedula'";
   $res1=mysql_query($con1)or die ("Error al buscar el empleado ?");
   $reg1=mysql_num_rows($res1);
   $filas_e=mysql_fetch_array($res1);
   $nombre=$filas_e["nombre"];
   if($reg1!=0):
       ?>
         <tr>
            <td class="cajas"><div align="center"><b>Empleado:</b>&nbsp;<?echo $filas_e["nombre"];?></div></td>
         </tr>
       <?
	   $con="select examenomina.* from examenomina
               where examenomina.cedula='$cedula'";
	   $res=mysql_query($con)or die ("Error al buscar el examen ?");
	   $reg=mysql_num_rows($res);
	   if($reg!=0):
	     ?>

             <div align="center"><h5><u>Listado de Recibos</u></h5></div>
              <table border="0" align="center">
	           <tr><td><br></td></tr>
	           <tr class="cajas">
		            <th>Nro_Pago</td>
		            <th>F_Pago</td>
		            <th>F_Proceso</td>
		            <th>Zona</td>
		            <th>Proveedor</td>
		            <th>Valor</td>
	           </tr>
	         <?
	         while($filas=mysql_fetch_array($res)):
	            ?>
	             <tr class="cajas">
	                <td><a href="imprimir.php?nropago=<?echo $filas["codpago"];?>"><?echo $filas["codpago"];?></a></td>
	                <td><?echo $filas["fechap"];?></td>
	                <td><?echo $filas["fechan"];?></td>
                        <td><?echo $filas["zona"];?></td>
	                <td><?echo $filas["provedor"];?></td>
	                <td><?echo $filas["valor"];?></td>
	             </tr>
	            <?
	         endwhile;
	         ?>
	        </table>
	       <?
           else:
              ?>
	      <script language="javascript">
	         alert("No hay recibos de control para este empleado?")
	         open("conrecibo.php","_self");
	      </script>
	      <?
           endif;
   else:
      ?>
      <script language="javascript">
         alert("Este documento no existe en sistema?")
         history.back()
      </script>
      <?
   endif;
endif;
?>
</body>
</html>
