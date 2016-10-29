<html>

<head>
  <title>Consulta de Contratos</title>
  <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
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
                        if (document.getElementById("Dato").value.length <=0)
                        {
                            alert ("Favor digite el dato a consultar.!");
                            document.getElementById("Dato").focus();
                            return;
                        }
                         document.getElementById("MatId").submit();

                    }
                </script>
</head>
<body>
<?php
if(!isset($Dato)):
   ?>
   <div align="center"><h4><u>Cotizaciones Comerciales</u></h4></div>
   <form action="" method="post" name="f1" id="MatId">
       <table border="0" align="center">
	   <tr><td><br></td></tr>
          <tr>
             <td><b>Digite el Dato:</b></td>
             <td><input type ="text" name="Dato" value="" size="30" maxlength="25" onfocus="ColorFoco(this.id)" class="cajas"onblur="QuitarFoco(this.id)" id="Dato"></td>
          </tr>
          <tr>
             <td><b>Tipo_Busqueda:</b></td>
             <td><input type="radio" value="Razon Social" checked name="Estado">Razón Social<input type="radio" value="Nit"  name="Estado">Nit</td>
          </tr>
           <tr><td><br></td></tr>
          <tr>
             <td colspan="2"><input type="button" Value="Buscar" class="boton" onclick="chequearcampos()"></td>
          </tr>
       </table>
   </form>
   <?
else:
   if($Estado=='Nit'):
       include('../conexion.php');
       $conC="select cotizacioncomercial.* from cotizacioncomercial where cotizacioncomercial.nitempresa='$Dato'";
       $resC=mysql_query($conC) or die("Error al buscar datos del contrato.");
       $regC=mysql_num_rows($resC);
       if ($regC!=0):
          ?>
          <div align="center"><h4><u>Cotizaciones Comerciales</u></h4></div>
           <table border="0" align="center">
              <tr>
			     <th>#</th> 
                 <th>Nro_Contizacion</td>
				 <th>Nit/Cedula</td>
                 <th>Empresa</td>
                 <th>Dirigida</td>
                 <th>F_Cotización</td>
              </tr>
              <? $a=1;
              while($filas=mysql_fetch_array($resC)):
                 ?>
                 <tr class="cajas">
				     <th><?echo $a;?></th>
                    <td><a href="../cartalaboral/ReporteCotizacion.php?NroC=<?echo $filas["idcotizacion"];?>"><?echo $filas["idcotizacion"];?></a></td>
					<td><?echo $filas["nitempresa"];?></td>
                    <td><?echo $filas["razonsocial"];?></td>
                    <td><?echo $filas["dirigida"];?></td>
                    <td><div align="center"><?echo $filas["fechaproceso"];?></div></td>
                 </tr>
                 <? $a += 1;
              endwhile;
              ?>
           </table>
          <?
       else:
            ?>
            <script language="javascript">
                alert("No hay cotizaciones generadas para este cliente.!")
                history.back()
            </script>
            <?
       endif;
   else:
       include('../conexion.php');
       $conC="select cotizacioncomercial.* from cotizacioncomercial where cotizacioncomercial.razonsocial like '%$Dato%'";
       $resC=mysql_query($conC) or die("Error al buscar datos del contrato.");
       $regC=mysql_num_rows($resC);
       if ($regC!=0):
          ?>
          <div align="center"><h4><u>Contrato Empresariales</u></h4></div>
           <table border="0" align="center">
             <tr>
			     <th>#</td> 
                 <th>Nro_Contizacion</td>
				 <th>Nit/Cedula</td>
                 <th>Empresa</td>
                 <th>Dirigida</td>
                 <th>F_Cotización</td>
              </tr>
              <?
			  $a=1;
              while($filas=mysql_fetch_array($resC)):
                ?>
                 <tr class="cajas">
				 <th><?echo $a;?></th>
                    <td><a href="../cartalaboral/ReporteCotizacion.php?NroC=<?echo $filas["idcotizacion"];?>"><?echo $filas["idcotizacion"];?></a></td>
                    <td><?echo $filas["nitempresa"];?></td>
					<td><?echo $filas["razonsocial"];?></td>
                    <td><?echo $filas["dirigida"];?></td>
                    <td><div align="center"><?echo $filas["fechaproceso"];?></div></td>
                 </tr>
                 <? $a += 1;
              endwhile;
              ?>
           </table>
          <?
       else:
            ?>
            <script language="javascript">
                alert("No hay cotizaciones generadas para este cliente.!")
                history.back()
            </script>
            <?
       endif;     
   endif;
endif;

?>

</body>

</html>
