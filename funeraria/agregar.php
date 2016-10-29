<html>

<head>
  <title>AGregar Beneficiarios</title>
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
                        if (document.getElementById("documento").value.length <=0)
                        {
                            alert ("Digite el ducumento del Beneficiario");
                            document.getElementById("documento").focus();
                            return;
                        }
                        if (document.getElementById("nombres").value.length <=0)
                        {
                            alert ("Digite el nombre del beneficiario?");
                            document.getElementById("nombres").focus();
                            return;
                        }
                        if (document.getElementById("parentezco").value.length <=0)
                        {
                            alert ("Digite el parentezco del beneficiario ?");
                            document.getElementById("parentezco").focus();
                            return;
                        }
                         document.getElementById("matfune").submit();

                    }
                </script>
</head>
<body>
<?
if (!isset($documento)):
  include("../conexion.php");
?>
<center><h4>Ingreso de Beneficiario_Funeraria</h4></center>
  <form action="" method="post"id="matfune">
    <table border="0" align="center">
      <tr>
        <td colspan="9"></td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
        <td><b>Tipo de Id.:</b></td>
        <td><select name="tipo" class="cajas">
          <option value="rc">RC
          <option value="ti">TI
          <option value="cc">CC
          <option value="ce">CE
          <option value="nuit">NUIT
        </select></td>

        </tr>
        <tr>
        <td><b>Documento:</b></td>
        <td><input type="text" name="documento" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="documento" class="cajas"></td>
        </tr>
         <tr>
        <td><b>Nombres:</b></td>
        <td><input type="text" name="nombres" value="" size="50" maxlength="50"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombres" class="cajas"></td>
        </tr>
        <td><b>Parentezco:</b></td>
        <td><input type="text" name="parentezco" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="parentezco" class="cajas"></td>
        </tr>
         <tr>
        <td><b>Empleado:</b></td>
          <td>
          <select name="empleado" class="cajas">
          <option value="0">Seleccione un Empleado
          <?
            $consulta_e="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato
             where empleado.codemple=contrato.codemple and
             contrato.fechater='0000-00-00' order by empleado.nomemple,empleado.nomemple1";
            $resultado_e=mysql_query($consulta_e)or die ("Consulta  incorrecta");
            while($filas_e=mysql_fetch_array($resultado_e)):
              ?>
              <option value="<?echo $filas_e["cedemple"];?>"><?echo $filas_e["nomemple"];?>&nbsp;<?echo $filas_e["nomemple1"];?>&nbsp;<?echo $filas_e["apemple"];?>&nbsp;<?echo $filas_e["apemple1"];?>
              <?
              endwhile;
        ?></select></td>
      </tr>
       <td><b>Fecha_Ingreso:</b></td>
        <td><input type="text" name="fecha" value="<?echo date("Y-m-d");?>" size="15" maxlength="15" readonly class="cajas"></td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
          <td colspan="2">
            <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">
            <input type="reset" value="Limpiar" class="boton">
           </td>
         </tr>
   </table>

   </form>
   <?
              else:
                include("../conexion.php");
                $consulta="select * from funeraria where documento='$documento'";
                $resultado=mysql_query($consulta)or die("consulta incorrecta");
                $registro=mysql_num_rows($resultado);
                if ($registro==0):
                  $tipo=strtoupper($tipo);
                  $nombres=strtoupper($nombres);
                  $parentezco=strtoupper($parentezco);
                  $consulta="insert into funeraria(tipo,documento,nombres,parentezco,cedemple,fecha)
                        values('$tipo','$documento','$nombres','$parentezco','$empleado','$fecha')";
                   $resultado=mysql_query($consulta)or die ("Insercción incorrecta");
                   ?>
                   <script language="javascript">
                     alert("Registro almacenado Correctamente")
                     open("agregar.php","_self")
                   </script>
                 <?
                 else:
                    ?>
                   <script language="javascript">
                     alert("El Registro Ya existe en la bd.")
                     history.back()
                   </script>
                 <?
                endif;
   endif;
   ?>
</body>
</html>
