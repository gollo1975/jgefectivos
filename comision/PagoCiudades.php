<html>

<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>

<?php
include("../conexion.php");
$ConC="select acceso.cedula from acceso
where acceso.usuario='$DatoUsuario'";
$ResuC=mysql_query($ConC)or die("Error al busca Usuarios");
$sw=mysql_num_rows($ResuC);
$filas=mysql_fetch_array($ResuC);
if($sw!=0):
       $Con="select carterazona.* from carterazona,vendedor
       where carterazona.cedulaven=vendedor.cedulaven and
       vendedor.cedulaven='$DatoUsuario' order by carterazona.fechap DESC";
       $Resu=mysql_query($Con)or die("Error al busca comisiones");
       $regi=mysql_num_rows($Resu);
       if($regi !=0):
          ?>
          <div align="center"><u><h4>Extractos</h4></u></div>
           <table border="0" align="center">
             <td class="letras">Presione click sobre el regitro de pago para ver el informe..</td>
           </table>

          <table border="0" align="center">
          <tr>
             <th>Item</th>
             <th>Nro_Pago</th>
			 <th>F_Proceso</th>
             <th>F_Inicio</th>
             <th>F_Corte</th>
             <th>Usuario</th>
           </tr>
          <?$t=1;
           while($filas_s=mysql_fetch_array($Resu)):
              ?>
               <tr class="cajas">
                  <th><?echo $t;?></th>
                  <td><a href="imprimircartera.php?DatoUsuario=<?echo $DatoUsuario;?>&NroPago=<?echo $filas_s["codigo"];?>"><?echo $filas_s["codigo"];?></a></td>
				  <td><?echo $filas_s["fechap"];?></td>
                 <td><?echo $filas_s["fechaini"];?></td>
                 <td><?echo $filas_s["fechacorte"];?></td>
                 <td><?echo $DatoUsuario;?></td>
               </tr>
              <?$t=$t+1;
           endwhile;
      else:
          ?>
	   <script language="javascript">
	      alert("No hay extractos de comisiones para este dato")
	      history.back()
	   </script>
           <?
       endif;
     ?>
     </table>
     <?
else:
   ?>
   <script language="javascript">
      alert("No hay usuarios registrados con este dato")
      history.back()
   </script>
   <?
endif;
?>

</body>

</html>
