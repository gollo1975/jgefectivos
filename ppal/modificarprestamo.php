<html>
<head>
  <title>Editar Datos</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
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
                            alert ("Digite el documento de identidad del empleado");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matP").submit();

                    }
                </script>
</head>
<body>
<?
if (!isset($cedula)):
 ?>
 <center><h4><u>Editar Prestamo</u></h4></center>
  <form action="" method="post" id="matP">
    <table border="0" align="center">
     <tr><td><br></td></tr>
       <tr>
         <td><b>Documento de Identidad:</b></td>
         <td><input type="text" name="cedula" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspna="3">
         <input type="button" value="Buscar Dato" class="boton" Onclick="chequearcampos()"></td>
       </tr>
    </table>
  </form>
<?
else:
   include("../conexion.php");
   $consZ="select prestamoempresa.codzona from prestamoempresa
         where prestamoempresa.cedemple='$cedula' and
         prestamoempresa.codzona='$codigo'";
   $resuZ=mysql_query($consZ)or die ("Error al procesar la consulta");
   $regZ=mysql_num_rows($resuZ);
   if($regZ!=0):
	   $cons="select prestamoempresa.* from prestamoempresa
	         where prestamoempresa.cedemple='$cedula'";
	   $resu=mysql_query($cons)or die ("Error al buscar informacion del prestamo");
	   $reg=mysql_num_rows($resu);
	   if($reg!=0):
	     ?>
	          <center><h4><u>Autorización Prestamo</u></h4></center>
	           <table border="0" align="center">
	           <input type="hidden" name="codigo" value="<? echo $codigo;?>">
	             <tr><td><br></td></tr>
	             <tr>
	              <th>Item</th>
	                <th>Nro_Prestamo</th>
	                <th>Vlr_Prestamo</th>
	                 <th>Cuota</th>
	                  <th>Forma_Pago</th>
	                <th>F_Proceso</th>
	                <th>Estado</th>
	             </tr><?$a=1;
	              while($filas=mysql_fetch_array($resu)):
	                   $valor=number_format($filas["vlrprestamo"],0);
	                   $cuota=number_format($filas["cuota"],0);
	                   ?>
	                   <tr class="cajas">
	                      <th><?echo $a;?></th>
	                      <td><a href="detalleprestamo.php?nroprestamo=<?echo $filas["nroprestamo"];?>&codigo=<?echo $codigo;?>"><?echo $filas["nroprestamo"];?></a></td>
	                      <td><?echo $valor;?></td>
	                      <td><?echo $cuota;?></td>
	                      <td><?echo $filas["formapago"];?></td>
	                      <td><?echo $filas["fechap"];?></td>
	                      <td><?echo $filas["estado"];?></td>

	                   </tr>
	               <?
	               $a=$a+1;
	               $suma=$suma+$filas["vlrprestamo"];
	             endwhile;
	           ?>
	           </table>
	         <?

	   else:
	     ?>
	     <script language="javascript">
	      alert("Este Documento no existe o no esta autorizado para crear este registro ?..")
	     open("modificarprestamo.php?codigo=<?echo $codigo;?>","_self")
	     </script>
	     <?
	   endif;
    else:
        ?>
	     <script language="javascript">
	      alert("Este documento no pertenece a esta empresa. Información Errada ?..")
	     history.back()
	     </script>
	     <?
    endif;
endif;
 ?>
</body>
</html>
