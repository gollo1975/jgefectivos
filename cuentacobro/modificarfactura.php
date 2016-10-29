<html>
        <head>
                <title>Modificacion de Cuenta de Cobro</title>
                <link rel="stylesheet" href="../formato.css" type="text/css">

        </head>
        <body>
  <input type="hidden" value="<?echo $nit;?>" name="nit">
  <input type="hidden" value="<?echo $codex;?>" name="codex">
        <?
                if (!isset($dato))
                {
                        include("../conexion.php");
                        $consulta="select decuenta.*,cuenta.nit from decuenta,cuenta where decuenta.codigo='$codigo' and decuenta.nrocuenta=cuenta.nrocuenta";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta 1");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("No Existen Registros")
                                        history.back()
                                </script>
        <?
                        }
                        else
                        {
        ?>
                                <form action="" method="post">
                                  <table border="1" align="center">
                                             <tr class="fondo">
                                                <th colspan="5">Modificacion de Cuenta de Cobro</th>
                                             </tr>
                                             <tr>
                                                <tr>
                                        <td>Servicio:</td>
                                        <td>Cantidad:</td>
                                        <td>Vlr_Unitario:</td>
                                        <td>Descuento:</td>
                                        <td>Subtotal</td>

                                </tr>
        <?
                        while ($filas=mysql_fetch_array($resultado))
                                                {
        ?>
                              <input type="hidden" value="<?echo $filas["nit"];?>" name="nit">
                            <input type="hidden" value="<?echo $filas["nrocuenta"];?>" name="codex">
                              <tr>
                                        <td>&nbsp;    <select name="dato" class="cajas">
                                                        <?
                                                                $consulta_s="select * from servicio order by descripcion";
                                                                $resultado_s=mysql_query($consulta_s) or die("consulta incorrecta");
                                                                while ($filas_s=mysql_fetch_array($resultado_s))
                                                                {
                                                                        if ($cod==$filas_s["codservi"])
                                                                        {
                                                        ?>
                                                                                <option value="<?echo $filas_s["codservi"];?>" selected><?echo $filas_s["descripcion"];?>
                                                        <?
                                                                        }
                                                                        else
                                                                        {

                                                        ?>
                                                                        <option value="<?echo $filas_s["codservi"];?>"><?echo $filas_s["descripcion"];?>
                                                        <?
                                                                        }
                                                                }
                                                        ?>
                                                        </select></td>
                                        <td>&nbsp;<input type="text" name="cantidad" value="<?echo $filas["cantidad"];?>" size="10" maxlength="10">
                                        <td>&nbsp;<input type="text" name="vlruni" value="<?echo $filas["vlruni"];?>" size="10" maxlength="10">
                                        <td>&nbsp;<input type="text" name="descuento" value="<?echo $filas["descuento"];?>" size="10" maxlength="10">
                                        <td>&nbsp;<input type="text" name="subtotal" value="<?echo $filas["subtotal"];?>" size="10" maxlength="10">
                                        </tr>
                                                <tr>
                                                        <th colspan="5"><input type="submit" value="Guardar"></th>
                                                </tr>

        <?
                                }
                        }

        ?>
                                </table>
                </form>
        <?
                        }
                        elseif(empty($cantidad))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite la cantidad ")
                                        history.back()
                                </script>
                                <?
                        }
                        elseif(empty($subtotal))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite el subtotal ")
                                        history.back()
                                </script>
                <?
                        }
                         else
                        {
                                include("../conexion.php");
                                $consulta="update decuenta set codservi='$dato',cantidad='$cantidad',vlruni='$vlruni',descuento='$descuento',subtotal='$subtotal' where codigo='$codigo'";
                                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                                $registros=mysql_affected_rows();
                                if ($registros==0)
                                {
?>
                                        <script language="javascript">
                                        alert("No se Actualizo el Registro")
                                        history.go(-2)
                                </script>
<?
                                }
                                else
                                {
                                        header("location: agregar.php?nro=$nit&codex=$codex");
                                }
                        }
?>

        </body>
</html>
