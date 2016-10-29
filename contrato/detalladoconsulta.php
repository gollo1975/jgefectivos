<?
 session_start();
?>
<html>
<head>
<title>Modificacion de contrato</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

<?
 if(session_is_registered("validar")):
   include("../conexion.php");
    $consulta="select contrato.*,empleado.cedemple,empleado.apemple,empleado.nomemple,tipocontrato.concepto from empleado,contrato,tipocontrato
     where empleado.codemple=contrato.codemple
     and contrato.tipo=tipocontrato.tipo
     and contrato.contrato='$contrato'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
     while($filas=mysql_fetch_array($resultado)):
     $aux=$filas["salario"];
      $aux1=number_format($aux,2);
       ?>
       <center><h4>Datos del Contrato</h4></center>
         <form action="" method="post" id="concontra">
           <table border="0" align="center">
             <tr>
               <td colspan="2"></td>
             </tr>
             <tr>
               <td><b>Nro_contrato:</b></td>
               <td><input type="text" value="<?echo $filas["contrato"];?>" size="13" class="cajas" readonly></td>
             </tr>
             <tr>
               <td><b>Documento:</b></td>
                <td><input type="text" value="<?echo $filas["cedemple"];?>" size="13" class="cajas" readonly></td>
             </tr>
             <tr>
                <td><b>Empleado:</b></td>
                <td><input type="text" value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["apemple"];?>" size="45" class="cajas" readonly></td>
             </tr>
             <tr>
               <td><b>Fecha_Inicio:</b></td>
               <td><input type="text" value="<?echo $filas["fechainic"];?>"size="10" class="cajas" maxlength="10" readonly></td>
             </tr>
              <tr>
               <td><b>Fecha_Ter:</b></td>
               <td><input type="text" value="<?echo $filas["fechater"];?>" size="10" class="cajas" maxlength="10" readonly></td>
             </tr>
              <tr>
               <td><b>Salario:</b></td>
               <td><input type="text" value="<?echo $aux1;?>" size="10" maxlength="10" class="cajas" readonly></td>
             </tr>
              <tr>
               <td><b>Tipo_Contrato:</b></td>
                  <td><input type="text" value="<?echo $filas["concepto"];?>" size="30" class="cajas" readonly></td>
              <tr>
              <tr>
               <td><b>Cargo:</b></td>
               <td><input type="text" value="<?echo $filas["cargo"];?>" name="cargo"size="30" class="cajas" readonly></td>
             </tr>
             <tr>
               <td><b>Nota:</b></td>
               <td><textarea name="nota" cols="50" rows="5"class="cajas" readonly><?echo $filas["nota"];?> </textarea></td>
             </tr>

            <?
            endwhile;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
     ?>
     </table>
     </form>
</body>
</html>
