<html>
        <head>
                <title>Incapacidades por Zona</title>
                <link rel="stylesheet" href="../estilo.css" type="text/css">
        </head>
        <body>
    <?
    include("../conexion.php");
    $consulta1="select zona.zona from zona where
    zona.codzona='$codigo'";
                             $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
                           $regis=mysql_num_rows($resultado1);
                            ?>
                             <center><h4>Datos de la Incapacidad</h4></center>
                            <table border="0" align="center">
                                <?
                             while($filas=mysql_fetch_array($resultado1)):
                             ?>
                               <tr class="cajas">
                                <td><?echo $filas["zona"];?></td>
                               </tr>
                                <?
                              endwhile;
                              ?>
                              </table>
                              <?
                              $consulta="select zona.zona,incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,incapacidad.fechapro,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,
                              eps.eps,tipoinca.concepto,control.concepto as Descripcion,control.codigo from control,zona,incapacidad,empleado,eps,tipoinca where
                              zona.codzona=empleado.codzona and
                              empleado.cedemple=incapacidad.cedemple and
                              empleado.codeps=eps.codeps and
                              incapacidad.tipoinca=tipoinca.tipoinca and
							  control.codigo=incapacidad.codigo and
                               zona.codzona='$codigo'";
                           $resultado=mysql_query($consulta) or die("Consulta de empleado incorrecta");
                           $regist=mysql_num_rows($resultado);
                           if ($regist==0):
                              ?>
                              <script language="javascript">
                                alert("No hay incapacidades para Mostrar ?")
                                history.back()
                              </script>
                               <?
                           else:
                             ?>
                             <table border="0" align="center">
                               <tr class="cajas">
                                 <td>Para ver las Incacidades Por Empleado, Presione Click en el Campo [CEDULA]</td>
                               </tr>
                             </table>
                             <table border="0" align="center">
                                <tr class="cajas">
                              <th>Nro_Incap.</th>
                              <th>Cedula</th>
                              <th>Nombres</th>
                              <th>Apellidos</th>
                               <th>Fecha_Inicio</th>
                               <th>Fecha_Final</th>
                               <th>Dias</th>
							   <th>Codigo</th>
							   <th>Diagnostico</th>
                               <th>Tipo_Incapacidad</th>
                                <th>F_Proceso</th>
                             </tr>
                              <?
                              while($filas_s=mysql_fetch_array($resultado)):
                             ?>
                               <tr class="cajas">
                               <td><?echo $filas_s["nroinca"];?></td>
                               <td><a href="detalladoindi.php?cedula=<?echo $filas_s["cedemple"];?>"><?echo $filas_s["cedemple"];?></a></td>
                               <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?></td>
                               <td><?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                                 <td><?echo $filas_s["fechaini"];?></td>
                                 <td><?echo $filas_s["fechater"];?></td>
                                 <td><?echo $filas_s["dias"];?></td>
								 <td><?echo $filas_s["codigo"];?></td>
								 <td><?echo $filas_s["Descripcion"];?></td>
                                 <td><?echo $filas_s["concepto"];?></td>
                                 <td><?echo $filas_s["fechapro"];?></td>
                               </tr>
                                <?
                              endwhile;
                              ?>
                              </table>
                              <th><center><a href="imprimirgeneral.php?campo=<?echo $codigo;?>">Imprimir</a></center></th>
                              <?
                           endif;

                                           ?>
       </body>
</html>
