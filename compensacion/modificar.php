<?
 session_start();
?>
<html>
        <head>
                <title>Modificacion de Item del crédito</title>
                <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
        </head>
        <body>
        <?
        if(session_is_registered("validar")):
                if (!isset($dato))
                {
        ?>
                        <center><h5>Modificar Cuenta</h5></center>
                        <form action="" method="post">
                                <table border="0" align="center" width=30%>
                                        <tr>
                                                <td colspan="2"><br></td>
                                        </tr>
                                        <tr>
                                                <td><b>Nro de Cuenta:</b></td>
                                                <td><input type="text" name="dato" value="" size="20" maxleng="10"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td colspan="2"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                                </table>
                        </form>
        <?
                }
                elseif (empty($dato))
                {
        ?>
                        <script language="javascript">
                                alert("Digite un Valor a Buscar")
                                history.back()
                        </script>
        <?
                }
                else
                {
                        include("../conexion.php");
                        $consulta="select * from item where codcom='$dato'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("No Existen Registros en la busqueda")
                                        history.back()
                                </script>
        <?
                        }
                        else
                        {
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                        <center><h3>Datos a Modificar</h3></center>
                                        <form action="guardar.php" method="post">
                                                <table border="0" align="center">
                                                        <tr>
                                                                <td colspan="2"><br></th>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Nro de Cuenta:</b></td>
                                                                <td><input type="text" name="codcom" value="<?echo $filas["codcom"];?>" class="cajas" readonly></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Descripcion:</b></td>
                                                                <td><input type="text" name="concepto" value="<?echo $filas["concepto"];?>" class="cajas" size="50" maxlength="50"></td>
                                                        </tr>
                                                        <tr><td><br></td></tr>
                                                       <tr>
                                                                  <td colspan="2"><input type="submit" value="Guardar" class="boton"></th>
                                                        </tr>
        <?
                                }
                        }
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
                                </form>
                </table>
        </body>
</html>
