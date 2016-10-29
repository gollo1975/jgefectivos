<html>

<head>
  <title>Descargar Incapacidad</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
include("../conexion.php");
$cons="select seguimiento.* from seguimiento
where seguimiento.nroinca='$nro'";
$resu=mysql_query($cons)or die ("Error en la busqueda de historial");
$reg=mysql_num_rows($resu);
if($reg!=0):
  ?>
      <table border="0" align="center">
        <tr>
           <td class="cajas"><b>Nro_Incapacidad:&nbsp;<?echo $nro;?></b></td>
        </tr>
      </table>
       <tr><td><br></td></tr>
         <table border="0" align="center" >
            <tr>
              <th>Item</th>
              <th>Radicado</th>
              <th>Fecha_Radicado</th>
              <th>Observación</th>
           </tr>
         <?
         $a=1;
         while($filas=mysql_fetch_array($resu)):
           ?>
            <tr class="cajas">
               <th><?echo $a;?></th>
               <td><?echo $filas["conse"];?></a></td>
               <td><?echo $filas["fechap"];?>&nbsp;</td>
               <td><?echo $filas["nota"];?></td>
            </tr>
           <?
           $a=$a+1;
         endwhile;
         ?>
       </table>
         <?
 else:
     ?>
       <script language="javascript">
          alert("Este Nro de incapacidad no tiene Historial ?")
         history.back()
      </script>
     <?
 endif;
?>
</body>
</html>
