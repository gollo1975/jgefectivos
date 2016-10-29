<html>
<head>
<title>Grabando registro</title>
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
<script type="text/javascript">
</script>
</head>
<body>
<?
if(empty($nroinca)):
else:
    include("../conexion.php");
    $consulta="select incapacidad.*,empleado.basico,concat(nomemple,' ', nomemple1, ' ', apemple, ' ', apemple1)as Empleado from incapacidad,empleado
     where incapacidad.nroinca='$nroinca' and
           empleado.cedemple=incapacidad.cedemple";
    $resultado=mysql_query($consulta)or die("Error al buscar la incapacidad");
    $registros=mysql_num_rows($resultado);
    if($registros==0):
      ?>
      <script language="javascript">
         alert("El Documento no existe en la base de datos:")
         history.back()
       </script>
        <?
    else:
       while($filas=mysql_fetch_array($resultado)):
          $auxem=$filas["cedemple"];
          $Salario=$filas["basico"];
        ?>
            <center><h4><u>Datos a Modificar</u></h4></center>
         <form action="guardar.php" method="post">
		 <input type="hidden" name="valor" value="<?echo $valor;?>"> 
		 <input type="hidden" name="opcion" value="<?echo $opcion;?>">
                  <input type="hidden" name="Salario" value="<?echo $Salario;?>">
          <table border="0" align="center">
            <tr>
              <td colspan="2" ><br></td>
            </tr>
            <tr>
              <td><b>Nro_Incapacidad:</b></td>
                <td><input type="text" name="nroinca" value="<?echo $filas["nroinca"];?>" class="cajas" size="25"readonly id="nroinca"></td>
             </tr>
             <tr>
              <td><b>Documento:</b></td>
                <td><input type="text" name="Documento" value="<?echo $filas["cedemple"];?>" class="cajas" size="25"readonly id="Documento"></td>
             </tr>
              <tr>
              <td><b>Empleado:</b></td>
                <td><input type="text" name="Empleado" value="<?echo $filas["Empleado"];?>" class="cajas" size="60"readonly></td>
             </tr>
             <tr>
                 <td><b>F_Inicio:</b></td>
                 <td><input type="text" name="fechaini" value="<?echo $filas["fechaini"];?>" class="cajas"  size="25" maxlength="10" id="fechaini"></td>
             </tr>
             <tr>
                <td><b>F_final:</b></td>
                <td><input type="text" name="fechater" value="<?echo $filas["fechater"];?>"class="cajas" size="25" maxlength="10" id="fechater"></td>
             </tr>
             <tr>
                <td><b>Dias:</b></td>
                <td><input type="text" name="dias" value="<?echo $filas["diasnomina"];?>" class="cajas" size="25" maxlength="3" id="dias" readonly></td>
             </tr>
			 <tr>
                       <td><b>Prorroga:</b></td>
                       <td><select name="Prorroga" class="cajas" id="Prorroga" style="width: 170px">
                         <option vale="<? echo $filas ["prorroga"];?>"selected><? echo $filas["prorroga"];?>
                         <option value="NO">NO
                         <option value="SI">SI
                       </select></td>
                  </tr>
             <tr>

               <td><b>Tipo_Incapacidad:</b></td>
               <td><select name="tipo"class="cajas" id="tipo" style="width: 170px">
                 <?
                 $tuxI=$filas["tipoinca"];
                 $consulta_i="select tipoinca,concepto from tipoinca order by concepto";
                 $resultI=mysql_query($consulta_i)or die("Consulta  incorrecta");
                 while($filasI=mysql_fetch_array($resultI)):
                   if ($tuxI==$filasI["tipoinca"]):
                 ?>
                 <option value="<?echo $filasI["tipoinca"];?>" selected><?echo $filasI["concepto"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filasI["tipoinca"];?>"><?echo $filasI["concepto"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
              </tr>
              <tr>
               <td><b>Eps:</b></td>
               <td><select name="eps"class="cajas" id="eps" style="width: 170px">
                 <?
                 $auxe=$filas["codeps"];
                 $consulta_d="select * from eps order by eps";
                 $resultado_d=mysql_query($consulta_d)or die("Consulta de eps incorrecta");
                 while($filas_d=mysql_fetch_array($resultado_d)):
                   if ($auxe==$filas_d["codeps"]):
                    ?>
                    <option value="<?echo $filas_d["codeps"];?>" selected><?echo $filas_d["eps"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_d["codeps"];?>"><?echo $filas_d["eps"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
                 </tr>
                 <tr>
                       <td><b>Estado:</b></td>
                       <td><select name="estado" class="cajas" id="estado" style="width: 170px">
                         <option value="<? echo $filas ["estado"];?>"selected><? echo $filas["estado"];?>
                         <option value="POR COBRAR">POR COBRAR
                         <option value="CANCELADA">CANCELADA
                         <option value="EN TRANSCRIPCION">EN TRANSCRIPCION</option>
                       </select></td>
                  </tr>
                  <tr>
                   <td><b>Diagnóstico:</b></td>
	               <td><select name="diagnostico"class="cajas" id="diagnostico">
	                 <?
	                 $auxe=$filas["codigo"];
	                 $consulta_d="select control.codigo,control.concepto from control order by codigo";
	                 $resultado_d=mysql_query($consulta_d)or die("Consulta de codigos incorrecta");
	                 while($filas_d=mysql_fetch_array($resultado_d)):
	                   if ($auxe==$filas_d["codigo"]):
	                 ?>
	                 <option value="<?echo $filas_d["codigo"];?>" selected><?echo $filas_d["codigo"];?>-<?echo $filas_d["concepto"];?>
	                 <?
	                   else:
	                   ?>
	                     <option value="<?echo $filas_d["codigo"];?>"><?echo $filas_d["codigo"];?>-<?echo $filas_d["concepto"];?>
	                   <?
	                   endif;
	                 endwhile;
	                 ?> </selet></td>
	                 </tr>
                   <tr>
                       <td><b>Cod_Salario:</b></td>
	                   <td><select name="CodSala"class="cajas" id="CodSala" style="width: 170px">
	                       <?
	                       $auxC=$filas["codsala"];
	                       $conS="select codsala,desala from salario where salario.agruparincapa='SI' order by desala";
	                       $resuS=mysql_query($conS)or die("Error al buscar los salarios");
	                       while($filaS=mysql_fetch_array($resuS)):
	                          if ($auxC==$filaS["codsala"]):
								 ?>
								 <option value="<?echo $filaS["codsala"];?>" selected><?echo $filaS["codsala"];?>-<?echo $filaS["desala"];?>
								 <?
						      else:
								   ?>
									 <option value="<?echo $filaS["codsala"];?>"><?echo $filaS["codsala"];?>-<?echo $filaS["desala"];?>
								   <?
  						      endif;
						 endwhile;  
					 ?></selet></td>
	                 </tr>
					 <tr>
                       <td><b>Reconocer_Usuaria:</b></td>
	                   <td><select name="Reconocer"class="cajas" id="Reconocer" style="width: 170px">
					   <option value="<? echo $filas ["reconocerusuaria"];?>"selected><? echo $filas["reconocerusuaria"];?>
                         <option value="NO">NO
                         <option value="SI">SI
					     </selet></td>
	                 </tr>
                         <tr>
                           <td><b>Motivo:</b></td>
                           <td><textarea name="motivo" cols="60" rows="8" class="cajas"><?echo $filas["motivo"];?></textarea></td>
                         </tr>
                         <tr><td><br></td></tr>
                         <tr>
                           <td colspan="2">
                             <input type="submit" value="Guardar" class="boton">
                             <input type="reset" value="Limpiar" class="boton">
                           </td>
                          </tr>


         <?
             endwhile;
           endif;
         endif;
 ?>
 </table>
 
 </form>
</body>
</html>
