<?
 session_start();
?>
<html>
        <head>
                <title>Listado de Zonas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4><u>Zona por Filtro</u></h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="codigo">Cod_Zona
                                                        <option value="zona">Zona
                                                </select></td>
                                        <td><input type="text" name="valor" value="" size="40" maxlength="40"></td>
                                </tr>
                                <tr>
                                        <td colspan="2"><input type="submit" value="Buscar" class="boton"><input type="reset" value="Limpiar"class="boton"></th>
                                </tr>
                        </table>
                </form>
        <?

     if(session_is_registered("xsession")):
                include("../conexion.php");
                if (empty($valor))
                {
                        $consulta="select detalladozona.codzona,detalladozona.zona,detalladozona.codigo,detalladozona.rl from detalladozona,zona
                        where zona.codzona=detalladozona.codzona and
                        zona.estado='ACTIVA' order by detalladozona.zona";
                }
                elseif ($campo=='codigo')
                {
                        $consulta="select detalladozona.codzona,detalladozona.zona,detalladozona.codigo,detalladozona.rl from detalladozona,zona
                        where zona.codzona=detalladozona.codzona and zona.codzona = '$valor'";
                }
                else
                {
                        $consulta="select detalladozona.codzona,detalladozona.zona,detalladozona.codigo,detalladozona.rl from detalladozona,zona
                        where zona.codzona=detalladozona.codzona and detalladozona.zona like '%$valor%' order by detalladozona.zona";
                }
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
                            <td><div align="center"><a href="editardetallado.php"><h4><u><font color="blue">Actualizar</font></u></h4></a></div></td>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                                <th>Item</th>
                                                <th>Código</th>
                                                <th>Cod_Zona</th>
                                                <th>Zona</th>
                                                <th>R_Lega</th>

                                </tr>
        <?
        $a=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><?echo $a;?></th>
                                         <td><a href="editar.php?Nro=<?echo $filas["codigo"];?>"><div align="center"><?echo $filas["codigo"];?></div></a></td>
                                          <td><?echo $filas["codzona"];?></td>
                                        <td><?echo $filas["zona"];?></td>
                                        <td><?echo $filas["rl"];?></td>
                                </tr>
        <?
                        $a=$a+1;
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
                        </table>
                        

        </body>
</html>
