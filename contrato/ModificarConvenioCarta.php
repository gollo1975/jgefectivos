<html>

<head>
  <title>Modificar Convenio-Carta</title>
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
                         if (document.getElementById("cedula").value == 0)
                        {
                            alert ("El campo Documento de identidad, no puede ser Vacío");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matlibra").submit();
                     }
                     function valide()
                      {
                         if (document.getElementById("cliente").value == 0)
                        {
                            alert ("Digite el nombre del empleado?");
                            document.getElementById("cliente").focus();
                            return;
                        }
                         document.getElementById("matcon").submit();
                     }
   </script>
</head>

<body>

<?
if (!isset($cedula)):
?>
<center><h4><u>Editar Contrato Laboral</u></h4></center>
  <form  action="" method="post" id="matlibra">
   <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
    <input type="hidden" name="codigo" value="<? echo $codigo;?>" id="codigo">
    <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
        <td><b>Documento de Identidad:&nbsp;</b></td>
         <td><input type="text" name="cedula" size="15" maxlength="12" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
              <tr><td><br></td></tr>
    <tr>
         <td colspan="2">
           <input type="button" value="Buscar" class="boton" onclick="chequearcampos()">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>

    </table>
    <br>
 </form>
  <?
else:
     include("../conexion.php");
      $con1="select convenio.* from convenio where convenio.cedemple='$cedula' order by nroconvenio DESC";
      $resu1=mysql_query($con1)or die("Error en la busqueda de convenios");
      $reg1=mysql_affected_rows();
      if($reg1!=0):
          ?>
           <center><h4><u>Contratos</u></h4></center>
           <table border="0" align="center">
              <center><h5><td class="cajas">Para Modificar el contrato presiones Click en el campo [Nro_Contrato]</td></center></h5>
           </table>
             <table border="0" align="center">
                <tr class="cajas">
                  <th>Item</th>
                  <th>Nro_Contrato</th>
                  <th>Documento</th>
                  <th>Empleado</th>
                   <th>Salario</th>
                  <th>Tipo_Contrato</th>
                  <th>Zona</th>
                  <th>F_Proceso</th>
                </tr>
               <?
                $i=1;
                while($filas=mysql_fetch_array($resu1)):
                   ?>
                   <tr class="cajas">
                      <th><?echo $i;?></th>
                      <td><a href="detalladoconvenio.php?nro=<?echo $filas["nroconvenio"];?>&TipoContrato=<?echo $filas["tipocontrato"];?>&UsuarioPreparador=<?echo $UsuarioPreparador;?>&codigo=<?echo $codigo;?>"><?echo $filas["nroconvenio"];?></a></td>
                      <td><?echo $filas["cedemple"];?></td>
                      <td><?echo $filas["nombres"];?></td>
                      <td><div align="right"><?echo $filas["salario"];?></div></td>
     		      <td><?echo $filas["tipo"];?></td>
                      <td><?echo $filas["zona"];?></td>
                      <td><?echo $filas["fechac"];?></td>
                   </tr>
                   <?
                   $i +=1;
                endwhile;
               ?>
             </table>
          <?
     else:
      ?>
      <script language="javascript">
        alert("No hay contratos firmados con este documento  ?")
        history.back()
      </script>
      <?
     endif;
 endif;
?>

</body>

</html>
