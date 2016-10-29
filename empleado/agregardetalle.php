<html>
<head>
  <title>Detalle Empleado</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script type="text/javascript" src="../calendar.js"></script>
</head>
<body>
<div id="calendarDiv"></div>

<?
if (!isset($cedula)):
   $sw=0;
 ?>
 <center><h4><u>Detalle Empleado</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center">
     <tr><td><br></td></tr>
       <tr>
         <td><b>Documento de Indentidad:</b></td>
         <td><input type="text" name="cedula" value="" size="15" maxlength="15"></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspna="3">
         <input type="submit" value="Buscar" class="boton"></td>
       </tr>
    </table>
  </form>
<?
elseif(empty($cedula)):
   ?>
    <script language="javascript">
      alert("Digite el Documento de Indentidad..")
      history.back()
    </script>
<?
else:
   include("../conexion.php");
if($sw==0):
   $cons="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.codemple,zona.zona,zona.codzona from empleado,contrato,zona where
         zona.codzona=empleado.codzona and
         empleado.codemple=contrato.codemple and
         contrato.fechater='0000-00-00' and
         empleado.cedemple='$cedula'";
   $resu=mysql_query($cons)or die ("Error de Consulta");
   $reg=mysql_num_rows($resu);
   if($reg!=0):
      $consD="select detallempleado.cedemple from detallempleado where detallempleado.cedemple='$cedula'";
      $resuD=mysql_query($consD)or die ("Error al buscar relacion del detalle");
      $regD=mysql_num_rows($resuD);
      if($regD ==0):
         while($filas=mysql_fetch_array($resu)):
         ?>
          <center><h4><u>Detalle Empleado</u></h4></center>
          <form action="grabarDetalle.php" method="post" width="250">
           <table border="0" align="center" width="250">
           <input type="hidden" name="cedula" value="<? echo $cedula;?>">
            <tr><td><br></td></tr>
             <tr>
                <td><b>Documento:</b></td>
               <td><input type="text" name="cedula" value="<? echo $cedula;?>"class="cajas" size="15" maxlenght="15" readonly></td>
             </tr>
             <tr>
                <td><b>Empleado:</b></td>
               <td colspan="5"><input type="text" name="empleado" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" class="cajas"size="53" readonly></td>
             </tr>
              <tr>
                <td><b>Zona:</b></td>
               <td colspan="5"><input type="text" name="" value="<? echo $filas["zona"];?>" class="cajas"size="53"  readonly></td>
            <input type="hidden" name="zona" value="<? echo $filas["codzona"];?>" class="cajas"size="53"  readonly>
             </tr>
             <tr>
                <td><b>Nivel_Estudio:</b></td>
                <td><select name="nivel" class="cajasletra">
                 <option value="0">Seleccione el Nivel de Estudio
                    <option value="PRIMARIA">PRIMARIA
                    <option value="SECUNDARIA">SECUNDARIA
                    <option value="TECNICA">TECNICA
                    <option value="TECNOLOGIA">TECNOLOGIA
                    <option value="UNIVERSITARIO">UNIVERSITARIO
                    <option value="POSGRADO">POSGRADO
                    <option value="MAGISTER">MAGISTER
                    <option value="OTRA">OTRA
                   </select></td>
                    <td><b>Cabeza_Familia:</b></td>
                    <td><select name="cabeza" class="cajasletra">
                    <option value="NO">NO
                    <option value="SI">SI
                    </select></td>
             </tr>
             <tr>
                <td><b>Padre_Familia:</b></td>
                <td><select name="padre" class="cajasletra">
                    <option value="NO">NO
                    <option value="SI">SI
                    <td><b>Nro_Hijos:</b></td>
                   <td><input type="text" name="nro" value="" class="cajas" size="5" maxlength="5"></td>
                    </select></td>
             </tr>
             <tr>
                <td><b>Rango_Salario:</b></td>
                <td><select name="rango" class="cajasletra">
                 <option value="0">Seleccione el Rango
                    <option value="MAYOR A 0 HASTA 1">MAYOR A 0 HASTA 1
                    <option value="MAYOR A 1 HASTA 2">MAYOR A 1 HASTA 2
                    <option value="MAYOR A 2 HASTA 3">MAYOR A 2 HASTA 3
                    <option value="MAYOR A 3 HASTA 4">MAYOR A 3 HASTA 4
                    <option value="MAYOR A 4 HASTA 6">MAYOR A 4 HASTA 6
                    <option value="MAYOR A 6 HASTA 8">MAYOR A 6 HASTA 8
                    <option value="MAYOR A 8 HASTA 11">MAYOR A 8 HASTA 11
                    <option value="MAYOR A 11 HASTA 17">MAYOR A 11 HASTA 17
                    </select></td>
             </tr>
              <tr><td><br></td></tr>
               <table border="0" align="center" width="500">
              <tr>
                <td><b>Tipo_Id.:</b></td>
                <td><select name="tipo" class="cajasletra">
                 <option value="0">Seleccione el tipo
                    <option value="RC">R. CIVIL
                    <option value="NUIT">N. UNICO DE ID.
                    <option value="TI">T.IDENTIDAD
                    <option value="CC">C.CIUDADANIA
                    <option value="CE">C.EXTRANJERIA
                    <option value="PA">PASAPORTE
                    </select>
                    <b>Documento:</b>
                    <input type="text" name="documento" value="" class="cajas" size="13" maxlength="11">
                    <b>Parent.:</b>
                    <select name="parentezco" class="cajasletra">
						<option value="HIJA">HIJA
                      	<option value="HIJO">HIJO
                     	<option value="ESPOSA">ESPOSA
						<option value="ESPOSO">ESPOSO
                    	<option value="MADRE">MADRE
                    	<option value="PADRE">PADRE
                    	<option value="HIJASTRA">HIJASTRA
						<option value="HIJASTRO">HIJASTRO
                    	<option value="OTRO">OTRO
                    </select></td>
                  </tr>
                  <tr>
                   <td><b>Nombres:</b></td>
                   <td><input type="text" name="nombres" value="" class="cajas" size="40" maxlength="40" />
                   <b>F_Nac.:</b>
                    <input type="text" name="fechan" value="<?php echo date("Y-m-d");?>" class="cajas" size="10" maxlenght="10" />
             </tr>

              <tr><td><br></td></tr>
              <tr>
                 <td colspan="5">
                  <input type="submit" value="Guardar Dato" class="boton"></td>
                </tr>
          </table>
         </form>
         <?
      endwhile;
     else:
       ?>
        <script language="javascript">
           alert("Este empleado ya tiene la documentacion en sistema.")
           history.back()
        </script>
     <?
     endif;
    else:
       ?>
     <script language="javascript">
       alert("Este Documento no existe en sistema.")
       history.back()
     </script>
     <?
    endif;
 else:
      $consD="select detallempleado.* from detallempleado where detallempleado.cedemple='$cedula'";
      $resuD=mysql_query($consD)or die ("Error al buscar relacion del detalle");
      $regD=mysql_num_rows($resuD);
      if($regD !=0):
         while($filas=mysql_fetch_array($resuD)):
         ?>
          <center><h4><u>Detalle Empleado</u></h4></center>
          <form action="grabarDetalle.php" method="post" width="250">
           <table border="0" align="center" width="250">
           <input type="hidden" name="cedula" value="<? echo $cedula;?>">
            <tr><td><br></td></tr>
             <tr>
                <td><b>Documento:</b></td>
               <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>"class="cajas" size="15" maxlenght="15" readonly></td>
             </tr>
             <tr>
                <td><b>Empleado:</b></td>
               <td colspan="5"><input type="text" name="empleado" value="<? echo $filas["empleado"];?>" class="cajas"size="53" readonly></td>
             </tr>
              <tr>
                <td><b>Zona:</b></td>
               <td colspan="5"><input type="text" name="zona" value="<? echo $filas["zona"];?>" class="cajas"size="53"  readonly></td>
             </tr>
             <tr>
                <td><b>Nivel_Estudio:</b></td>
                <td><select name="nivel" class="cajasletra">
                <option value="<?echo $filas["nivelestudio"];?>" selected><?echo $filas["nivelestudio"];?>
                    <option value="PRIMARIA">PRIMARIA
                    <option value="SECUNDARIA">SECUNDARIA
                    <option value="TECNICA">TECNICA
                    <option value="TECNOLOGIA">TECNOLOGIA
                    <option value="UNIVERSITARIO">UNIVERSITARIO
                    <option value="POSGRADO">POSGRADO
                    <option value="MAGISTER">MAGISTER
                    <option value="OTRA">OTRA
                   </select></td>
                    <td><b>Cabeza_Familia:</b></td>
                    <td><select name="cabeza" class="cajasletra">
                    <option value="<?echo $filas["cabezafamilia"];?>" selected><?echo $filas["cabezafamilia"];?>
                    <option value="NO">NO
                    <option value="SI">SI
                    </select></td>
             </tr>
             <tr>
                <td><b>Padre_Familia:</b></td>
                <td><select name="padre" class="cajasletra">
                <option value="<?echo $filas["padrefamilia"];?>" selected><?echo $filas["padrefamilia"];?>
                    <option value="NO">NO
                    <option value="SI">SI
                    <td><b>Nro_Hijos:</b></td>
                   <td><input type="text" name="nro" value="<?echo $filas["nrohijo"];?>" class="cajas" size="5" maxlenght="5" readonly></td>
                    </select></td>
             </tr>
             <tr>
                <td><b>Rango_Salario:</b></td>
                <td><select name="rango" class="cajasletra">
                  <option value="<?echo $filas["rangosalario"];?>" selected><?echo $filas["rangosalario"];?>
                    <option value="MAYOR A 0 HASTA 1">MAYOR A 0 HASTA 1
                    <option value="MAYOR A 1 HASTA 2">MAYOR A 1 HASTA 2
                    <option value="MAYOR A 2 HASTA 3">MAYOR A 2 HASTA 3
                    <option value="MAYOR A 3 HASTA 4">MAYOR A 3 HASTA 4
                    <option value="MAYOR A 4 HASTA 6">MAYOR A 4 HASTA 6
                    <option value="MAYOR A 6 HASTA 8">MAYOR A 6 HASTA 8
                    <option value="MAYOR A 8 HASTA 11">MAYOR A 8 HASTA 11
                    <option value="MAYOR A 11 HASTA 17">MAYOR A 11 HASTA 17
                    </select></td>
             </tr>
               <table border="0" align="center" width="550">
              <tr>
                <td><b>Tipo_Id.:</b></td>
                <td><select name="tipo" class="cajasletra">
                 <option value="0">Seleccione el tipo
                    <option value="RC">R. CIVIL
                    <option value="NUIT">N. UNICO DE ID.
                    <option value="TI">T.IDENTIDAD
                    <option value="CC">C.CIUDADANIA
                    <option value="CE">C.EXTRANJERIA
                    <option value="PA">PASAPORTE
                    </select>
                    <b>Documento:</b>
                    <input type="text" name="documento" value="" class="cajas" size="14" maxlenght="11">
                    <b>Parent.:</b>
                    <select name="parentezco" class="cajasletra">
						<option value="HIJA">HIJA
                      	<option value="HIJO">HIJO
                     	<option value="ESPOSA">ESPOSA
						<option value="ESPOSO">ESPOSO
                    	<option value="MADRE">MADRE
                    	<option value="PADRE">PADRE
                    	<option value="HIJASTRA">HIJASTRA
						<option value="HIJASTRO">HIJASTRO
                    	<option value="OTRO">OTRO
                    </select></td>
                  </tr>
                  <tr>
                   <td><b>Nombres:</b></td>
                   <td><input type="text" name="nombres" value="" class="cajas" size="40" maxlenght="40">
                   <b>F_Nac.:</b>
                    <input type="text" name="fechan" value="<?php echo date("Y-m-d");?>" class="cajas" size="10" maxlenght="10" /></td>
                  </tr>
                  <?
                  $conH="select detallehijo.* from detallehijo,detallempleado where detallempleado.cedemple='$cedula' and detallempleado.cedemple=detallehijo.cedemple order by detallehijo.tipo";
		  $resuH=mysql_query($conH)or die ("Error al buscar datos del empleado");
		  $regH=mysql_num_rows($resuH);
                   ?>
                   <tr><td><br></td></tr>
               <table border="0" align="center" width="550">
                  <tr>
                    <th>#</th>
                    <th>Tipo_Doc.</th>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>F_Nac.</th>
                    <th>Parentezco</th>
                 </tr>
                <? $a=1;
                while ($filas=mysql_fetch_array($resuH)):
                  ?>
                   <tr class="cajas">
                      <th><?echo $a;?></th>
                      <td><font color="red"><?echo $filas["tipo"];?></td>
                      <td><font color="red"><?echo $filas["documento"];?></font></td>
                      <td><font color="red"><?echo $filas["nombre"];?></td>
                      <td><font color="red"><?echo $filas["fechanac"];?></td>
                      <td><font color="red"><?echo $filas["parentezco"];?></td>
                   </tr>
                   <?$a=$a+1;
                endwhile;
                  ?>

                <tr><td><br></td></tr>
              <tr>
                 <td colspan="5">
                  <input type="submit" value="Guardar Dato" class="boton"></td>
                </tr>
          </table>
         </form>
         <div align="center"><h5><u><font color="red"><a href="agregardetalle.php">Volver</a></font></u></h5></div>
         <?
      endwhile;
     else:
       ?>
        <script language="javascript">
           alert("Este empleado ya tiene la documentacion en sistema.")
           history.back()
        </script>
     <?
     endif;
   endif;
endif;
 ?>
</body>
</html>
