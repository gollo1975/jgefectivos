<html>

<head>
  <title>Modificar datos</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
   <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#73EABD"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function chequearcampos()
                    {
                        if (document.getElementById("descripcion").value.length <=0)
                        {
                            alert ("Digite la descripción del Comprobante contable ?");
                            document.getElementById("descripcion").focus();
                            return;
                        }
                         document.getElementById("matcom").submit();

                    }
                </script>
</head>
<body>
<?
include("../conexion.php");
$con="select tiporecibo .descripcion,tiporecibo.idrecibo,tiporecibo.porcentaje from tiporecibo where tiporecibo.idrecibo='$codigo'";
$reg=mysql_query($con)or die ("Error al buscar datos contables");
$filas=mysql_fetch_array($reg);
  ?>
  <div align="center"><h4><u>Tipo de Recibo</u></h5></div>
  <form action="GrabarTipo.php" method="post" id="matcom">
    <table border="0" align="center">
      <tr><td><br></td></tr>
      <tr>
         <td><b>Id_Recibo:</b></td>
         <td><input type="text" class="cajas" name="Id"value="<? echo $codigo;?>" size="10" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Id">&nbsp;</td>
      </tr>
      <tr>
         <td><b>Descripción:</b></td>
         <td><input type="text" name="descripcion" value="<?echo $filas["descripcion"];?>" class="cajas" size="40" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="descripcion">&nbsp;</td>
      </tr>
       <tr>
         <td><b>Porcentaje:</b></td>
         <td><input type="text" name="PorT" value="<?echo $filas["porcentaje"];?>" class="cajas" size="6" maxlength="5" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="PorT">&nbsp;</td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
        <td colspan="3">
          <input type="button" value="Enviar dato" class="boton" onclick="chequearcampos()">
        </td>
       </tr>
    </table>
  </form>
</body>
</html>
