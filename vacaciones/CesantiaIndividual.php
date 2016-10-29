<html>

<head>
  <title>Cesantias e Intereses</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
if (!isset($valor)):
     ?>
     <center><h4><u>Cesantias e Intereses</u></h4></center>
    <form action="" method="post">
    <input type="hidden" name="codigo" value="<?echo $codigo;?>" size="20" maxlength="20">
      <table border="0" align="center">
      <tr><td><br></td></tr>
       <tr>
         <td><b>Campo de Consulta:</b></td>
         <td><select name="campo">
            <option value="0">Seleccione
            <option value="1">Documento
            <option value="2">Empleado
            </select></td>
       </tr>
       <tr>
         <td><b>Dato de Consulta:</b></td>
         <td><input type="text" name="valor" value="" size="20" maxlength="20"></td>
       </tr>
       <tr><td><br></td></tr>
      <tr>
        <td colspan="2">
          <input type="submit" value="Buscar" class="boton">
          <input type="reset" value="limpiar" class="boton">
        </td>
      </tr>
    </table>
    </form>
<?
elseif(empty($valor)):
?>
  <script language="javascript">
    alert ("Digite un valor a Consultar ?")
    history.back()
  </script>
 <?
 elseif($campo==0):
?>
  <script language="javascript">
    alert ("Seleccione el tipo de busqueda ?")
    history.back()
  </script>
 <?
else:
    include("../conexion.php");
    if($codigo==''){
	    $opc=$campo;
	    switch($opc)
	    {
	      case 1:
	        $consulta="select cesantiainteres.*,empleado.basico from cesantiainteres,empleado where
	        empleado.cedemple=cesantiainteres.cedemple and
	        empleado.cedemple='$valor' order by cesantiainteres.fechap DESC";
	        break;
	      case 2:
	        $consulta="select cesantiainteres.*,empleado.basico from cesantiainteres,empleado where
	        empleado.cedemple=cesantiainteres.cedemple and
	        empleado.nomemple like'%$valor%' order by cesantiainteres.nombre";
	        break;
	     }
      }else{
            $opc=$campo;
	    switch($opc)
	    {
	      case 1:
	        $consulta="select cesantiainteres.*,empleado.basico from cesantiainteres,empleado where
	        empleado.cedemple=cesantiainteres.cedemple and
                cesantiainteres.codzona='$codigo' and
	        empleado.cedemple='$valor' order by cesantiainteres.fechap DESC";
	        break;
	      case 2:
	        $consulta="select cesantiainteres.*,empleado.basico from cesantiainteres,empleado where
	        empleado.cedemple=cesantiainteres.cedemple and
                cesantiainteres.codzona='$codigo' and
	        cesantiainteres.nombre like'%$valor%' order by cesantiainteres.nombre";
	        break;
	     }
      }
    $re=mysql_query($consulta)or die ("Eror de consulta $opcion");
    $reg= mysql_num_rows($re);
    if ($reg!=0):
        ?>
          <center><h4><u>Cesantias e Intereses</u></h4></center>
           <table border="0" align="center">
                    <tr class="cajas">
                      <td>Presione Click sobre el Nro_Prima para Ver el Reporte ..</td>
                    </tr>
                  </table>
            <table border="0" align="center">
               <tr>
                 <td colspan="30"></td>
               </tr>
               <tr class="cajas">
               <th>#</th>
                 <th>Nro_Cesantia</th>
                 <th>Documento</th>
                 <th>Empleado</th>
                 <th>F._Inicio</th>
                 <th>F._Corte</th>
                 <th>F_Proceso</th>
                 <th>Basico</th>
                 <th>Ibc</th>
                 <th>Vlr_Cesantia</th>
                 <th>Vlr_Interes</th>
                  </tr>
                <?   $R=1;
                 while($filas_s=mysql_fetch_array($re)){
                    $Cesantia=number_format($filas_s["pagocesantia"],0);
                    $Interes=number_format($filas_s["pagointeres"],0);
                     $Ibc=number_format($filas_s["salario"],0);
                    $Basico=number_format($filas_s["basico"],0);
                     ?>
                     <tr class="cajas align="center">
                     <th><?echo $R;?></th>
                       <td><a href="ImpCesantiaInteres.php?NroC=<?echo $filas_s["nrocesantia"];?>"><?echo $filas_s["nrocesantia"];?></a></td>
                        <td><?echo $filas_s["cedemple"];?></td>
                        <td><?echo $filas_s["nombre"];?></td>
                       <td><?echo $filas_s["fechainicio"];?></td>
                       <td><?echo $filas_s["fechafinal"];?></td>
                       <td><div align="center"><?echo $filas_s["fechap"];?></div></div></td>
                        <td><div align="right"><?echo $Basico;?></div></td>
                       <td><div align="right"><?echo $Ibc;?></div></td>
                       <td><div align="right"><?echo $Cesantia;?></div></td>
                        <td><div align="right"><?echo $Interes;?></div></div></td>
                        </tr>
                       <?
                         $R=$R+1;
                         $TotalC=$TotalC + $filas_s["pagocesantia"];
                         $TotalI=$TotalI + $filas_s["pagointeres"];
                   }
                   $TotalC=number_format($TotalC);
                   $TotalI=number_format($TotalI);
                  ?>
                   </table>
                   <div align="center"><b>Total_Cesantia:&nbsp;$<?echo $TotalC;?>&nbsp;Total_Interes:&nbsp;$<?echo $TotalI;?></b></div>
                  <?
     else:
        ?>
          <script language="javascript">
             alert("El documento digitado no presenta cesantias e intereses generados o no hace parte de esta Empresa!")
             history.back()
          </script>
        <?
     endif;
 endif;
 ?>
</body>
</html>
