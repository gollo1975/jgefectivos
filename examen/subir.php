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
  <div align="center"><h5><u>Recibo de Control[Nómina]</u></h5></div>
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
    $con1="select concat(nomemple,' ',nomemple1,' ',apemple,' ',apemple1) as nombre from empleado where empleado.cedemple='$cedula'";
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
	   $con="select examen.*,zona.zona,provedor.nomprove from zona,provedor,examen
               where zona.codzona=examen.codzona and
               provedor.nitprove=examen.nitprove and
               examen.cedula='$cedula'";
	   $res=mysql_query($con)or die ("Error al buscar el examen ?");
	   $reg=mysql_num_rows($res);
	   if($reg!=0):
	     ?>

             <div align="center"><h5><u>Listado de Examenes</u></h5></div>
              <table border="0" align="center">
	           <tr><td><br></td></tr>
	           <tr class="cajas">
		            <th>Conse.</td>
		            <th>F_Examen</td>
		            <th>F_Proceso</td>
		            <th>Nro_Control</td>
	                    <th>Zona</td>
		            <th>Proveedor</td>
		            <th>Estado</td>
	           </tr>
	         <?
	         while($filas=mysql_fetch_array($res)):
	            ?>
	             <tr class="cajas">
	                <td><a href="auxiliarnomina.php?nro=<?echo $filas["nro"];?>&zona=<?echo $filas["zona"];?>&cedula=<?echo $cedula;?>&nombre=<?echo $nombre;?>&provedor=<?echo $filas["nomprove"];?>"><u><div align="center"><?echo $filas["nro"];?></div></u></a></td>
	                <td><?echo $filas["fechae"];?></td>
	                <td><?echo $filas["fechap"];?></td>
	                <td><?echo $filas["radicado"];?></td>
	                <td><?echo $filas["zona"];?></td>
	                <td><?echo $filas["nomprove"];?></td>
	                <td><?echo $filas["estado"];?></td>
	             </tr>
	            <?
	         endwhile;
	         ?>
	        </table>
	       <?
           else:
              ?>
	      <script language="javascript">
	         alert("No hay Examenes para descargar en sistema ?")
	         open("subir.php","_self");
	      </script>
	      <?
           endif;
   else:
      ?>
      <script language="javascript">
         alert("Este empleado no esta en sistema ?")
         open("subir.php","_self");
      </script>
      <?
   endif;
endif;
?>
</body>
</html>
