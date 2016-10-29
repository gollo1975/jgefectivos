<html>
<head>
  <title>Abonos por Creditos</title>
    <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
include("../conexion.php");
$buscar="select debitomercado.* from mercado,debitomercado
       where mercado.codmerca=debitomercado.codmerca and
             mercado.codmerca='$nroAuto'";
$res=mysql_query($buscar)or die("Consulta incorrecta uno");
$reg=mysql_affected_rows();
if ($reg!=0):
?>

   <center><h4><u>Abonos a Mercado</u></h4></center>
   <table border="0" align="center">
     <tr  class="fondo">
        <td colspan="9"><br></td>
     </tr>
     <tr  class="cajas">
        <th>Nro_Abono</th>
        <th>Nro_Auto.</th>
        <th>Saldo</th>
        <th>Abono</th>
        <th>F_Abono</th>
         <th>Nota</th>
        </tr>
        <?
     while($filas_s=mysql_fetch_array($res)):
        $xbusca=number_format($filas_s["nsaldo"],0);
        $xbusca1=number_format($filas_s["abono"],0);
           ?>
         <tr class="cajas" align="center">
            <td><?echo $filas_s["numero"];?></td>
             <td><? echo $filas_s["codmerca"];?></td>
            <td><?echo $xbusca;?></td>
            <td><?echo $xbusca1;?></td>
            <td><?echo $filas_s["fechabono"];?></td>
            <td><?echo $filas_s["nota"];?></td>
         </tr>
         <?
          $suma=$suma+$filas_s["abono"];
     endwhile;
     $xbusca4=number_format($suma,0);
   ?>
   </table>
   <tr><td>&nbsp;</td></tr>
    <center><td class="cajas"><b>Total_Abono:&nbsp;&nbsp;<?echo $xbusca4;?></td></center>
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
