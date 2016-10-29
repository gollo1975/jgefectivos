<html>
<head>
<title>Grabando Registros</title>
</head>
<body>
<?
if (empty($fechainic)):
?>
  <script language="javascript">
    alert("Digite la fecha inicial del empleado")
    history.back()
  </script>
<?
elseif (empty($salario)):
?>
     <script language="javascript">
       alert("Digite el salario del empleado ?")
       history.back()
     </script>
     <?

elseif (empty($cargo)):
?>
      <script language="javascript">
       alert("Digite el cargo del empleado")
       history.back()
      </script>
      <?
elseif($NivelE != $nivelarl):
?>
      <script language="javascript">
       alert("Debes de cambiar el pocentaje de la ARL en la tabla Empleado.!")
       history.back()
      </script>
<?
else:
    $cargo=strtoupper($cargo);
    $nota=strtoupper($nota);
    include("../conexion.php");
    $Sql="SELECT tipocontrato.* FROM tipocontrato where tipocontrato.tipo='$tipo'";
    $Ar=mysql_query($Sql) or die("Error al buscar el tipo de contrato");
    $fila=mysql_fetch_array($Ar);
    $Eps=$fila["aporteps"];
    $Pension=$fila["aportepension"];
    if($Pension=='NO' and $Eps=='NO'){
        if($PorSalud==0){
             $consulta="update contrato set fechainic='$fechainic',fechater='$fechater',salario='$salario',salario_ibc='$salario_ibc',tiposalario='$TipoS',nivel='$nivelarl',eps='$PorSalud',
                   pension='$PorPension',tipo='$tipo',cargo='$cargo',codigo_caja_pk='$CajaC',codigo_tipo_cotizante_fk='$TipoC',codigo_subtipo_cotizante_fk='$SubTipo',nota='$nota' where contrato='$contrato'";
             $resultado=mysql_query($consulta)or die("Inserccion incorrecta");
             $registro=mysql_affected_rows();
             echo "<script language=\"javascript\">";
             echo "open (\"../pie.php?msg=Se actualizaron $registro del contrato de Nro: $empleado\",\"pie\");";
             echo "open (\"listado.php\",\"_self\");";
             echo "</script>";
        }else{
            ?>
              <script language="javascript">
	          alert("Un contrato por PRACTICA O APRENDIZ no puede tener deduccion, favor quitar los porcentaje de EPS y PENSION, corregir el tipo de cotizante y cambiar el suptipo.!")
	          history.back()
	      </script>
            <?
        }
    }else{
            $consulta="update contrato set fechainic='$fechainic',fechater='$fechater',salario='$salario',salario_ibc='$salario_ibc',tiposalario='$TipoS',nivel='$nivelarl',eps='$PorSalud',
                   pension='$PorPension',tipo='$tipo',cargo='$cargo',codigo_caja_pk='$CajaC',codigo_tipo_cotizante_fk='$TipoC',codigo_subtipo_cotizante_fk='$SubTipo',nota='$nota' where contrato='$contrato'";
             $resultado=mysql_query($consulta)or die("Inserccion incorrecta");
             $registro=mysql_affected_rows();
             echo "<script language=\"javascript\">";
             echo "open (\"../pie.php?msg=Se actualizaron $registro del contrato de Nro: $empleado\",\"pie\");";
             echo "open (\"listado.php\",\"_self\");";
             echo "</script>";
    }
endif;
       ?>
</body>
</html>
