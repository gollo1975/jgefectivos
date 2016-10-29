<html>

<head>
  <title></title>
  <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
</head>

<body>
<?
 include("../conexion.php");
 	$consulta = "select contrato.contrato, carpeta.*, contrato.fechainic, contrato.fechater
from carpeta inner join contrato on carpeta.codemple = contrato.codemple
where carpeta.nroentrega='$nroentrega' and contrato.contrato = (select max(contrato) from contrato where carpeta.codemple = contrato.codemple)";
 
 	/*$consulta = "select carpeta.*, contrato.fechainic, contrato.fechater from carpeta inner join contrato on carpeta.codemple = contrato.codemple where carpeta.nroentrega='$nroentrega'";*/
    //$consulta="select carpeta.* from carpeta where nroentrega='$nroentrega'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
     while($filas=mysql_fetch_array($resultado)):
       ?>
       <center><h4>Devolución Carpetas</h4></center>
         <form action="grabarModificado.php" method="post">
           <table border="0" align="center">
             <tr><td width="166"></td></tr>
             <tr>
               <td><b>Nro_Entrega:</b></td>
               <td width="330"><input type="text" value="<?echo $filas["nroentrega"];?>" name="nroentrega" size="7" class="cajas" readonly></td>
             </tr>
             <tr>
              <td><b>Código:</b></td>
               <td><input type="text" value="<?echo $filas["codemple"];?>"name="codigo" size="7" class="cajas" maxlength="7" readonly></td>
             </tr>
             <tr>
              <td><b>Documento:</b></td>
               <td><input type="text" value="<?echo $filas["cedemple"];?>"name="cedula" size="15" class="cajas" maxlength="15" readonly></td>
             </tr>
              <td><b>Empleado:</b></td>
               <td><input type="text" value="<?echo $filas["empleado"];?>"name="empleado" size="51" class="cajas" maxlength="51" readonly></td>
             </tr>
              <tr>
                <td><strong>Fecha Inicio:</strong></td>
                <td><input name="fechainic" type="text" class="cajas" id="fechainic" value="<?echo $filas["fechainic"];?>" size="15" maxlength="15" readonly></td>
              </tr>
              <tr>
                <td><strong>Fecha Terminaci&oacute;n:</strong></td>
                <td><input name="fechater" type="text" class="cajas" id="fechater" value="<?echo $filas["fechater"];?>" size="15" maxlength="15" readonly></td>
              </tr>
              <td><b>Zona:</b></td>
               <td><input type="text" value="<?echo $filas["zona"];?>"name="zona" size="51" class="cajas" maxlength="51" readonly></td>
             </tr>
             <td><b>Responsable:</b></td>
               <td><input type="text" value="<?echo $filas["responsable"];?>"name="responsable" size="51" class="cajas" maxlength="51"></td>
             </tr>
             <tr>
                 <td><b>Motivo:</b></td>
                 <td colspan="9"><textarea name="motivo" cols="55" rows="4" class="cajas"><?echo $filas["motivo"];?></textarea></td></tr>
             <tr>
              <tr><td><br></td></tr>
             <tr>
               <td colspan="2">
                 <input type="submit" value="Guardar" class="boton">
                 <input type="reset" value="Limpiar"class="boton">               </td>
              </tr>
            <?
            endwhile;
      ?>
     </table>
     </form>
</body>
</html>
</body>

</html>
