<html>
<head>
  <title>Abonos por Creditos</title>
    <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='detalladocredito.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
include("../conexion.php");
$buscar="select abono.* from credito,abono
       where credito.nrocredito=abono.nrocredito and
             credito.nrocredito='$cod'";
$res=mysql_query($buscar)or die("Consulta incorrecta uno");
$reg=mysql_affected_rows();
if ($reg!=0):
?>
   <center><h3>Listado de Abonos</h3></center>
   <table border="0" align="center">
     <tr  class="fondo">
        <td colspan="9"><br></td>
     </tr>
     <tr  class="cajas">
        <th>Nro_Abono</th>
        <th>Nro_Crédito</th>
        <th>Saldo</th>
        <th>Abono</th>
        <th>Fecha</th>
        <th>Observación</th>
        </tr>
        <?
     while($filas_s=mysql_fetch_array($res)):
     $xbusca=number_format($filas_s["nuevo"],2);
     $xbusca1=number_format($filas_s["abono"],2);
           ?>
         <tr class="cajas" align="center">
            <td><?echo $filas_s["codabono"];?>&nbsp;</td>
             <td>&nbsp;<?echo $filas_s["nrocredito"];?></td>
            <td>&nbsp;<?echo $xbusca;?></td>
            <td>&nbsp;<?echo $xbusca1;?>&nbsp;</td>
            <td><?echo $filas_s["fecha"];?></td>
            <td><?echo $filas_s["nota"];?></td>
          </tr>
         <?
          $suma=$suma+$filas_s["abono"];
     endwhile;
     $xbusca2=number_format($suma,2);
   ?>
   </table>
   <tr><td>&nbsp;</td></tr>
    <center><td class="cajas"><b>Total_Abono:</b>&nbsp;&nbsp;<?echo $xbusca2?></td></center>
     <tr><td>&nbsp;</td></tr>
    <th><center><a href="impabono.php?nro=<?echo $cod;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></center></th>
   <?
else:
  ?>
  <script language="javascript">
    alert("NO hay Abonos Para este Credito ?")
    history.go(-1)
  </script>
 <?
endif;
 ?>
</body>

</html>
