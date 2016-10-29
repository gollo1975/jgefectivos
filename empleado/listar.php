<html>
        <head>
                <title>Listado de Empleado</title>
                <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select empleado.* from empleado,contrato where
                        empleado.codemple=contrato.codemple and
                        contrato.fechater='0000-00-00'";
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
                  $bloque=55;
                   if (!$pagina):
                     $pagina=1;
                     $inicio=0;
                   else:
                      $inicio=($pagina-1)*$bloque;
                   endif;
                   $consulta="select empleado.*,contrato.fechainic from empleado,contrato where
                        empleado.codemple=contrato.codemple and
                        contrato.fechater='0000-00-00' limit $inicio,$bloque";
                   $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
                   $nropaginas=ceil($registros/$bloque);    //rodondea el nro
        ?>
                              <center><h4><u>Empleados Activos</u></h4></center>
                                <table border="0" align="center">
                                     <tr class="cajas">
                                        <th>Código</th>
                                        <th>Cedula</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                        <th>Municipio</th>
                                        <th>Sexo</th>
                                        <th>Fecha Nac.</th>
                                        <th>Civil</th>
                                        <th>Cuenta</th>
                                        <th>Nom.</th>
                                        <th>F_Ingreso</th>
                                   </tr>
        <?
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <td><?echo $filas["codemple"];?></td>
                                        <td><?echo $filas["cedemple"];?></td>
                                        <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
                                        <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                                        <td><?echo $filas["telemple"];?></td>
                                        <td><?echo $filas["diremple"];?></td>
                                        <td><?echo $filas["municipio"];?></td>
                                        <td><?echo $filas["sexo"];?></td>
                                        <td><?echo $filas["fechanac"];?></td>
                                        <td><?echo $filas["estcivil"];?></td>
                                        <td><?echo $filas["cuenta"];?></td>
                                        <td>&nbsp;&nbsp;<?echo $filas["nomina"];?></td>
                                        <td><?echo $filas["fechainic"];?></td>
                                       </tr>
        <?
        $con=$con+1;
                    }
                }

        ?>
                        </table>
                         <table border="0" align="center">
                            <tr>
                             <?
                             if($pagina==$nropaginas):
                             ?>
                               <tr class="cajas">
                                 <center><b>Nro_Empleados:</b>&nbsp;<?echo $registros;?></center></tr>
                                 <?
                             else:
                             ?>
                               <tr class="cajas">
                                 <center><b>Nro_Empleados:</b>&nbsp;<?echo $bloque*$pagina;?></center></tr>
                              <?
                             endif;
                               for ($i=1;$i<=$nropaginas;$i++)
                               {
                               ?>
                                 <td class="cajas"><a href="listar.php?pagina=<?echo $i;?>">
                                  <?echo "$i";?></a></td>
                                  <?
                                 }
                               ?>
                             </tr>
                             </table>



        </body>
</html>
