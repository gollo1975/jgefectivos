<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
    function ActualizarSaldo()
         {
         totalitem = 0
         pagado = 0
         totalitem =  document.getElementById("tActualizaciones").value
         var nEle = document.f2.elements.length;
               for (i=0; i<nEle; i++) {
                  if (document.f2.elements[i].type=="checkbox" &&
	                document.f2.elements[i].name.lastIndexOf('datoN')!=-1 ) {
			document.f2.elements[i].checked ? document.f2.elements[i].checked=false : document.f2.elements[i].checked=true;
	          }
                }
      }

</script>
</head>
<body>
<?php
if(!isset($Desde)){
    include("../conexion.php");
    ?>
     <center><h4><u>Importar Intereses</u></h4></center>
     <form action="" method="post" width="200" name="f1" id="f1">
          <table border="0" align="center">
              <tr><td><br></td></tr>
              <tr>
                   <td><b>Desde:</b></td>
                   <td><input type="text" name="Desde" value="<? echo date("Y-m-d");?>" class="cajas" size="12" maxlegth="10"></td>
                   <td><b>Hasta:</b></td>
                   <td><input type="text" name="Hasta" value="<? echo date("Y-m-d");?>" class="cajas" size="12" maxlegth="10"></td>
              </tr>
              <tr>
                   <td><b>Zona:</b></td>
                   <td colspan="5"><select name="CodZona" class="cajas">
                        <option value="0">Seleccione la zona
                        <?
                         $consulta_z="select codzona,zona from zona where zona.nomina='SI' and zona.estado='ACTIVA' order by zona";
                         $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                         while($filas_z=mysql_fetch_array($resultado_z)){
                              ?>
                              <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                              <?
                         }
                              ?>
                   </select></td>
              </tr>
              <tr><td><br></td></tr>
              <tr>
                 <td><input type="submit" value="Buscar" class="boton" name="buscar" id="buscar"></td>
              </tr>
          </table>
     </form>
<?
}elseif (empty($CodZona)){
     ?>
     <script language="javascript">
        alert("Seleccione la zona para importar los intereses a las cesantias!")
        history.back()
     </script>
     <?
}else{
     include("../conexion.php");
     $con1="select zona.codzona,zona.zona,cesantiainteres.inicioperiodo,cesantiainteres.fechafinal from zona,cesantiainteres
     where  cesantiainteres.codzona=zona.codzona and
            zona.codzona='$CodZona' and
            cesantiainteres.inicioperiodo='$Desde' and
            cesantiainteres.fechafinal='$Hasta' order by cesantiainteres.nombre ";
     $re1=mysql_query($con1)or die("Error al buscar Validador de intereses");
     $Num=mysql_num_rows($re1);     
     $filas=mysql_fetch_array($re1);
     $Zona=$filas["zona"];
     if($Num != 0){?>
         <form action="IntegrarIntereses.php" method="post" name="f2" id="f2">
         <input type="hidden" name="Desde" value="<? echo $Desde;?>">
         <input type="hidden" name="Hasta" value="<?echo $Hasta;?>">
	     <center><h4><u>Importar Intereses</u></h4></center>
	     <table border="0" align="center">
		    <tr>
		      <td class="cajas"><b>Cód_Zona:</b>&nbsp;<? echo $CodZona;?></td>
		    </tr>
		    <tr>
		      <td class="cajas"><b>Zona:</b>&nbsp;<? echo $Zona;?></td>
		    </tr>
	             <tr class="cajas">
		      <td><b>Desde:</b>&nbsp;<? echo $Desde;?>
	              <b>Hasta:</b>&nbsp;<? echo $Hasta;?></td>
		    </tr>
                    </table>
                   <table border="0" align="center">
                                       </tr>
                    <td><b>Cod_Salario.:</b></td>
                     <td> <select name="CodSalario" class="cajasletra">
                          <?
                          $consulta_b="select salario.codsala,salario.desala from salario where salario.formapago='ANUAL' and estado='ACTIVO'";
                          $resultado_b=mysql_query($consulta_b) or die("eRRORR");
                          while ($filas_b=mysql_fetch_array($resultado_b))
                          {
                          ?>
                               <option value="<?echo $filas_b["codsala"];?>"><?echo $filas_b["desala"];?>
                          <?
                          }
                          ?>
                    </select></td>
              </tr>
               <tr>
		  <td><b>Estado:</b></td>
	          <td><select name="EstadoC" class="cajas">
		  <option value="SI">SI
	          <option value="NO">NO
                  </select>
		  <b>Permanente:</b>
	          <select name="EstaPerma" class="cajas">
		  <option value="SI">SI
	          <option value="NO">NO
                  </select></td>
              </tr>
               <tr>
		  <td><b>Salda_Campo:</b></td>
	          <td><select name="SaldarS" class="cajas">
		  <option value="NO">NO
                   <option value="SI">SI
		  </select></td>
              </tr>
              </table>
	    <table border="0" align="center">
	     </table><?
             $conI="select cesantiainteres.* from zona,cesantiainteres
             where  cesantiainteres.codzona=zona.codzona and
                    zona.codzona='$CodZona' and
                    cesantiainteres.inicioperiodo='$Desde' and
                    cesantiainteres.fechafinal='$Hasta' order by cesantiainteres.nombre ";
             $reI=mysql_query($conI)or die("Error al buscar Intereses");
             $regis=mysql_num_rows($reI);
         ?>
         <table border="0" align="center">
             <tr class="cajas">
		       <th>Item</th><th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Documento</b></th><th><b>Empleado</b></th><th><b>Desde</b></th><th><b>Hasta</b></th><th><b>Vlr_Interes</b></th>
		  </tr>
	   <?
           $i=1;
            while($fila=mysql_fetch_array($reI)){
                 $aux=number_format($fila["pagointeres"],0);
                 ?>
                  <tr  class="cajas">
	                 <th><?echo $i;?></th><?
	                 echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['cedemple'] ."\"></td>");?>
	                  <td class="cajas"><?echo $fila["cedemple"];?></td>
	                  <td class="cajas"><?echo $fila["nombre"];?></td>
	                 <td class="cajas"><?echo $Desde;?></td>
	                 <td class="cajas"><?echo $Hasta;?></td>
	                 <td><div align="right">$<?echo $aux;?></div></td>
	         </tr>
                   <?
                    $i=$i+1;
	    }
            echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . $regis . "\">");
            ?>
            <tr><td><br></td></tr>
                <td colspan="5">
	     <input type="submit" value="Exportar" class="boton" name="exportar" id="exportar" ></td>
	   </table>
        </form>
        <?
      }else{
          ?>
	     <script language="javascript">
	        alert("No se han generado los intereses a las Cesantias para esta Zona!")
	        
	     </script>
     <?
      }
}
?>
</body>
</html>
