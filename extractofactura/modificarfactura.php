<html>
        <head>
                <title>Modificacion Factura</title>
                <link rel="stylesheet" href="../formato.css" type="text/css">
                
        </head>
        <body>
  <input type="hidden" value="<?echo $nrofactura;?>" name="nrofactura">
  <input type="hidden" value="<?echo $codex;?>" name="codex">
        <?
                if (!isset($servicio))
                {
                        include("../conexion.php");
                        $consulta="select dextracto.*,extracto.nrofactura from dextracto,extracto where dextracto.conse='$conse' and dextracto.autoriza=extracto.autoriza";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
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
                                                <th colspan="5">Modificacion de Factura</th>
                                             </tr>
                                             <tr>
                                                <tr>
                                        <td>Descripción:</td>
                                        <td>Porcentaje:</td>
                                        <td>Valor:</td>

                                </tr>
        <?
                        while ($filas=mysql_fetch_array($resultado))
                                                {
        ?>
                              <input type="hidden" value="<?echo $filas["nrofactura"];?>" name="nrofactura">
                            <input type="hidden" value="<?echo $filas["autoriza"];?>" name="codex">
                              <tr>
                                        <td>&nbsp;    <select name="servicio" class="cajas">
                                                        <?
                                                                $consulta_s="select * from listado";
                                                                $resultado_s=mysql_query($consulta_s) or die("consulta incorrecta");
                                                                while ($filas_s=mysql_fetch_array($resultado_s))
                                                                {
                                                                        if ($cod==$filas_s["codcomp"])
                                                                        {
                                                        ?>
                                                                                <option value="<?echo $filas_s["codcomp"];?>" selected><?echo $filas_s["concepto"];?>
                                                        <?
                                                                        }
                                                                        else
                                                                        {

                                                        ?>
                                                                        <option value="<?echo $filas_s["codcomp"];?>"><?echo $filas_s["concepto"];?>
                                                        <?
                                                                        }
                                                                }
                                                        ?>
                                                        </select></td>
                                        <td>&nbsp;<input type="text" name="porcentaje" value="<?echo $filas["porcentaje"];?>" size="10" maxlength="10">
                                        <td>&nbsp;<input type="text" name="valor" value="<?echo $filas["valor"];?>" size="10" maxlength="10">
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
                        elseif(empty($valor))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite el valor ")
                                        history.back()
                                </script>
                <?
                        }
                         else
                        {
                                include("../conexion.php");
                                $consulta="update dextracto set codcomp='$servicio',porcentaje='$porcentaje',valor='$valor' where conse='$conse'";
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
                                        header("location: agregar.php?nro=$nrofactura&codex=$codex");
                                }
                        }
?>

        </body>
</html>
