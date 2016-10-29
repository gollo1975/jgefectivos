        <html>
        <head>
                <title>Modificacion del Registro</title>
                  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</script>
        </head>
        <body>
        <?
                if (!isset($cedula)):
                        include("../conexion.php");
                        $consulta="select * from dexamen where conse='$codigo'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0):
                                  ?>
                                <script language="javascript">
                                        alert("No Existen Registros en la consulta ?")
                                        history.back()
                                </script>
                                  <?
                        else:
                           while ($filas=mysql_fetch_array($resultado)):
                               $NroE=$filas["nro"];
                                ?>
                             <center><h4><u>Modificar el registro</u></h4></center>
                              <form action="" method="post" id="f1" name="f1">
                              <input type="hidden" name="codex" value="<?echo $codex;?>">
                              <input type="hidden" name="nit" value="<?echo $nit;?>">
                              <input type="hidden" name="NroE" value="<?echo $NroE;?>">
                                   <table border="0" align="center">
                                      <tr><td><br></td></tr>
                                      <tr>
                                         <td><b>Consecutivo:</b></td>
                                           <td><input type="text" name="conse" value="<?echo $filas["conse"];?>" class="cajas" size="13" readonly id="conse"></td>
                                      </tr>
                                      <tr>
                                        <td><b>Documento</b></td>
                                        <td><input type="text" name="cedula" value="<?echo $filas["cedula"];?>" class="cajas" size="13" readonly id="cedula"></td>
                                       </tr>
                                      <tr>
                                         <td><b>Asociado:</b></td>
                                           <td><input type="text" value="<?echo $filas["asociado"];?>" class="cajas" size="45" readonly ></td>
                                      </tr>
                                      <tr>
                                        <td><b>Nro_Abono</b></td>
                                        <td><input type="text" name="nroabono"value="<?echo $filas["nroabono"];?>" class="cajas" size="13" maxlength="10" id="nroabono"></td>
                                       </tr>
                                       <tr>
                                        <td><b>Vlr_Examen:</b></td>
                                        <td><input type="text" name="valor"value="<?echo $filas["vlrexamen"];?>" class="cajas" size="13" maxlength="10" id="valor"></td>
                                       </tr>
                                       <tr><td><br></td></tr>
                                   <tr>
                                   <td colspan="5"><input type="submit" value="Guardar" class="boton" name="grabar" id="grabar"></td>
                                </tr>

                                   </table>
                                </form>
                                 <?
                          endwhile;

                       endif;
                 elseif(empty($valor)):
                                  ?>
                                <script language="javascript">
                                        alert("Digite el valor del examen ?")
                                        history.back()
                                </script>
                                   <?
                 else:
                      include("../conexion.php");
                       /*codigo para valida el cobro del examen*/
                       $ValiZ="select derelacionexamen.valor from derelacionexamen
	                       where derelacionexamen.nro='$NroE' and cedemple='$cedula'";
	               $RegZ=mysql_query($ValiZ)or die("Error al buscar el valor del examen Cliente");
                       $filas_Z=mysql_fetch_array($RegZ);
                       $VlrCliente=$filas_Z["valor"];
                        if($VlrCliente > 0):
                             if($valor==$VlrCliente):
                                  $Estado='AL DIA';
                             else:
                                 if($valor > $VlrCliente):
                                      $Negativo=($valor-$VlrCliente);
                                      $Estado='COBRAR A ZONA';
                                 else:
                                      $Positivo=($VlrCliente-$valor);
                                      $Estado='SALDO A FAVOR';
                                 endif;
                             endif;
                       else:
                             $Estado='FALTA POR COBRAR';
                       endif;
                       $consulta="update dexamen set nroabono='$nroabono',estado='$Estado',positivo='$Positivo',negativo='$Negativo',vlrexamen='$valor' where conse='$conse'and dexamen.codigo='$codex'";
                       $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                       $registros=mysql_affected_rows();
                       if ($registros==0){
                           ?>
                             <script language="javascript">
                                  alert("No se Actualizo el Registro en sistemas!")
                                  history.go(-2)
                            </script>
                            <?
                      }else{
                           header("location: agregar.php?codex=$codex&nro=$nit");
                      }
              endif;
?>

        </body>
</html>
