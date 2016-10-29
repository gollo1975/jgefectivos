<?
 session_start();
?>
<html>
        <head>
                <title>Agregar Item al Crédito</title>
                <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
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
                        if (document.getElementById("codcom").value.length <=0)
                        {
                            alert ("Digite el Código de facturación");
                            document.getElementById("codcom").focus();
                            return;
                        }
                        if (document.getElementById("concepto").value.length <=0)
                        {
                            alert ("El campo Descripción no puede estar vacío");
                            document.getElementById("concepto").focus();
                            return;
                        }
                          document.getElementById("matcom").submit();
                    }
                </script>
        </head>
        <body>
                <?
                if(session_is_registered("xsession")):
                        if (!isset($codcom))
                        {
                                include("../conexion.php");
                ?>
                <center><h5>Crear Item de Factura</h5></center>
                <form action="" method="post" id="matcom">
                        <table border="0" align="center"
                                <tr>
                                        <td colspan="2"><br></td>
                                  <tr>
                                        <td><b>Cod_Cuenta:</b></td>
                                        <td><input type="text" name="codcom" value="" size="10" mexlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codcom">
                                </tr>
                                 <tr>
                                        <td><b>Descripcion</b></td>
                                        <td><input type="text" name="concepto" value="" size="50" mexlength="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="concepto">
                                </tr>
                                <tr><td><br></td></tr>
                  <tr>
                                                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                        </table>
                </form>
                <?
                        }
                        else
                        {
                               include("../conexion.php");
                               $consulta = "select * from item where item.codcom='$codcom'";
                               $result = mysql_query ($consulta);
                               $sw = mysql_num_rows($result);
                               $concepto=strtoupper($concepto);
                               if ($sw==0):
                                   $consulta1="insert into item (codcom,concepto)
                                        value('$codcom','$concepto')";
                                  $resultado=mysql_query($consulta1) or die("Insercion incorrecta");
                                  $reg=mysql_affected_rows();
                                 ?>
                                    <script language="javascript">
                                          alert("Se Grabó con éxito el registro");
                                          open("agregar.php","_self");
                                        </script>
                <?
                              else:
                                 ?>
                                 <script language="javascript">
                                   alert("Este Código Ya existe en la base de datos ?")
                                    open("agregar.php","_self");
                                 </script>
                                        <?
                              endif;
                        }
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
        </body>
</html>
