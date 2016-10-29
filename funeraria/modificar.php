<html>

<head>
<title>Mofidificacion de Beneficiarios</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($valor)):
?>
<center><h4>Consulta de Beneficiarios</h4></center>
  <form action="" method="post">
    <table border="0" align="center">
       <tr>
         <td colspan="2"></td>
      </tr>
      <tr><td><br></td></tr>
       <tr>
           <td><b>Digite el Documento:</b></td>
           <td><input type="text" name="valor" value="" size="15" maxlength="15" class="cajas"></td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
         <td colspan="2"><input type="submit" value="Buscar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></td>
        </tr>
    </table>

  </form>
  <?
  elseif(empty($valor)):
   ?>
     <script language="javascript">
       alert("Digite el valor a consultar")
       history.back()
     </script>
   <?
    else:
      include("../conexion.php");
      $consulta="select funeraria.tipo,funeraria.documento,funeraria.nombres,funeraria.parentezco,funeraria.cedemple from funeraria
              where funeraria.documento='$valor'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
          ?>
          <script language="javascript">
           alert("NO existen registro en la consulta ?")
           history.back()
          </script>
        <?
       else:
          while($filas=mysql_fetch_array($resultado)):
          ?>
          <center><h4>Datos a Modificar</h4></center>
          <form action="guardar.php" method="post">
              <table border="0" align="center">
                <tr>
                   <td colspan="9"></td>
                </tr>
                <tr>
                  <td class="cajas"><b>Tipo_Docu.:</b></td>
                  <td><select name="tipo"class="cajas">
                     <option value="<?echo $filas["tipo"];?>"selected><?echo $filas["tipo"];?>
                    <option value="rc">RC
                    <option value="ti">TI
                    <option value="cc">CC
                    <option value="ce">CE
                    <option value="nuit">NUIT
                  </select></td>
                     </tr>
                     <tr>
                       <td><b>Documento:</b></td>
                      <td><input type="text" name="documento" value="<?echo $filas["documento"];?>" size="15" maxlength="15" readonly class="cajas"></td>
                    </tr>
                    <tr>
                       <td><b>Nombre:</b></td>
                       <td><input type="text" name="nombres" value="<?echo $filas["nombres"];?>" size="50" maxlength="50" class="cajas"></td>
                    </tr>
                    <tr>
                      <td><b>Parentezco:</b></td>
                       <td><input type="text" name="parentezco" value="<?echo $filas["parentezco"];?>" size="15" maxlength="15"class="cajas"></td>
                    </tr>
                    <tr>
                    <td><b>Empleado:</b></td>
                     <td><select name="empleado" class="cajas">
                  <?
                  $auxem=$filas["cedemple"];
                  $consulta_t="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato
                      where empleado.codemple=contrato.codemple and
                      contrato.fechater='0000-00-00' order by empleado.nomemple,empleado.nomemple1";
                    $resultado_t=mysql_query($consulta_t) or die("consulta Incorrecta 2");
                       while ($filas_t=mysql_fetch_array($resultado_t))
                        {
                          if ($auxem==$filas_t["cedemple"]):
                           ?>
                           <option value="<?echo $filas_t["cedemple"];?>"selected><?echo $filas_t["nomemple"];?>&nbsp;<?echo $filas_t["nomemple1"];?>&nbsp;<?echo $filas_t["apemple"];?>&nbsp;<?echo $filas_t["apemple1"];?>
                           <?
                         else:
                           ?>
                           <option value="<?echo $filas_t["cedemple"];?>"><?echo $filas_t["nomemple"];?>&nbsp;<?echo $filas_t["nomemple1"];?>&nbsp;<?echo $filas_t["apemple"];?>&nbsp;<?echo $filas_t["apemple1"];?>
                           <?
                         endif;
                       }
                       ?>
                       </select></td>
                     </tr>
                     <tr><td><br></td></tr>
                     <tr>
                       <td colspan="2"><input type="submit" Value="Guardar" class="boton"></td>
                    </tr>
                  </table>
                </form>
                  <?
             endwhile;
       endif;
     endif;
  ?>
</body>
</html>
