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
      $fechap=date("Y-m-d");
      for ($k = 1; $k <= $TotalVector; $k ++):
               if   ($DatoN[$k] != ""):
                    $Sql="update detalladomaestrorequisito set validacion='$ValidarDocumento[$k]',cantidad='$Cantidad[$k]',pendiente='$ValidarPendiente[$k]' where detalladomaestrorequisito.idcodigo= '$DatoN[$k]'";
                    $Rt=mysql_query($Sql)or die("Error al editar detallado de los requisitos ");
                    $reg=mysql_affected_rows();
               endif;
     endfor;
     $Act="update maestrorequisito set fecham='$fechap',usuariomodifica='$UsuarioPreparador',nota='$Nota' where maestrorequisito.idRequisito= '$NroId'";
     $Regis=mysql_query($Act)or die("Error al actualizar de los requisitos ");
     if($Proceso=='Cerrado'){
         $Validar="update maestrorequisito set cerrado='SI' where maestrorequisito.idRequisito= '$NroId'";
         $RegVa=mysql_query($Validar)or die("Error al actualizar de los requisitos ");
     }
     echo "<script language=\"javascript\">";
     echo "alert (\"Se Grabó $reg registros del Empleado: $Nombre\");";
     echo ("open (\"ImprimirReporteChequeo.php?IdChequeo=$NroId\" ,\"\");");
     echo ("open (\"EditarRequisito.php?UsuarioPreparador=$UsuarioPreparador\",\"_self\");");
     echo "</script>";

 endif;
 ?>

