 <input type="hidden" name="Usuario" value="<?echo $Usuario?>" id="Usuario">
<?
 session_start();
?>
<?
if(session_is_registered("xsession")):
if (empty($Dias)):
  ?>
   <script language="javascript">
     alert("Debe de digitar los dias que sale a vacaciones ?")
     history.back()
   </script>
  <?
elseif(empty($Codigo)):
 ?>
   <script language="javascript">
     alert("Seleccione el codigo del salario para la creacion del registro.! <?echo $CodSala;?>")
     history.back()
   </script>
  <?
else:
    $fecha = date('$Desde');
    $nuevafecha = strtotime ( '+2 day' , strtotime ( $fecha ) ) ;
    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
    $FechaP=date("Y-m-d");
    $Usuario=strtoupper($Usuario);
    include("../conexion.php");
    $consulta="insert into vacacionprogramada(cedemple,desde,hasta,dias,codsala,fecha_proceso,codzona,usuario)
            values('$Documento','$Desde','$Hasta','$Dias','$Codigo','$FechaP','$CodZona','$Usuario')";
    $resultado=mysql_query($consulta)or die("error al grabar la programacion de vacaciones");
    ?>
    <script language="javascript">
       alert("Registro Grabado Con Exito en el sistema.!")
       open("ProgramarVacacion.php?Usuario=<?echo $Usuario;?>","_self");
    </script>
    <?

endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
  ?>
 </body>
</html>
