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
                        $consulta="select incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,incapacidad.estado,tipoinca.concepto,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 ,incapacidad.cedemple,eps.eps
                                from incapacidad,empleado,tipoinca,eps
                                 where empleado.cedemple=incapacidad.cedemple and
                                 eps.codeps=incapacidad.codeps and
                                 tipoinca.tipoinca=incapacidad.tipoinca and
                                 incapacidad.estado='POR COBRAR'order by eps.eps";
                }
                elseif ($campo=='nroinca')
                {
                        $consulta="select incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,incapacidad.estado,tipoinca.concepto,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 ,incapacidad.cedemple,eps.eps from eps,incapacidad,empleado,tipoinca
                                 where empleado.cedemple=incapacidad.cedemple and
                                 eps.codeps=incapacidad.codeps and
                                 tipoinca.tipoinca=incapacidad.tipoinca and
                                 incapacidad.estado='POR COBRAR' and
                                 incapacidad.nroinca= '$valor' order by eps.eps";
                }
                else
                {
                        $consulta="select incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,incapacidad.estado,tipoinca.concepto,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,incapacidad.cedemple,eps.eps from eps,incapacidad,empleado,tipoinca
                                 where empleado.cedemple=incapacidad.cedemple and
                                 eps.codeps=incapacidad.codeps and
                                 tipoinca.tipoinca=incapacidad.tipoinca and
                                 incapacidad.estado='POR COBRAR' and
                                 incapacidad.cedemple='$valor'order by eps.eps" ;
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
                           <center><h4><u>Incapacidad sin Pago</u></h4></center>
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
                                                 <th>&nbsp;</th>
                                                <th>&nbsp;</th>  <td><a href="listadoincapacidad.php"><b>Actualizar</b></a></td>
                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <td><b>Nro_Incap.</b></td>
                                        <td><b>Documento</b></td>
                                        <td><b>Empleado</b></td>
                                        <td><b>F_Inicio</b></td>
                                        <td><b>F_Final</td>
                                        <td><b>Dias</b></td>
                                         <td><b>Eps</b></td>
                                        <td><b>Concepto</b></td>
                                        <td><b>Estado</b></td>
                                </tr>
        <?
                   $i=1;
                     while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><?echo $i;?></th>
                                         <td><a href="descargar.php?codigo=<?echo $filas["nroinca"];?>"><?echo $filas["nroinca"];?></a></td>
                                          <td><?echo $filas["cedemple"];?></td>
                                         <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                                        <td><?echo $filas["fechaini"];?></td>
                                        <td><?echo $filas["fechater"];?></td>
                                        <td><?echo $filas["dias"];?></td>
                                        <td><?echo $filas["eps"];?></td>
                                        <td><?echo $filas["concepto"];?></td>
                                        <td><?echo $filas["estado"];?></td>

                                </tr>
        <?
        $i=$i+1;
                        }
                }


?>
                        </table>
                        

        </body>
</html>
