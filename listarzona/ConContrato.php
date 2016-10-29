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
   <div align="center"><h4><u>Contrato Empresariales</u></h4></div>
   <form action="" method="post" name="f1" id="MatId">
       <table border="0" align="center">
          <tr>
             <td><b>Digte el Dato:</b></td>
             <td><input type ="text" name="Dato" value="" size="30" maxlength="25" onfocus="ColorFoco(this.id)" class="cajas"onblur="QuitarFoco(this.id)" id="Dato"></td>
          </tr>
          <tr>
             <td><b>Tipo_Busqueda:</b></td>
             <td><input type="radio" value="Nit" checked name="Estado">Nit<input type="radio" value="Razon Social" name="Estado">Razón Social</td>
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
       $conC="select contratocomercial.* from contratocomercial where contratocomercial.nit='$Dato'";
       $resC=mysql_query($conC) or die("Error al buscar datos del contrato.");
       $regC=mysql_num_rows($resC);
       if ($regC!=0):
          ?>
          <div align="center"><h4><u>Contrato Empresariales</u></h4></div>
           <table border="0" align="center">
              <tr>
                 <th>Nro_Cont.</td>
                 <th>Nit</td>
                 <th>Empresa.</td>
				 <th>Representante_Legal.</td>
                 <th>F_Contrato</td>
                 <th>Estado</td>
              </tr>
              <?
              while($filas=mysql_fetch_array($resC)):
			    $Codigo=$filas["codmuni"];
                 ?>
                 <tr class="cajas">
				    <?if($Codigo==""){?>
                        <td><a href="../zona/ImprimeContrato.php?Nro=<?echo $filas["nroc"];?>"><?echo $filas["nroc"];?></a></td>
					<?}else{?>
						<td><a href="../zona/ReporteContratoComercial.php?Nro=<?echo $filas["nroc"];?>"><?echo $filas["nroc"];?></a></td>
					<?}?>	
                    <td><?echo $filas["nit"];?></td>
                    <td><?echo $filas["cliente"];?></td>
					<td><?echo $filas["representantelegal"];?></td>
                    <td><div align="center"><?echo $filas["fechap"];?></div></td>
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
                alert("No hay contratos de empresas usuarias mediante el Nit No :<?echo $Dato;?>.!")
                history.back()
            </script>
            <?
       endif;
   else:
       include('../conexion.php');
       $conC="select contratocomercial.* from contratocomercial where contratocomercial.cliente like '%$Dato%'";
       $resC=mysql_query($conC) or die("Error al buscar datos del contrato.");
       $regC=mysql_num_rows($resC);
       if ($regC!=0):
          ?>
          <div align="center"><h4><u>Contrato Empresariales</u></h4></div>
           <table border="0" align="center">
              <tr>
                 <th>Nro_Cont.</th>
                 <th>Nit</th>
                 <th>Empresa.</th>
				 <th>Representante_Legal.</th>
                 <th>F_Contrato</th>
                 <th>Estado</th>
              </tr>
              <?
              while($filas=mysql_fetch_array($resC)):
			 $Codigo=$filas["codmuni"];
			                 ?>
                 <tr class="cajas">
                    <?if($Codigo!= ''){?>
					    <td><a href="../zona/ReporteContratoComercial.php?Nro=<?echo $filas["nroc"];?>"><?echo $filas["nroc"];?></a></td>
                        
					<?}else{?>
						<td><a href="../zona/ImprimeContrato.php?Nro=<?echo $filas["nroc"];?>"><?echo $filas["nroc"];?></a></td>
					<?}?>	
                    <td><?echo $filas["nit"];?></td>
                    <td><?echo $filas["cliente"];?></td>
					<td><?echo $filas["representantelegal"];?></td>
                    <td><div align="center"><?echo $filas["fechap"];?></div></td>
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
                alert("No hay contratos de empresas usuarias mediante el Dato :<?echo $Dato;?>.!")
                history.back()
            </script>
            <?
       endif;     
   endif;
endif;

?>

</body>

</html>
