<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimir.php?nrocredito=' + numero
                tiempo=60
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
$fecha=date("Y-m-d");
include("../conexion.php");
/*permite buscar el centro de trabajo*/
$conP="select centro.cedemple,centro.codcentro from centro  where centro.cedemple='$cedula'";
$resP=mysql_query($conP)or die("error al consultar el centro de nomina");
$filas_S=mysql_fetch_array($resP);
$CodigoC=$filas_S["codcentro"];
 /*fin de codigo*/
$consulta="select count(*) from credito";
$resul=mysql_query($consulta)or die("Consulta incorrecta 1");
$sw=mysql_fetch_row($resul);
if ($sw[0]>0):
   $consulta="select max(cast(nrocredito as unsigned))+ 1 from credito";
   $resultado=mysql_query($consulta)or die ("error en la consulta de generacion de codigo");
   $codigo = mysql_fetch_row($resultado);
   $codigo1= str_pad($codigo[0], 6, "0", STR_PAD_LEFT);
else:
   $codigo1="000001";
endif;
$consu="insert into credito(nrocredito,cedemple,tipocre,codsala,fesalida,vlrsolicitado,interes,vlrinteres,plazo,vlrentregado,formap,nuevo,tcredito,cuota,sumarcupo)
   values('$codigo1','$cedula','$tipoc','$codsalario','$fecha','$vlrsolicitado','$vlrinteres','$totalinteres','$plazo','$vlrentregado','$fpago','$total',$total,'$cuota','$SumarCupo')";
   $resul=mysql_query($consu)or die("Error en la consulta");
   /*codigo para inserta*/
   $conI="select decentro.codcentro from decentro  where decentro.codcentro='$CodigoC' and decentro.codsala='$codsalario'";
   $resI=mysql_query($conI)or die("error al consular codigo en la tabla credito");
   $RegI=mysql_num_rows($resI);
   if($RegI == 0){
       $conN="insert into decentro(codcentro,codsala,descripcion,prestacion,variacion,deduccion,estado,datos,activo,permanente)
       values('$CodigoC','$codsalario','$Concepto','$Prestacion','VARIABLE','-$cuota','$Estado','$Datos','SI','SI')";
       $resN=mysql_query($conN)or die("Error en la consulta de inserccion");
   }else{
       $Act="update decentro set deduccion='-$cuota',activo='SI',permanente='SI' where decentro.codcentro='$CodigoC' and decentro.codsala='$codsalario'";
       $resA=mysql_query($Act)or die("Error en la actualizacion del centro de nomina");
   }
   /*fin codigo*/
   $reg=mysql_affected_rows();
if ($reg!=0):

     echo ("<script language=\"javascript\">");
     echo ("open (\"imprimir.php?nrocredito=$codigo1\" ,\"\");");
     echo ("</script>");
     ?>
     <script language="javascript">
        open("credito.php","_self");
     </script>
    <?
endif;
?>

