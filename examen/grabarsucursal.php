<script language="javascript">
            function imprimir(numero)// para declara funcion
             {
              pagina='imprimircontrol.php?nropago=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
               }
</script>
<input type="hidden" name="codigo" value="<?echo $codigo;?>">
<?
if(empty($datos)):
?>
   <script language="javascript">
      alert("Debe de seleccionar el tipo de examen para este Documento.")
      history.back()
   </script>
<?
else:
    $estado='ACTIVO';
    $control='FALTA';
    $nombre=strtoupper($nombre);
    $radicado=strtoupper($radicado);
    $fechap=date("Y-m-d");
   include("../conexion.php");
            $consulta="insert into examen(cedula,nombre,fechap,fechae,codzona,nitprove,radicado,estado,control,posicion,pago,costoe,usuario,tipoe,cargo)
            values('$cedula','$nombre','$fechap','$fechae','$Zona','$Proveedor','$radicado','$estado','$control','$control','$pago','$vlrexamen','$codigo','$TipoE','$Cargo')";
             $resultad=mysql_query($consulta)or die("Error al Grabar datos del examen ?");
             $reg=mysql_affected_rows();
             $con="select examen.nro from examen where cedula='$cedula' and fechap='$fechap' and nitprove='$Proveedor' and codzona='$Zona' and posicion='FALTA'";
             $resu=mysql_query($con)or die("Error al buscar examenes ?");
             $reg=mysql_num_rows($resu);
             $filas=(mysql_fetch_array($resu));
             $nropago=$filas["nro"];
             /*ciclo para grabar detallado*/
             for ($k = 1; $k <= $TotalVector; $k ++):
              if   ($datos[$k] != ""):
                   $con="insert into detalladoexamen(conse,vlrexamen,nro)
                   values('$datos[$k]','$valorE[$k]','$nropago')";
                    $resulta=mysql_query($con)or die("Error al grabar detallado de examenes ");
                   $reg=mysql_affected_rows();
              endif;
           endfor;
           /*ciclo para grabar detallado*/
             if($reg!=0):
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se Grabó $registros registros del Empleado: $nombre\",\"pie\");";
                     echo ("open (\"imprimircontrol.php?nropago=$nropago\" ,\"\");");
                     echo ("open (\"crearsucursal.php?codigo=$codigo\",\"_self\");");
                 echo "</script>";
             else:
                ?>
                <script language="javascript">
                   alert("Error al buscar consecutivo ?")
                   history.back()
                </script>
             <?
          endif;
 endif;
 ?>

