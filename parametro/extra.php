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
                         document.getElementById("matgene").submit();

                    }
                </script>
<?
if (!isset($codigo)):
  ?>
    <center><h5>Cambio de Horas Extras</h5></center>
    <form action="" method="post" id="matgene">
      <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr>
          <td><b>Cod_Compensación:</b></td>
          <td><input type="text" name="codigo" size="10" maxlength="10" onFocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo"></td>
        </tr>
        <tr><td><br></td></tr>
        <td colspan="5">
          <input type="button" value="Buscar" class="boton" Onclick="chequearcampos()"></td>
      </table>
    </form>
  <?
else:
  include("../conexion.php");
  $con="select salario.codsala,salario.desala from salario where salario.codsala='$codigo'";
  $re=mysql_query($con)or die("Error de Busqueda en el Codigo");
  $reg=mysql_num_rows($re);
  if($reg==0):
    ?>
     <script language="javascript">
       alert("No existe este Codigo en el Sistema ?")
       open("extra.php","_self")
     </script>
    <?
  else:
    while($filas=mysql_fetch_array($re)):
       ?>
       <center><h4>Cambio de Aporte, Eps y Pensión</h4></center>
       <form action="grabarextra.php" method="post">
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
?>

</body>

</html>
