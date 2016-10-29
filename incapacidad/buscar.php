<html>
        <head>
                <title>Listado de Incapacidades</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Consulta de Filtro</h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="nroinca">Nro_Incapacidad
                                                        <option value="documento">Documento
                                                </select></td>
                                        <td><input type="text" name="valor" value="" size="40" maxlength="40"></td>
                                </tr>
                                <tr>
                                        <td colspan="2"><input type="submit" value="Buscar" class="boton"><input type="reset" value="Limpiar"class="boton"></th>
                                </tr>
                        </table>
                </form>
        <?

                include("../conexion.php");
                if (empty($valor))
                {
                        $consulta="select incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,incapacidad.estado,tipoinca.concepto,empleado.nomemple,empleado.apemple,incapacidad.cedemple,eps.eps
                                from incapacidad,empleado,tipoinca,eps
                                 where empleado.cedemple=incapacidad.cedemple and
                                 eps.codeps=incapacidad.codeps and
                                 tipoinca.tipoinca=incapacidad.tipoinca and
                                 incapacidad.estado='POR COBRAR'";
                }
                elseif ($campo=='nroinca')
                {
                        $consulta="select incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,incapacidad.estado,tipoinca.concepto,empleado.nomemple,empleado.apemple,incapacidad.cedemple,eps.eps from eps,incapacidad,empleado,tipoinca
                                 where empleado.cedemple=incapacidad.cedemple and
                                 eps.codeps=incapacidad.codeps and
                                 tipoinca.tipoinca=incapacidad.tipoinca and
                                 incapacidad.estado='POR COBRAR' and
                                 incapacidad.nroinca= '$valor'";
                }
                else
                {
                        $consulta="select incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,incapacidad.estado,tipoinca.concepto,empleado.nomemple,empleado.apemple,incapacidad.cedemple,eps.eps from eps,incapacidad,empleado,tipoinca
                                 where empleado.cedemple=incapacidad.cedemple and
                                 eps.codeps=incapacidad.codeps and
                                 tipoinca.tipoinca=incapacidad.tipoinca and
                                 incapacidad.estado='POR COBRAR' and
                                 incapacidad.cedemple='$valor'";
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
                           <center><h4>Listado de Incapacidades En Cartera</h4></center>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                 <th>&nbsp;</th>
                                                 <th>&nbsp;</th>
                                                <th>&nbsp;</th>  <td><a href="buscar.php"><b>Actualizar</b></a></td>
                                </tr>
                                <tr>
                                        <th>&nbsp;</th> 
                                        <td><b>Nro_Incapacidad</b></td>
                                        <td><b>Asociado</b></td>
                                        <td><b>Fecha_Ini.</b></td>
                                        <td><b>Fecha_Term.</td>
                                        <td><b>Dias</b></td>
                                         <td><b>Eps</b></td>
                                        <td><b>Descripción</b></td>
                                        <td><b>Estado</b></td>
                                </tr>
        <?
        $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                        <tr class="cajas">
                                        <td>&nbsp;<?echo $i;?></td>
                                        <td>&nbsp;<?echo $filas["nroinca"];?></td>
                                        <td>&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["apemple"];?></td>
                                        <td>&nbsp;<?echo $filas["fechaini"];?></td>
                                        <td>&nbsp;<?echo $filas["fechater"];?></td>
                                        <td>&nbsp;<?echo $filas["dias"];?></td>
                                        <td>&nbsp;<?echo $filas["eps"];?></td>
                                        <td>&nbsp;<?echo $filas["concepto"];?></td>
                                        <td>&nbsp;<?echo $filas["estado"];?></td>

                                </tr>
        <?
        $i=$i+1;
                        }
                }


?>
                        </table>
                        

        </body>
</html>
