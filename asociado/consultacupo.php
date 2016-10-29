<html>
<head>
  <title>Solictud Cupo de Crédito</title>
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
                            alert ("Favor digite el documento de identidad del Empleado!");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        if (document.getElementById("Documento").value.length <=0)
                        {
                            alert ("Favor digite el documento del vendedor o solicitante!");
                            document.getElementById("Documento").focus();
                            return;
                        }
                         document.getElementById("matcupo").submit();

                    }
                </script>
</head>
<body>
<?
  if (!isset($cedula)):

  ?>
  <center><h4><u>Solicitud de Cupo</u></h4></center>
<form action="" method="post" id="matcupo">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Documento Empleado:</b></td>
     <td><input type="text" name="cedula" value="" size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">
     </tr>
      <tr>
     <td><b>Documento Vendedor:</b></td>
     <td><input type="text" name="Documento" value="" size="15" maxlength="15"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento">
     </tr>
      <tr>
     <td><b>Tipo_Proceso:</b></td>
       <td><input type="radio" value="nuevo"  name="tipoP">Nuevo<input type="radio" value="historial"  name="tipoP">Historial</td>
     </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="button" value="Buscar" class="boton" Onclick="chequearcampos()">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
   <tr><td></td></tr>
    <tr><td></td></tr>
</table>
</form>
<?elseif(empty($tipoP)):
 ?>
         <script language="javascript">
             alert("Seleccione el tipo de proceso a realizar!")
             history.back()
         </script>
         <?
else:
 include("../conexion.php");
 if($tipoP=='nuevo'):
     $conE="select concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1) as Nombres from empleado where cedemple='$cedula'";
     $resE=mysql_query($conE)or die("Error al buscar empleados");
     $regE=mysql_num_rows($resE);
     $filas=mysql_fetch_array($resE);
     $Nombres=$filas["Nombres"];
     if($regE!=0):
        $conC="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,contrato.fechainic,contrato.salario from empleado,contrato
              where empleado.codemple=contrato.codemple and
              contrato.fechater='0000-00-00' and
              empleado.cedemple='$cedula'";
        $resC=mysql_query($conC)or die("Error al buscar contratos de empleados");
        $regC=mysql_num_rows($resC);
        $filas_C=mysql_fetch_array($resC);
        $fechaI=$filas_C["fechainic"];
        $salario=$filas_C["salario"];
        if($regC !=0 ):
            $conP="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,retiroprovision
                    where empleado.cedemple=retiroprovision.cedemple and
                    empleado.cedemple='$cedula' and
                    retiroprovision.estado = 'ACTIVO' order by retiroprovision.codretiro DESC";
            $resP=mysql_query($conP)or die("Error al buscar empleados con retiro provisional");
            $regP=mysql_num_rows($resP);
            if($regP==0):
                 $conN="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado
                    where empleado.cedemple='$cedula' and
                    empleado.nomina = 'SI'";
	         $resN=mysql_query($conN)or die("Error al buscar empleados con nomina");
	         $regN=mysql_num_rows($resN);
                 if($regN !=0 ):
		           $fechaC=date("Y-m-d");
		           ?>
	                  <form action="GenerarCupo.php" method="post">
	                  <input type="hidden" name="Nombres" value="<?echo $Nombres;?>" size="50">
	                  <input type="hidden" name="fechaI" value="<?echo $fechaI;?>" size="50">
	                   <input type="hidden" name="fechaC" value="<?echo $fechaC;?>" size="12">
	                   <input type="hidden" name="Salario" value="<?echo $salario;?>" size="15">
	                   <input type="hidden" name="cedula" value="<?echo $cedula;?>" size="15">
	                   <input type="hidden" name="Documento" value="<?echo $Documento;?>" size="15">
		            <table border="0" align="center">
		             <tr>
		              <td><?echo $Nombres;?></td>
		               </tr>
		            </table>
		            <?
	                     $con="select credito.*,salario.desala from empleado,credito,salario
		              where empleado.cedemple=credito.cedemple and
		                   credito.codsala=salario.codsala and
		                   credito.nuevo > 0 and
		                   empleado.cedemple='$cedula' and credito.sumarcupo='SI' order by credito.nrocredito";
		             $res=mysql_query($con)or die("Error al buscar datos");
		             $reg=mysql_num_rows($res);
		             $reg=mysql_affected_rows();
		             ?>
		              <center><h4><u>Listado de Créditos</u></h4></center>
	                       <table border="0" align="center">
		               <tr  class="cajas">
	                       <th>Reg.</th>
		                  <th>Nro_Crédito</th>
		                  <th>Descripción</th>
		                  <th>F_Proceso</th>
		                  <th>P_Dias</th>
		                  <th>Entregado</th>
		                  <th>T_Credito</th>
		                   <th>Cuota</th>
		                   <th>Saldo</th>
		                   <th>Nota</th>
		              </tr>
		              <? $l=1;
		               while($filas_s=mysql_fetch_array($res)):
		                 $xbusca=number_format($filas_s["vlrentregado"],0);
		                 $xbusca1=number_format($filas_s["tcredito"],0);
		                 $xbusca2=number_format($filas_s["cuota"],0);
		                 $xbusca3=number_format($filas_s["nuevo"],0);
		                ?>

		              <tr class="cajas">
	                       <th><?echo $l;?></th>
		                <td><div align="center"><?echo $filas_s["nrocredito"];?></div></td>
		                 <td><?echo $filas_s["desala"];?></td>
		                 <td><?echo $filas_s["fesalida"];?></td>
		                  <td><?echo $filas_s["plazo"];?></td>
		                 <td><?echo $xbusca;?></td>
		                 <td><?echo $xbusca1;?></td>
		                 <td><?echo $xbusca2;?></td>
		                 <td><?echo $xbusca3;?></td>
		                 <td><?echo $filas_s["nota"];?></td>
		               </tr>
		              <? $l=$l+1;
		              $suma=$suma+$filas_s["nuevo"];
		            endwhile;
		            $xbusca4=number_format($suma,0);
		            ?>
	                    <tr><td><br></td></tr>
	                    <tr>
	                     <td colspan="2">
	                       <input type="submit" value="Generar Cupo" class="boton">
	                     </tr>
		            </table>
                            <div align="center"><div align="center"><b>Total Deuda:&nbsp;$<?echo $xbusca4;?></b></div></div>
	                    <input type="hidden" name="Saldo" value="<?echo $suma;?>">
	                 </form>
	            <?
                else:
                    ?>
	           <script language="javascript">
	             alert("Este Empleado no esta autorizado para sacar vestuario, esta incapacitado por el fondo de Pensiones!")
	             history.back()
	           </script>
	           <?
                endif;
            else:
                ?>
	           <script language="javascript">
	             alert("Este Empleado esta retirado provisionalmente de la Empresa, favor llamar. 444-8120 Ext. 102-103!")
	             history.back()
	           </script>
	           <?
            endif;
        else:
          ?>
           <script language="javascript">
             alert("Este Empleado ya no trabaja con la empresa de JGEFECTIVOS SAS., esta retirado!")
             history.back()
           </script>
           <?
        endif;
     else:
         ?>
         <script language="javascript">
             alert("Este documento no existe en el sistema de JGEFECTIVOS SAS. Favor verificar!")
             history.back()
         </script>
         <?
     endif;
 else:
   $conH="select cupocredito.* from cupocredito,empleado
              where empleado.cedemple=cupocredito.cedemple and
                    empleado.cedemple='$cedula'";
   $resH=mysql_query($conH)or die("Error al buscar contratos cupos de creditos");
   $regH=mysql_num_rows($resH);
   if($regH != 0 ):
      ?>
     <center><h4><u>Listado de Cupos</u></h4></center>
     <table border="0" align="center">
       <tr class="cajas">
          <th>Reg.</th>
          <th>Nro_Cupo</th>
          <th>Documento</th>
          <th>Empleado</th>
          <th>F_Proceso</th>
          <th>Vlr_Cupo</th>
          <th>Solicitado</th>
       </tr>
       <?$x=1;
        while($filas_T=mysql_fetch_array($resH)):
        $valor=number_format($filas_T["vlrcupo"],0);
           ?>
             <tr class="cajas">
                 <th><?echo $x;?></th>
                 <td><div align="center"><?echo $filas_T["nrocupo"];?></div></td>
                <td><? echo $filas_T["cedemple"];?> </td>
                <td><?echo $filas_T["empleado"];?></td>
                <td><?echo $filas_T["fechap"];?></td>
                <td><div align="center"><?echo $valor;?></div></td>
                <td><?echo $filas_T["documento"];?></td>
             </tr>
           <?$x=$x+1;
        endwhile;
       ?>
     </table>

     <td><div align="center"><h4><a href="consultacupo.php"><font color="blue"><u>Volver</u></font></a></h4></div></td>
    <?
    else:
      ?>
         <script language="javascript">
             alert("Este documento tiene cupos de créditos generados.!")
             history.back()
         </script>
         <?
    endif;
 endif;
endif;
  ?>
</table>

</body>
</html>
