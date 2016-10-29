 <script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimir1.php?radicado=' + numero
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>
<?
if(empty($firma)):
  ?>
  <script language="javascript">
      alert("Debe de firma el documento para grabar.")
      history.back()
  </script>
  <?
else:
   include("../conexion.php");
   $consulta="select tipoprocesomemo.* from tipoprocesomemo where idproceso='$CodProceso'";
   $resultado=mysql_query($consulta) or die("Error al validar los conceptos");
   $filas=mysql_fetch_array($resultado);
   $Proceso = $filas["concepto"];
   $dirigida=strtoupper($dirigida);
   $cargo=strtoupper($cargo);
   $firma=strtoupper($firma);
   $empresa=strtoupper($empresa);
   $cons="update memorando set fecha='$fecha',codmuni='$municipio',idproceso='$CodProceso',asunto='$Proceso',nota='$nota',firma='$firma',cargo='$cargo',estado='$estado' where radicado='$nroradicado'";
   $resul=mysql_query($cons) or die("Insercion incorrecta");
   $regis=mysql_affected_rows();
   echo ("<script language=\"javascript\">");
   echo ("open (\"imprimir1.php?radicado=$nroradicado\" ,\"\");");
   echo ("</script>");
   if($admon!=''):
        ?>
         <script language="javascript">
             open("ModificarRegistro.php?admon=<?echo $admon?>&cedula=<?echo $cedula;?>","_self");
         </script>
        <?
   endif;
endif;
?>
