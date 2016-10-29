
<?php
if(empty($descargos)):
  ?>
  <script language="javascript">
      alert("digite los descargos del empleado que renuncia")
      history.back()
  </script>
  <?
else:
   include("../conexion.php");
   $fecha=date("Y-m-d");
   $descargos=strtoupper($descargos);
   $cargo=strtoupper($cargo);
   $firma=strtoupper($firma);
   $empresa=strtoupper($empresa);
   $consulta = "select count(*) from renuncia";
   $result = mysql_query ($consulta);
   $answ = mysql_fetch_row($result);
   if ($answ[0] > 0):
      $consulta = "select max(cast(radicado as unsigned)) + 1 from renuncia";
      $result2 = mysql_query($consulta);
      $codc = mysql_fetch_row($result2);
      $radicado= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
   else:
      $radicado="00001";
   endif;
   $cons="insert into renuncia(radicado,cedemple,zona,fechap,codmuni,descargo,firma,cargo,empresa)
   values('$radicado','$cedula','$zona','$fecha','$municipio','$descargos','$firma','$cargo','$empresa')";
   $resul=mysql_query($cons) or die("Error al grabar datos de la renuncia");
   $regis=mysql_num_rows($resul);
   echo ("<script language=\"javascript\">");
   echo ("open (\"ImprimiRenuncia.php?radicado=$radicado\" ,\"\");");
   echo ("</script>");
   if($admon!=''):
        ?>
         <script language="javascript">
             open("Renuncias.php?admon=<?echo $admon?>","_self");
         </script>
        <?
   else:
      if($Szona != 0):
         ?>
          <script language="javascript">
             open("Renuncias.php?Szona=<?echo $Szona;?>","_self");
          </script>
          <?
       else:
          ?>
          <script language="javascript">
             open("Renuncias.php?Sdepto=<?echo $Sdepto;?>","_self");
          </script>
          <?
       endif;
   endif;
endif;
?>
