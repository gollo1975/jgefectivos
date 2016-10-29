<script language="javascript">
            function imprimir(numero)// para declara funcion
             {
              pagina='ImprimirReporteChequeo.php?IdChequeo=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
               }
</script>
<input type="hidden" name="UsuarioPreparador" value="<?echo $UsuarioPreparador;?>">
<?
if(empty($DatoN)):
?>
   <script language="javascript">
      alert("Debe de chequear las cajas de verificacion.!")
      history.back()
   </script>
<?
else:
   include("../conexion.php");
    $Nombre=strtoupper($Nombre);
    $radicado=strtoupper($radicado);
    $UsuarioPreparador=strtoupper($UsuarioPreparador);
	$Nota=strtolower($Nota);
    $fechap=date("Y-m-d");
       $Sql = "select count(*) from maestrorequisito";
       $Res = mysql_query($Sql);
       $sw = mysql_fetch_row($Res);
       if ($sw[0]>0):
	   $consulta = "select max(cast(idRequisito as unsigned)) + 1 from maestrorequisito";
	   $result = mysql_query($consulta);
	   $codz = mysql_fetch_row($result);
	   $IdChequeo = str_pad($codz[0], 5,"0", STR_PAD_LEFT);
	else:
	    $IdChequeo='00001';
	endif;

            $consulta="insert into maestrorequisito(idRequisito,cedula,nombre,tiporequisito,nota,usuarioproceso,fechap)
            values('$IdChequeo','$Cedula','$Nombre','$TipoE','$Nota','$UsuarioPreparador','$fechap')";
             $resultad=mysql_query($consulta)or die("Error al Grabar los requisitos.");
             /*ciclo para grabar detallado*/
             $Sw=0;
             for ($k = 1; $k <= $TotalVector; $k ++):
               if   ($ValidarDocumento[$k] != 'NO APLICA'):
                  if($ValidarPendiente[$k] != "" and $Sw==0){
                     $Sw=1;
                   }
                   $con="insert into detalladomaestrorequisito(iddocumento,concepto,estado,validacion,cantidad,pendiente,idRequisito)
                   values('$DatoN[$k]','$Concepto[$k]','$Estado[$k]','$ValidarDocumento[$k]','$Cantidad[$k]','$ValidarPendiente[$k]','$IdChequeo')";
                    $resulta=mysql_query($con)or die("Error al grabar detallado de los requisitos ");
                   $reg=mysql_affected_rows();
               endif;
           endfor;
           if($Sw==1){
                  $Sql="update maestrorequisito set cerrado='NO' where maestrorequisito.idRequisito='$IdChequeo'";
                  $Ejecutar= mysql_query($Sql)or die("Error al actualizar la tabla requisito");
           }else{
                 $Sql="update maestrorequisito set cerrado='SI' where maestrorequisito.idRequisito='$IdChequeo'";
                 $Ejecutar= mysql_query($Sql)or die("Error al actualizar la tabla requisito");
           }

           echo "<script language=\"javascript\">";
           echo "alert (\"Se Grabó $reg registros del Empleado: $Nombre\");";
           echo ("open (\"ImprimirReporteChequeo.php?IdChequeo=$IdChequeo\" ,\"\");");
           echo ("open (\"CrearRequisito.php?UsuarioPreparador=$UsuarioPreparador\",\"_self\");");
           echo "</script>";

 endif;
 ?>

