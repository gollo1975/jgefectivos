<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimirprestamo.php?nroprestamo=' + numero
                tiempo=10
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
include("../conexion.php");
if($formapago=='SEMANAL'):
     $vlrcuota=round(($valor/$dias)*7);
else:
     if ($formapago=='DECADAL'):
        $vlrcuota=round(($valor/$dias)*10);
     else:
        if ($formapago=='QUINCENAL'):
          $vlrcuota=round(($valor/$dias)*15);
        else:
        $vlrcuota=round(($valor/$dias)*30);
        endif;
     endif;
endif;
                        $consulta="update prestamoempresa set fechad='$fechaD',formapago='$formapago',vlrprestamo='$valor',cuota='$vlrcuota',dias='$dias',nota='$observacion' where prestamoempresa.nroprestamo='$nroprestamo'";
                        $resultado=mysql_query($consulta) or die("Error al grabar datos");
                        $registros=mysql_affected_rows();
                        if ($registros==0):
                        ?>
                            <script language="javascript">
                                   alert("Los registros no se grabaron en la bd. ?")
                                history.back()
                            </script>
                        <?
                        else:
	                     echo ("<script language=\"javascript\">");
			     echo ("open (\"imprimirPrestamo.php?nroprestamo=$nroprestamo\" ,\"\");");
			     echo ("</script>");
			     ?>
			     <script language="javascript">
			        open("modificarprestamo.php?codigo=<?echo $codigo;?>&cedula=<?echo $cedula;?>","_self");
			     </script>
			    <?

                        endif;
  ?>
