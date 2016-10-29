<?
if(empty($TipoD)):
  ?>
   <script language="javascript">
       alert("Seleccione de la lista el tipo de Indetificación" )
       history.back()
    </script>
<?
elseif(empty($nomemple)):
?>
<script language="javascript">
alert("Digite un Nombre del Empleado " )
history.back()
</script>
<?
elseif(empty($apemple)):
?>
<script language="javascript">
alert("Digite el apellido del empleado " )
history.back()
</script>
<?
elseif(empty($telemple)):
?>
<script language="javascript">
alert("Digite el Télefono" )
history.back()
</script>
<?
elseif(empty($diremple)):
?>
<script language="javascript">
alert("Digite la Dirección " )
history.back()
</script>
<?
elseif(empty($munici)):
?>
<script language="javascript">
alert("Seleccione el municipio de la lista" )
history.back()
</script>
<?
elseif(empty($barrio)):
?>
<script language="javascript">
alert("Digite el  barrio donde reside" )
history.back()
</script>
<?
elseif(empty($fechanac)):
?>
<script language="javascript">
  alert("Digite Una Fecha de nacimiento" )
  history.back()
</script>
<?
elseif(empty($codbanco)):
?>
 <script language="javascript">
  alert("Seleccione un banco de la lista" )
  history.back()
</script>
<?
elseif(empty($codzona)):
?>
<script language="javascript">
alert("Seleccione la zona del empleado ?" )
history.back()
</script>
 <?
elseif(empty($codpension)):
?>
<script language="javascript">
alert("Seleccione el estado de pensión ?" )
history.back()
</script>
 <?
elseif(empty($codeps)):
?>
<script language="javascript">
alert("Seleccione la eps del empleado ?" )
history.back()
</script>
<?
elseif(empty($nomina)):
                ?>
<script language="javascript">
alert("Digite la opcion de Nomina" )
history.back()
</script>
              <?
elseif(empty($periodo)):
                ?>
<script language="javascript">
alert("Seleccione el periodo de pago" )
history.back()
</script>
              <?
elseif(empty($salario)):
                ?>
<script language="javascript">
 alert("Digite el salario básico" )
history.back()
</script>
              <?
elseif(empty($salariopago)):
                ?>
<script language="javascript">
alert("Digite el valor a pagar segun el periodo de pago" )
history.back()
</script>
<?
elseif(empty($tiempo)):
      ?>
	<script language="javascript">
	alert("Seleccion el tiempo de servicio" )
	history.back()
	 </script>
      <?
else:
    include("../conexion.php");
$FechaP =date('Y-m-d');
$nomemple=strtoupper($nomemple);
$apemple=strtoupper($apemple);
$apemple1=strtoupper($apemple1);
$nomemple1=strtoupper($nomemple1);
$diremple=strtoupper($diremple);
$barrio=strtoupper($barrio);
$email=strtoupper($email);
$sexo=strtoupper($sexo);
 $nomina=strtoupper($nomina);
$estcivil=strtoupper($estcivil);
$consul = "select count(*) from empleado";
$result = mysql_query ($consul);
$sw = mysql_fetch_row($result);
if ($sw[0]>0):
   $consulta = "select max(cast(codemple as unsigned)) + 1 from empleado";
   $result = mysql_query($consulta);
   $codz = mysql_fetch_row($result);
   $codigo = str_pad($codz[0], 5,"0", STR_PAD_LEFT);
else:
    $codigo='00001';
endif;

$consulta="insert into empleado (codemple, cedemple, tipod, nomemple, nomemple1, apemple, apemple1, telemple, diremple, codmuni, municipio, celular, rh,  sexo, email, fechanac, estcivil, cuenta, codbanco, codzona, codeps, codpension, nomina, codcosto, nivel, eps, pension, periodo, basico, vlrpagado,pagarp, tiempo, fechagrabado,tipoempleado)
values('$codigo',  '$cedemple', '$TipoD', '$nomemple', '$nomemple1', '$apemple', '$apemple1', '$telemple', '$diremple', '$munici', '$barrio', '$celular', '$rh', '$sexo', '$email', '$fechanac', '$estcivil', '$cuenta', '$codbanco', '$codzona', '$codeps', '$codpension', '$nomina', '$CodCosto', '$nivel', '$eps', '$pension', '$periodo', '$salario', '$salariopago','$PagarP','$tiempo','$FechaP','$TipoEmpleado')";
$resultado=mysql_query($consulta) or die("Error al grabar datos del empleado");
$conC="insert into centrotrabajo (codcosto,cedemple)
values('$CodCosto',  '$cedemple')";
$resuC=mysql_query($conC) or die("Error al grabar datos del centro de nomina");
$regi=mysql_affected_rows();
 if($regi!=0):
 ?>
<script language="javascript">
alert("Registro Almacenado Correctamente en sistemas")
open("agregar.php","_self");
 </script>
                <?
else:
  ?>
<script language="javascript">
 alert("El registro no se Guardo en Sistema")
open("agregar.php","_self");
</script>
                <?
endif;
endif;
      ?>
