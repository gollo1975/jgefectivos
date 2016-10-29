<script language="javascript">
     function imprimir(numero)// para declara funcion
     {
          pagina='imprimeconvenio.php?codigo=' + numero
          tiempo=80
          ubicacion='_self'
          setTimeout("open(pagina,ubicacion)",tiempo)
     }
</script>
<?
include("../numeros.php");
$letras=num2letras($Salario);
$Letras=strtoupper($letras);
$ValorNoSalarial=num2letras($SalarioNoPrestacional);
$ValorNoSalarial=strtoupper($ValorNoSalarial);
include("../conexion.php");
/*codigo que busca el lugar de expedicion*/
$Sql="select municipio.municipio from municipio where municipio.codmuni='$LugarExpedicion'";
$Rs=mysql_query($Sql)or die("Error al validar el lugar de expedicion");
$fila_B=mysql_fetch_array($Rs);
$LugarE = $fila_B["municipio"];
/*variables mayusculas*/
$Empleado=strtoupper($Empleado);
$Cargo=strtoupper($Cargo);
$LugarE=strtoupper($LugarE);
$DiaPago = strtolower($DiaPago);
$HorarioTrabajo = strtoupper($HorarioTrabajo);
$Proceso = strtoupper($Proceso);
/*codigo de actualizacion*/
if($TipoContrato=='LABOR'){
        $SqlInserccion="update convenio set cedemple='$Documento',nombres='$Empleado',codmuni='$LugarExpedicion',lugarexpedicion='$LugarE',salario='$Salario', letra='$Letras', cargo='$Cargo', fechacontratacion='$FechaContratacion',
                 diapago='$DiaPago',formapago='$FormaPago',horariotrabajo='$HorarioTrabajo',proceso='$Proceso',usuariomodificado='$UsuarioPreparador' where convenio.nroconvenio='$NroContrato'";
	$Rs=mysql_query($SqlInserccion)or die("Error al actualizar datos del contrato temporal");
        $registro=mysql_affected_rows();
	echo ("<script language=\"javascript\">");
	echo ("open (\"ReporteContratoNuevo.php?CodReporte=$NroContrato\" ,\"\");");
	echo ("</script>");
	?>
	<script language="javascript">
	open("ModificarConvenioCarta.php?codigo=<?echo $codigo;?>&UsuarioPreparador=<?echo $UsuarioPreparador;?>","_self");
	</script>
        <?
}
if($TipoContrato=='ADICCION'){
       /*codigo que el concepto no salarial*/
	$SrS="select conceptonosalarial.concepto from conceptonosalarial where conceptonosalarial.codsala='$CodigoConcepto'";
	$RsS=mysql_query($SrS)or die("Error al buscar conceptos");
	$fila_S=mysql_fetch_array($RsS);
	$Concepto = $fila_S["concepto"];
        if(empty($SalarioNoPrestacional)){
         ?>
         <script language="javascript">
            alert("Favor digitar el salario no prestacional de este empleado.!")
            history.back()
         </script>
         <?
        }elseif(empty($CodigoConcepto)){
                    ?>
         <script language="javascript">
            alert("Favor digitar el salario no prestacional de este empleado.!")
            history.back()
         </script>
         <?
        }else{
          $SqlInserccion="update convenio set pagonosalarial='$SalarioNoPrestacional', letranosalarial='$ValorNoSalarial', codsala='$CodigoConcepto', conceptonosalarial='$Concepto', usuariomodificado='$UsuarioPreparador' where convenio.nroconvenio='$NroContrato'";
   	  $Rs=mysql_query($SqlInserccion)or die("Error al actualizar datos del contrato de accion");
          $registro=mysql_affected_rows();
	  echo ("<script language=\"javascript\">");
	  echo ("open (\"ReporteContratoNuevo.php?CodReporte=$NroContrato\" ,\"\");");
	  echo ("</script>");
  	  ?>
	  <script language="javascript">
	  open("ModificarConvenioCarta.php?codigo=<?echo $codigo;?>&UsuarioPreparador=<?echo $UsuarioPreparador;?>","_self");
	  </script>
          <?
        }
}
if($TipoContrato=='FIJO'){
        include("../conexion.php");
        $CiudadContratacion=strtoupper($CiudadContratacion);
	$Direccion= strtoupper($Direccion);
	$Barrio= strtoupper($Barrio);
        $nuevafecha = strtotime ( '+'.$NroDias.'  day' , strtotime ( $FechaContratacion ) ) ;
        $FechaVencimiento = date ( 'Y-m-d' , $nuevafecha );
        if(empty($Documento)){
           ?>
           <script language="javascript">
              alert("Favor digitar el documento del  empleado.!")
              history.back()
           </script>
           <?
         }elseif(empty($Empleado)){
           ?>
           <script language="javascript">
              alert("Favor digitar el Nombre del  empleado.!")
              history.back()
           </script>
           <?
         }elseif(empty($Salario)){
           ?>
           <script language="javascript">
              alert("Favor digitar el Salario del  empleado.!")
              history.back()
           </script>
           <?
         }elseif(empty($Cargo)){
           ?>
           <script language="javascript">
              alert("Favor digitar el Cargo del  empleado.!")
              history.back()
           </script>
           <?
          }elseif(empty($Direccion)){
           ?>
           <script language="javascript">
              alert("Favor digitarla dirección de  empleado.!")
              history.back()
           </script>
           <?
          }elseif(empty($NroDias)){
           ?>
           <script language="javascript">
              alert("Favor digite los dias de contratacion del  empleado.!")
              history.back()
           </script>
           <?
           }else{
	         $SqlInserccion="update convenio set cedemple='$Documento',nombres='$Empleado',codmuni='$LugarExpedicion',lugarexpedicion='$LugarE',salario='$Salario', letra='$Letras', cargo='$Cargo', fechacontratacion='$FechaContratacion',
	                 formapago='$FormaPago',direccion='$Direccion',barrio='$Barrio', cargo='$Cargo',nrodias='$NroDias', fechanacimiento='$FechaNacimiento', fechavencimiento='$FechaVencimiento',municipiocontratacion='$CiudadContratacion', usuariomodificado='$UsuarioPreparador' where convenio.nroconvenio='$NroContrato'";
	         $Rs=mysql_query($SqlInserccion)or die("Error al actualizar datos del contrato Fijo");
	         $registro=mysql_affected_rows();
		 echo ("<script language=\"javascript\">");
		 echo ("open (\"ReporteContratoNuevo.php?CodReporte=$NroContrato\" ,\"\");");
		 echo ("</script>");
		 ?>
		 <script language="javascript">
		   open("ModificarConvenioCarta.php?codigo=<?echo $codigo;?>&UsuarioPreparador=<?echo $UsuarioPreparador;?>","_self");
		 </script>
	         <?
           }
}
if($TipoContrato=='INDEFINIDO'){
        include("../conexion.php");
        $CiudadContratacion=strtoupper($CiudadContratacion);
	$Direccion= strtoupper($Direccion);
	$Barrio= strtoupper($Barrio);
        if(empty($Documento)){
           ?>
           <script language="javascript">
              alert("Favor digitar el documento del  empleado.!")
              history.back()
           </script>
           <?
         }elseif(empty($Empleado)){
           ?>
           <script language="javascript">
              alert("Favor digitar el Nombre del  empleado.!")
              history.back()
           </script>
           <?
         }elseif(empty($Salario)){
           ?>
           <script language="javascript">
              alert("Favor digitar el Salario del  empleado.!")
              history.back()
           </script>
           <?
         }elseif(empty($Cargo)){
           ?>
           <script language="javascript">
              alert("Favor digitar el Cargo del  empleado.!")
              history.back()
           </script>
           <?
          }elseif(empty($Direccion)){
           ?>
           <script language="javascript">
              alert("Favor digitarla dirección de  empleado.!")
              history.back()
           </script>
           <?
           }else{
	         $SqlInserccion="update convenio set cedemple='$Documento',nombres='$Empleado',codmuni='$LugarExpedicion',lugarexpedicion='$LugarE',salario='$Salario', letra='$Letras', cargo='$Cargo', fechacontratacion='$FechaContratacion',
	                 formapago='$FormaPago',direccion='$Direccion',barrio='$Barrio', cargo='$Cargo', fechanacimiento='$FechaNacimiento', municipiocontratacion='$CiudadContratacion', usuariomodificado='$UsuarioPreparador' where convenio.nroconvenio='$NroContrato'";
	         $Rs=mysql_query($SqlInserccion)or die("Error al actualizar datos del contrato INDEFINIDO");
	         $registro=mysql_affected_rows();
		 echo ("<script language=\"javascript\">");
		 echo ("open (\"ReporteContratoNuevo.php?CodReporte=$NroContrato\" ,\"\");");
		 echo ("</script>");
		 ?>
		 <script language="javascript">
		   open("ModificarConvenioCarta.php?codigo=<?echo $codigo;?>&UsuarioPreparador=<?echo $UsuarioPreparador;?>","_self");
		 </script>
	         <?
           }
}
?>
