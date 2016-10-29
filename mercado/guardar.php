<script language="javascript">
                    function imprimir(numero)// para declara funcion
                    {
                    pagina='imprimir.php?codmerca=' + numero
                    tiempo=50
                    ubicacion='_self'
                    setTimeout("open(pagina,ubicacion)",tiempo)
                    }
                </script>
 <?
 if ($cupo>$cuporeal):
    $cuporeal=number_format($cuporeal,0);
   ?>
     <script language="javascript">
       alert("Lo siento, el maximo cupo para mercados es: $<?echo $cuporeal;?> Pesos.")
       history.back()
     </script>
   <?
 elseif (empty($cupo)):
   ?>
     <script language="javascript">
       alert("El Campo CUPO no puede ser vacío ..")
       history.back()
     </script>
   <?
 elseif (empty($autoriza)):
     ?>
     <script language="javascript">
       alert("El Campo Quien Autoriza No se pueder ser vacio ..")
       history.back()
     </script>
   <?
   elseif (empty($codigo)):
     ?>
     <script language="javascript">
       alert("Debe de seleccionar un item de Nómina ..")
       history.back()
     </script>
   <?
 else:
     include("../conexion.php");
     /*permite buscar el centro de trabajo*/
	$conP="select centro.cedemple,centro.codcentro from centro  where centro.cedemple='$cedemple'";
	$resP=mysql_query($conP)or die("error al consultar el centro de nomina");
	$fila=mysql_fetch_array($resP);
	$CodigoC=$fila["codcentro"];
     /*fin de codigo*/
      /*codigo que permite validar el codigo sdel salario*/
      $conP="select salario.codsala,salario.desala,salario.sumarcupo,salario.prestacion,salario.control,salario.insertar from salario where salario.codsala='$codigo'";
      $resP=mysql_query($conP)or die("error al consultar salarios");
      $regP=mysql_num_rows($resP);
      $filas_S=mysql_fetch_array($resP);
      $SumarCupo=$filas_S["sumarcupo"];
      $Concepto=$filas_S["desala"];
      $Prestacion=$filas_S["prestacion"];
      $Estado=$filas_S["control"];
      $Datos=$filas_S["insertar"];
			    /*fin de codigo*/
     $consulta = "select count(*) from mercado";
     $result = mysql_query ($consulta);
     $sw = mysql_fetch_row($result);
     $autoriza = strtoupper($autoriza);
     $estado = strtoupper($estado);
     if ($sw[0]>0):
        $consulta = "select max(cast(codmerca as unsigned)) + 1  from mercado";
        $result = mysql_query ($consulta);
        $codec = mysql_fetch_row($result);
        $code = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
     else:
       $code="000001";
     endif;
        $consulta="insert into mercado(codmerca,cedemple,fecha,cupo,cuota,estado,autoriza,nsaldo,codsala)
        values('$code','$cedemple','$fecha','$cupo','$Cuota','$estado','$autoriza','$cupo','$codigo')";
        $resultado=mysql_query($consulta) or die("Insercion incorrecta");
         /*codigo para inserta*/
	   $conI="select decentro.codcentro from decentro  where decentro.codcentro='$CodigoC' and decentro.codsala='$codigo'";
	   $resI=mysql_query($conI)or die("error al consular codigo en la tabla credito");
	   $RegI=mysql_num_rows($resI);
	   if($RegI == 0){
	       $conN="insert into decentro(codcentro,codsala,descripcion,prestacion,variacion,deduccion,estado,datos,activo,permanente)
	       values('$CodigoC','$codigo','$Concepto','$Prestacion','VARIABLE','-$Cuota','$Estado','$Datos','SI','SI')";
	       $resN=mysql_query($conN)or die("Error en la consulta de inserccion");
	   }else{
	       $Act="update decentro set deduccion='-$Cuota',activo='SI',permanente='SI' where decentro.codcentro='$CodigoC' and decentro.codsala='$codigo'";
	       $resA=mysql_query($Act)or die("Error en la actualizacion del centro de nomina");
	   }
         /*fin codigo*/
        $reg=mysql_affected_rows();
        echo ("<script language=\"javascript\">");
        echo ("open (\"imprimir.php?codmerca=$code\" ,\"\");");
        echo ("</script>");
        ?>
        <script language="javascript">
          open("agregar.php","_self")
        </script>
        <?
 endif;
