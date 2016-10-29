<html>

<head>
  <title>Tipo recibos</title>
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
                            alert ("Digite la descripción del tipo de Recibo.!");
                            document.getElementById("descripcion").focus();
                            return;
                        }
                         document.getElementById("matcom").submit();

                    }
                </script>
</head>
<body>
<?if(!isset($descripcion)):
  ?>
  <div align="center"><h4><u>Tipo de Recibos</u></h4></div>
  <form action="" method="post" id="matcom">
    <table border="0" align="center">
      <tr><td><br></td></tr>
      <tr>
         <td><b>Descripción:</b></td>
         <td><input type="text" name="descripcion" class="cajas" size="40" maxlength="38" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="descripcion">&nbsp;</td>
      </tr>
      <tr>
         <td><b>Cuenta_Contable:</b></td>
         <td><input type="text" name="CtaC" class="cajas" size="13" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CtaC">&nbsp;</td>
      </tr>
       <tr>
         <td><b>Porcentaje:</b></td>
         <td><input type="text" name="PorR" class="cajas" size="6" maxlength="5" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="PorR">&nbsp;</td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
        <td colspan="3">
          <input type="button" value="Enviar dato" class="boton" onclick="chequearcampos()">
        </td>
       </tr>
    </table>
  </form>
  <?
else:
  include("../conexion.php");
    $descripcion=strtoupper($descripcion);
    $ingreso="insert into tiporecibo(descripcion,cuenta,porcentaje)
       values('$descripcion','$CtaC','$PorR')";
     $resu=mysql_query($ingreso)or die ("Error al grabar datos del tipo de comprobante");
    $re = mysql_affected_rows();
     if($re != 0 ):
       ?>
       <script language="javascript">
         alert("Datos Grabados con Exito, en la base de datos ?")
         open("AgregarTipo.php","_self")
       </script>
       <?
     else:
       ?>
       <script language="javascript">
         alert("Error al grabar, en la base de datos ?")
         open("AgregarTipo.php","_self")
       </script>
       <?
     endif;
endif;
?>

</body>

</html>
