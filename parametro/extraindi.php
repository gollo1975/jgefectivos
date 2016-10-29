<html>
<head>
  <title>Parametros de Novedades</title>
  <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
</head>
<body>
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
                        if (document.getElementById("codigo").value.length <=0)
                        {
                            alert ("El campo Codigo de compensación no puede ser vacío ?");
                            document.getElementById("codigo").focus();
                            return;
                        }
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("El campo Documento del Empleado no puede ser vacío ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matgene").submit();

                    }
                </script>
<?
if (!isset($codigo)):
  ?>
    <center><h5>Cambio Horas Extras [Individual]</h5></center>
    <form action="" method="post" id="matgene">
      <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr>
          <td><b>Cod_Compensación:</b></td>
          <td><input type="text" name="codigo" size="10" maxlength="10" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo"></td>
        </tr>
        <tr>
          <td><b>Documento de Identidad:</b></td>
          <td><input type="text" name="cedula" size="13" maxlength="13" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
        </tr>
        <tr><td><br></td></tr>
        <td colspan="5">
          <input type="button" value="Buscar" class="boton" Onclick="chequearcampos()"></td>
      </table>
    </form>
  <?
else:
  include("../conexion.php");
  $con="select empleado.cedemple,empleado.nomemple,empleado.apemple from empleado,contrato
    where empleado.codemple=contrato.codemple and
    contrato.fechater='0000-00-00' and
    empleado.cedemple='$cedula'";
  $re=mysql_query($con)or die("Error de Busqueda en el Contrato");
  $reg=mysql_num_rows($re);
  $filas_e=mysql_fetch_array($re);
  $nombre=$filas_e["nomemple"];
  $apellido=$filas_e["apemple"];
  if($reg==0):
    ?>
     <script language="javascript">
       alert("El documento digitado no existe o  El contrato esta Retirado ?")
       open("extraindi","_self")
     </script>
    <?
  else:
    $con="select salario.codsala,salario.desala from salario where salario.codsala='$codigo'";
    $re=mysql_query($con)or die("Error de Busqueda en el Codigo");
    $reg=mysql_num_rows($re);
    if ($reg==0):
      ?>
       <script language="javascript">
         alert("El codigo No existe en Sistema ?")
         history.back()
       </script>
      <?
     else:
      while($filas=mysql_fetch_array($re)):
                ?>
               <center><h5>Cambio Horas Extras [Individual]</h5></center>
               <form action="grabarextraindi.php" method="post" id="matgene">
               <td><input type="hidden" name="cedula" value="<? echo $cedula;?>"></td>
               <table border="0" align="center">
                <tr><td><br></td></tr>
                <tr>
                  <td><b>Cod_Compensación:</b></td>
                  <td><input type="text" name="codigo" value="<? echo $filas["codsala"];?>" size="10" maxlength="10" class="cajas" readonly onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo"></td>
                </tr>
                <tr>
                  <td><b>Concepto:</b></td>
                  <td><input type="text" name="concepto" value="<? echo $filas["desala"];?>" size="35" class="cajas"  readonly onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="concepto"></td>
                </tr>
                <tr>
                  <td><b>Documento:</b></td>
                  <td><input type="text" name="cedemple" value="<? echo $cedula;?>" size="13" readonly class="cajas" readonly onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
                </tr>
                <tr>
                  <td><b>Empleado:</b></td>
                  <td><input type="text" value="<? echo $nombre;?>&nbsp;<? echo $apellido;?>" size="45" readonly class="cajas" readonly onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="empleado"></td>
                </tr>
                <tr>
                  <td><b>Vlr_Cambio:</b></td>
                  <td><input type="text" name="valor" value="" size="10" maxlength="20" class="cajas" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
                </tr>
                 <tr><td><br></td></tr>
                 <td colspan="5">
                  <input type="submit" value="Procesar" class="boton"></td>
               </table>
              </form>
               <?
            endwhile;
        endif;    
  endif;
endif;
?>

</body>

</html>
