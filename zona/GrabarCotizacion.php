<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='../cartalaboral/ReporteCotizacion?Documento=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
include("../conexion.php");
$FechaP=date("Y-m-d");
$Nota=strtoupper($Nota);
$Dirigida=strtoupper($Dirigida);
$consulta = "select count(*) from cotizacioncomercial";
$result = mysql_query ($consulta);
$sw1 = mysql_fetch_row($result);
if ($sw1[0]>0){
   $Con = "select max(cast(idcotizacion as unsigned)) + 1  from cotizacioncomercial";
   $Ar = mysql_query ($Con);
   $Codigo = mysql_fetch_row($Ar);
   $Dato = str_pad($Codigo[0], 6,"0", STR_PAD_LEFT);
}else{
  $Dato="000001";
}
/*codigo de grabado*/
$Sql="insert into cotizacioncomercial(idcotizacion,nitempresa,razonsocial,salario,auxilio,porcentajeadmon,tipocotizacion,porcesantia,porintereses,porprima,porvacacion,cesantia,interes,prima,vacacion,
      porcaja,poricbf,porsena,caja,icbf,sena,porpension,poreps,porarl,pension,arl,eps,totalprestacion,totalparafiscal,totalseguridad,totaladmon,dirigida,cargo,nota,fechaproceso)
     values('$Dato','$Nit','$Razon','$Salario','$Auxilio','$Admon','$TipoAdmon','$PorCesantia','$PorInteres','$PorPrimas','$PorVacacion','$Cesantia','$Interes','$Primas','$Vacacion','$PorCajaC','$PorIcbf','$PorSena',
     '$CajaCompensacion','$ValorIcbf','$ValorSena','$PorPension','$PorEps','$PorArl','$ValorPension','$ValorArl','$ValorEps','$TotalPrestaciones','$TotalParafiscal','$TotalSeguridad','$TotalAdmon','$Dirigida','$Cargo','$Nota','$FechaP')";
$arSql=mysql_query($Sql)or die ("Error al grabar la cotizacion del cliente");
$registro=mysql_affected_rows();
   echo ("<script language=\"javascript\">");
   echo ("alert (\"Se grabo el registro con exito en el sistema.!\" ,\"\");");
   echo ("open (\"../cartalaboral/ReporteCotizacion.php?NroC=$Dato\" ,\"\");");
   echo ("</script>");
   ?>
   <script language="javascript">
     open("Cotizacion.php","_self")
   </script>
 <?



