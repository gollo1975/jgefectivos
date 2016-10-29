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
if(empty($municipio)):
  ?>
  <script language="javascript">
      alert("Seleccion el municipio para el proceso")
      history.back()
  </script>
  <?
else:
   include("../conexion.php");
   $asunto=strtoupper($asunto);
   $estado='ACTIVO';
   $dirigida=strtoupper($dirigida);
   $cargo=strtoupper($cargo);
   $firma=strtoupper($firma);
   $empresa=strtoupper($empresa);
   $consulta = "select count(*) from memorando";
   $result = mysql_query ($consulta);
   $answ = mysql_fetch_row($result);
   if ($answ[0] > 0):
      $consulta = "select max(cast(radicado as unsigned)) + 1 from memorando";
      $result2 = mysql_query($consulta);
      $codc = mysql_fetch_row($result2);
      $radicado= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
   else:
      $radicado="00001";
   endif;
   $FechaP=date("Y-m-d");  
   $cons="insert into memorando(radicado,fecha,codmuni,senor,cedemple,dirigida,remitente,idproceso,asunto,nota,firma,cargo,empresa,estado,fechap)
   values('$radicado','$fecha','$municipio','$senor','$cedula','$dirigida','$remitente','$TipoProceso','$asunto','$nota','$firma','$cargo','$empresa','$estado','$FechaP')";
   $resul=mysql_query($cons) or die("Insercion incorrecta");
   $regis=mysql_num_rows($resul);
   echo ("<script language=\"javascript\">");
   echo ("open (\"imprimir1.php?radicado=$radicado\" ,\"\");");
   echo ("</script>");
   if($admon!=''):
        ?>
         <script language="javascript">
             open("agregar.php?admon=<?echo $admon?>","_self");
         </script>
        <?
   else:
      if($Szona != 0):
         ?>
          <script language="javascript">
             open("agregar.php?Szona=<?echo $Szona;?>","_self");
          </script>
          <?
       else:
          ?>
          <script language="javascript">
             open("agregar.php?Sdepto=<?echo $Sdepto;?>","_self");
          </script>
          <?
       endif;
   endif;
endif;
?>
