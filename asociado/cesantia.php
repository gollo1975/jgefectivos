<html>

<head>
  <title>Consulta de Prestaciones</title>
   <LINK  REL="stylesheet" HREF="../estiloa.css"  type="text/css">
</head>
<body>
<?
    include("../conexion.php");
    $consulta="select prestacion.* from prestacion,empleado where
    empleado.cedemple=prestacion.cedemple and
    empleado.cedemple='$xcodigo' order by nropresta";
    $resultado=mysql_query($consulta)or die ("Error al buscar prestaciones");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
	    ?>
	    <script language="javascript">
	    alert ("Este asociado no tiene compensaciones finales en sistema.?")
	    history.back()
	    </script>
	    <?
     else:
          ?>
          <center><h4><u>Datos Encontrados</u></h4></center>
          <table border="1" align="center">
	     <tr class="cajas">
	          <th>Presione Click sobre el campo [Nro_Prest.] para ver el Informe..</th>
	      </tr>
	      </table>
	<table border="0" align="center">
	<tr>
	    <td colspan="30"></td>
	  </tr>
	  <tr class="cajas">
             <th>#</th>
	     <th>Nro_Prest.</th>
	     <th>Documento</th>
	     <th>Empleado</th>
	     <th>F_Proceso</th>
	     <th>F_Inicio</th>
	     <th>F_Termino</th>
	     <th>Ibc</th>
	     <th>Vlr_Tota</th>
             <th>Vlr_Pagar</th>
	      <th>Pagado</th>
	    </tr>
	    <?  $a=1;
	     while($filas=mysql_fetch_array($resultado)):
	     $aux1=number_format($filas["ibc"],0);
	     $aux2=number_format($filas["total"],0);
             $aux3=number_format($filas["totalp"],0);
	   ?>
	     <tr class="cajas align="center">
             <th><?echo $a;?></th>
	       <td><a href="../vacaciones/imprimirpresta.php?nropresta=<?echo $filas["nropresta"];?>"><?echo $filas["nropresta"];?></a></td>
	       <td>&nbsp;&nbsp;<?echo $filas["cedemple"];?></td>
	       <td>&nbsp;&nbsp;<?echo $filas["nombres"];?></td>
	        <td>&nbsp;&nbsp;<?echo $filas["fechapro"];?></td>
	       <td>&nbsp;&nbsp;<?echo $filas["fechaini"];?></td>
	       <td>&nbsp;&nbsp;<?echo $filas["fechacor"];?></td>
	        <td>&nbsp;&nbsp;<?echo $aux1;?></td>
	       <td>&nbsp;&nbsp;<?echo $aux2;?></td>
               <td>&nbsp;&nbsp;<?echo $aux3;?></td>
	         <td>&nbsp;&nbsp;<?echo $filas["estado"];?></td>

	       </tr>
	       <?
                $a=$a+1;
	      endwhile;
  endif;
	  ?>
</table>
</body>
</html>
