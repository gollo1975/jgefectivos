    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='descargar.php'
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
</script>
       <head>
                <title>Registro de Miembros</title>
                 <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">

                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        </head>
        <body>
                <?
                       if (!isset($cedula)):
                          ?>

                              <center><h2><u>Requisitos de Asociado</u></h2></center>
                               <form action="" method="post">
                                        <table border="0" align="center"
                                                <tr>
                                                        <td colspan="6"><br></td>
                                                </tr>
                <?
                                include("../conexion.php");
                                if (!$nro):
                                   $nit=$nro;
                                     ?>
                                     <tr>
                                        <td><b>Nit/Cedula:</b></td>
                                        <td><input type="text" name="nit" value="<? echo $codigo;?>" size="13" readonly class="cajas"></td>
                                        <td><b>Empresa:</b></td>
                                        <td><input type="text" name="empresa" value="<?echo $empresa;?>" size="45" class="cajas" readonly></td>
                                     </tr>
                                     <tr>
                                        <td><b>Código</b></td>
                                        <td><input type="text" name="nit" value="<? echo $codbusca;?>" size="13" readonly class="cajas"></td>
                                        <td><b>Descripcion:</b></td>
                                        <td><input type="text" name="empresa" value="<?echo $descripcion;?>" size="45" class="cajas" readonly></td>
                                     </tr>
                                  <tr>
                                    <td><b>Nota:</b></td>
                                    <td colspan="10"><textarea name="observacion" cols="75" rows="4" class="cajas"></textarea></td>
                                  </tr>
                                 <?
                                else:
                                        $nit=$nro;
                                        $consulta="select * from requisito where requisito.nit='$nro' and requisito.radicado='$codex'";
                                        $resultado=mysql_query($consulta) or die("consulta incorrecta 1");
                                        $filas=mysql_fetch_array($resultado);
                ?>                      <tr>
                                        <td><b>Nit/Cedula:</b></td>
                                        <td><input type="text" name="nit" value="<? echo $filas["nit"];?>" size="13" readonly class="cajas"></td>
                                        <td><b>Empresa:</b></td>
                                        <td><input type="text" name="empresa" value="<?echo $filas["empresa"];?>" size="45" class="cajas" readonly></td>
                                     </tr>
                                     <tr>
                                        <td><b>Código:</b></td>
                                        <td><input type="text" name="nit" value="<? echo $filas["codigo"];?>" size="13" readonly class="cajas"></td>
                                        <td><b>Descripción:</b></td>
                                        <td><input type="text" name="descripcion" value="<?echo $filas["concepto"];?>" size="45" class="cajas" readonly></td>
                                     </tr>
                                     <tr>
                                       <td><b>Nota:</b></td>
                                       <td colspan="10"><textarea name="observacion" cols="75" rows="4" class="cajas" readonly><?echo $filas["observacion"];?></textarea></td>
                                     </tr>
                                      <?
                                endif;
                                     ?>
                       <tr>
                          <td colspan="3">&nbsp;</td>
                       </tr>
                       <tr>
                           <td><b>Servicio</b></td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                           <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="3">
                              <select name="servicio" class="cajas" >
                               <option value="0">Seleccione un Servicio
                                    <?
                                    include("../conexion.php");
                                     $consulta="select item.codcom,item.concepto from item order by concepto";
                                     $resultado=mysql_query($consulta) or die("Error en la busqueda sde servicio");
                                      while ($filas=mysql_fetch_array($resultado)):
                                          ?>
                                          <option value="<?echo $filas["codcom"];?>"><?echo $filas["concepto"];?>
                                          <?
                                      endwhile;
                                     ?>
                              </select>
                          </td>
                          <td colspan="3"><input type="submit" value="Agregar"></td>
                        </tr>
                  </table>
                        <input type="hidden" name="MM_insert" value="form1">
                </form>
               <?
                        include("../conexion.php");
                        $consulta_d="select derequisito.* from derequisito where derequisito.radicado='$codex'";
                        $resultado_d=mysql_query($consulta_d) or die("Error al buscar detalles");
                        $registros_d=mysql_num_rows($resultado_d);
                        if ($registros_d==0):
                            ?>
                          <table border="" align="center" width="700">
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>Radicado</th>
                                </tr>
                          </table>
                <?

                        else:

                ?>
                          <form action="eliminar.php" method="post">
                                <table border="1" align="center" width="600">
                                        <tr class="fondo">
                                                <th>&nbsp;</th>
                                                <th>Registro</th>
                                                <th>Documento</th>
                                                <th>Asociado</th>
                                                <th><a href="consejo.php">Volver</a></th>
                                        </tr>
                                <?
                                $subtotal=0;
                                $x=1;
                                while ($filas_d = mysql_fetch_array($resultado_d)):
                                 ?>
                                        <tr align="center" class="cajas">
                                                <input type="hidden" name="nit" value="<?echo $nit;?>">
                                                <input type="hidden" name="codex" value="<?echo $codex;?>">
                                                <td>&nbsp;<input type="checkbox" name="datos[]" value="<?echo $filas_d["conse"];?>"></td>
                                                 <td><div align="center"><?echo $x;?></div></td>
                                                  <td><div align="center"><?echo $filas_d["cedemple"];?></div></td>
                                                   <td><div align="center"><?echo $filas_d["empleado"];?></div></td>
                                           </tr>
                                  <?
                                  $x=$x+1;
                                endwhile;
                                ?>
                          <tr>
                             <td colspan="9">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="9" align="center"><input type="submit" value="Eliminar"></td>
                          </tr>
                         </table>

                         </form>
                         <?
                        endif;

                         elseif(empty($desde)):

                ?>
                           <script language="javascript">
                               alert("Digite la fecha de inicio ?")
                                history.back()
                           </script>

                 <?
                              elseif(empty($cedula)):
                               ?>
                              <script language="javascript">
                                alert("Digite el documento del empleado ?")
                                history.back()
                              </script>
                <?
                             else:
                               $fechap=date("Y-m-d");
                                include("../conexion.php");
                                $con="select empleado.cedemple from empleado where empleado.cedemple='$cedula'";
                                $res=mysql_query($con)or die ("Error al buscar datos del examen");
                                $reg=mysql_num_rows($res);
                                if($reg!=0):
	                                $consulta="select * from consejo where consejo.radicado='$codex'";
	                                $resultado=mysql_query($consulta) or die("Error al buscar datos");
	                                $registros=mysql_num_rows($resultado);
	                                if ($registros==0):
	                                   $consulta = "select count(*) from consejo";
	                                   $result = mysql_query ($consulta);
	                                   $answ = mysql_fetch_row($result);
	                                   $ciudad=strtoupper($ciudad);
	                                  if ($answ[0] > 0):
	                                    $consulta = "select max(cast(radicado as unsigned)) + 1 from consejo";
	                                    $result2 = mysql_query($consulta);
	                                    $codc = mysql_fetch_row($result2);
	                                    $codex= str_pad($codc[0], 4, "0", STR_PAD_LEFT);
	                                  else:
	                                    $codex = "0001";
	                                  endif;
                                             $observacion=strtoupper($observacion);
	                                      $consulta="insert into consejo (radicado,nit,empresa,desde,hasta,observacion,fechap)
		                                              values('$codex','$nit','$empresa','$desde','$hasta','$observacion','$fechap')";
		                                    $resultado=mysql_query($consulta) or die("Error al Grabar datos del provedor");
		                                    $consulta1="insert into deconsejo (cedemple,empleado,radicado)
		                                                values('$cedula','$empleado','$codex')";
		                                    $resultado=mysql_query($consulta1) or die("Error al grabar el detalle");
                                                    $aux="select concat(empleado.nomemple,' ' ,empleado.nomemple1,' ' , empleado.apemple,' ' ,empleado.apemple1) as nombre from empleado where empleado.cedemple='$cedula'";
                                                    $re_e=mysql_query($aux)or die("Error al buscar el nombre");
                                                    $filas_e=mysql_fetch_array($re_e);
                                                    $nombreaux=$filas_e["nombre"];
                                                    $cons="update deconsejo set empleado='$nombreaux' where deconsejo.radicado='$codex' and deconsejo.cedemple='$cedula'";
                                                    $res1=mysql_query($cons)or die("Error de actualizacion en la table examen");
		                                    header("location: agregaradmon.php?nro=$nit&codex=$codex");
	                                elseif (empty($nro)):
	                                   ?>
	                                        <script language="javascript">
	                                                alert("Este conscutivo ya existe")
	                                                pagina="agregaradmon.php"
	                                                tiempo=100
	                                                ubicacion="_self"
	                                                setTimeout("open(pagina,ubicacion)",tiempo)
	                                                history.back()
	                                        </script>
	                                   <?
	                                else:

                                                   $consulta1="insert into deconsejo (cedemple,empleado,radicado)
		                                                values('$cedula','$empleado','$codex')";
		                                    $resultado=mysql_query($consulta1) or die("Error al grabar el detalle");
                                                    $aux="select concat(empleado.nomemple,' ' ,empleado.nomemple1,' ' , empleado.apemple,' ' ,empleado.apemple1) as nombre from empleado where empleado.cedemple='$cedula'";
                                                    $re_e=mysql_query($aux)or die("Error al buscar el nombre");
                                                    $filas_e=mysql_fetch_array($re_e);
                                                    $nombreaux=$filas_e["nombre"];
                                                    $cons="update deconsejo set empleado='$nombreaux' where deconsejo.radicado='$codex' and deconsejo.cedemple='$cedula'";
                                                    $res1=mysql_query($cons)or die("Error de actualizacion en la table examen");
	                                           header("location: agregaradmon.php?nro=$nit&codex=$codex");

	                                endif;
                                 else:
                                   ?>
                                     <script language="javascript">
                                        alert("El documento digitado no existe en sistema ?")
                                        history.back()
                                     </script>
                                   <?
                                 endif;
                      endif;
?>
</body>
</html>
