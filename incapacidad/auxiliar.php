<html>

<head>
<title>Consulta de incapacidades</title>
 <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<?
    include("../conexion.php");
       $vari="select incapacidad.cedemple,incapacidad.codigo,control.concepto,incapacidad.motivo from incapacidad,control
           where incapacidad.codigo=control.codigo and
                 incapacidad.nroinca='$nro'";
         $result=mysql_query($vari)or die("Error el buscar diagnostico");
        $filas_s=mysql_fetch_array($result);
        ?>
        <form action="" method="post">
           <table border="0" align="center">
             <tr class="cajas">
                <td class="cajas"><b>Cedula:&nbsp;&nbsp;</b><?echo $filas_s["cedemple"];?></td> </tr><tr>
                <td class="cajas"><b>Asociado:&nbsp;</b><?echo $nombre;?>&nbsp;<?echo $nombre1;?>&nbsp;<?echo $apellido;?>&nbsp;<?echo $apellido1;?></td>
             </tr>
           </table>
           <tr><td><br></td></tr>
           <table border="0" align="center">
             <tr><td><br></td></tr>
             <tr>
                <td><b>Cód_Diag.:</b></td>
                <td><input type="text" value="<?echo $filas_s["codigo"];?>"size="12" class="cajas" readonly></td>
             </tr>
             <tr>
                <td><b>Diagnóstico:</b></td>
                 <td><textarea  cols="60" rows="3" class="cajas" readonly><?echo $filas_s["concepto"]?></textarea></td>
             </tr>
             <tr>
                <td><b>Motivo:</b></td>
                 <td><textarea  cols="60" rows="3" class="cajas" readonly><?echo $filas_s["motivo"]?></textarea></td>
             </tr>
              <tr><td><br></td></tr>
           </table>
           <?
           $variable="select seguimiento.conse,seguimiento.nota,seguimiento.fechap from incapacidad,seguimiento
           where incapacidad.nroinca=seguimiento.nroinca and
                 incapacidad.nroinca='$nro'";
           $res=mysql_query($variable)or die("Error el buscar seguimiento");
           $filas_s=mysql_fetch_array($result);
           ?>
           <table border="0" align="center">
              <tr>
               <th>Item</th>
               <th>Cod_Ingreso</th>
                <th>Seguimiento</th>
                <th>F_Visita</th>
              </tr>
              <?
              $a=1;
              while ($filas=mysql_fetch_array($res)):
                ?>
                 <tr class="cajas">
                   <th><?echo $a;?></th>
                   <td><?echo $filas["conse"];?></td>
                   <td><?echo $filas["nota"];?></td>
                  <td><?echo $filas["fechap"];?></td>
                 </tr>
                <?
                $a=$a+1;
               endwhile;
              ?>
           </table>
         </form>
      </body>
  </html>
