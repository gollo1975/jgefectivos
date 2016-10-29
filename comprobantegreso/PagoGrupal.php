<html>
<head>
  <title>Comprobante</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if(!isset($empresa)){
include("../conexion.php");
?>
  <center><h4><u>Comprobante Egreso</u></h4></center>
  <form action="" method="post">
  <input type="hidden" value="<?echo $Usuario;?>" name="Usuario" id="Usuario">
     <table border="0" align="center">
       <tr>
       <tr><td><br></td></tr>
          <td colspan="5"><b>Empresa:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="empresa" class="cajas">
                 <option value="0">Seleccione la Empresa
                    <?
                     $consulta="select codmaestro,nomaestro from maestro order by nomaestro";
                     $resultado=mysql_query($consulta) or die("error al buscar empresa");
                      while ($filas=mysql_fetch_array($resultado)):
                          ?>
                          <option value="<?echo $filas["codmaestro"];?>"><?echo $filas["nomaestro"];?>
                          <?
                     endwhile;
                        ?>
               </select>
           </td>
        </tr>
        <tr>
          <td><b>Tipo_Proceso:</b></td>
          <td><input type="radio" value="SI" name="estado">Causado<input type="radio" value="NO" name="estado">No Causado</td>
        </tr>
        <tr>
          <td><b>Tipo_Pago:</b></td>
          <td><input type="radio" value="compra" name="tipopago">Compras<input type="radio" value="nomina" name="tipopago">Nómina<input type="radio" value="prestacion" name="tipopago">Prestaciones<input type="radio" value="empleado" name="tipopago">Empleado<input type="radio" value="vacacion" name="tipopago">Vacaciones<input type="radio" value="prima" name="tipopago">Primas<input type="radio" value="Deduccion" name="tipopago">Deducciones</td>
        </tr>
        <tr>
           <td><b>Tipo_Proceso:</b></td>
           <td><select name="TipoNomina" class="cajas">
             <option value="0">Seleccion el Proceso
             <option value="INDIVIDUAL">INDIVIDUAL
             <option value="GRUPAL">GRUPAL
             </selected></td>
        </tr>
      <tr><td><br></td></tr>
        <td colspan="5">
          <input type="submit" value="Buscar" class="boton" >&nbsp;<input type="reset" value="Limpiar" class="boton" ></td>
    </table>
  </form>
<?
}elseif(empty($empresa)){
  ?>
  <script language="javascript">
    alert("Seleccione la empresa para continuar.?")
    history.back()
  </script>
  <?
}elseif(empty($estado)){
  ?>
  <script language="javascript">
    alert("Seleccione el tipo de proceso?")
    history.back()
  </script>
  <?
}else{
     if($estado=='NO' and $tipopago!=''){
        ?>
	  <script language="javascript">
	    alert("Favor no seleccionar el tipo de pago?")
	    history.back()
	  </script>
	  <?
      }else{
        if($estado=='SI' and $tipopago==''){
           ?>
	    <script language="javascript">
	      alert("Favor no seleccionar el tipo de pago?")
	      history.back()
	     </script>
	    <?
          }else{
	     include("../conexion.php");
             if($tipopago=='compra' or $tipopago=='prestacion' or $estado=='NO'or $tipopago=='empleado'){
                 if($TipoNomina=='INDIVIDUAL'){
	             $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
	             where  maestro.codmuni=municipio.codmuni and
	             maestro.codmaestro='$empresa'";
	             $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
		     $reg1=mysql_affected_rows();
		     $filas=mysql_fetch_array($resu1);
		     $Empresa=$filas["nomaestro"];
		     $NitEmpresa=$filas["codmaestro"];
		     $Dv=$filas["dvmaestro"];
		     $Direccion=$filas["dirmaestro"];
		     $Telefono=$filas["telmaestro"];
		     $Municipio=$filas["municipio"];
	             header("location: CrearPago.php?NitEmpresa=$NitEmpresa&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa&Usuario=$Usuario");
                  }
                   if($TipoNomina=='GRUPAL' and $tipopago=='prestacion'){
                              $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
			         where  maestro.codmuni=municipio.codmuni and
			         maestro.codmaestro='$empresa'";
			         $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
				 $reg1=mysql_affected_rows();
				 $filas=mysql_fetch_array($resu1);
				 $Empresa=$filas["nomaestro"];
				 $NitEmpresa=$filas["codmaestro"];
				 $Dv=$filas["dvmaestro"];
				 $Direccion=$filas["dirmaestro"];
				 $Telefono=$filas["telmaestro"];
				 $Municipio=$filas["municipio"];
			         header("location: CrearPagoPrestacion.php?NitEmpresa=$NitEmpresa&TipoNomina=$tipopago&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa&Usuario=$Usuario ");
                  }else{
                  /*codigo que permite mostrar las compras por agrupacion*/
                       if($TipoNomina=='GRUPAL' and $tipopago=='compra'){
                              $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
		                      where  maestro.codmuni=municipio.codmuni and
		                      maestro.codmaestro='$empresa'";
		                      $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
		                      $reg1=mysql_affected_rows();
			              $filas=mysql_fetch_array($resu1);
			              $Empresa=$filas["nomaestro"];
			              $NitEmpresa=$filas["codmaestro"];
			              $Dv=$filas["dvmaestro"];
			              $Direccion=$filas["dirmaestro"];
			              $Telefono=$filas["telmaestro"];
			              $Municipio=$filas["municipio"];
			             header("location: CrearPagoDeduccionCompras.php?NitEmpresa=$NitEmpresa&TipoNomina=$tipopago&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa&Usuario=$Usuario");
                       }else{
                            ?>
		            <script language="javascript">
			      alert("Favor no seleccionar el tipo de proceso..?")
			      history.back()
			     </script>
			    <?
                      }
                  }
             }else{
                if($tipopago=='nomina'){
                   if($TipoNomina=='INDIVIDUAL'){
                      $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
                      where  maestro.codmuni=municipio.codmuni and
                      maestro.codmaestro='$empresa'";
                      $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
                      $reg1=mysql_affected_rows();
	              $filas=mysql_fetch_array($resu1);
	              $Empresa=$filas["nomaestro"];
	              $NitEmpresa=$filas["codmaestro"];
	              $Dv=$filas["dvmaestro"];
	              $Direccion=$filas["dirmaestro"];
	              $Telefono=$filas["telmaestro"];
	              $Municipio=$filas["municipio"];
	              header("location: CrearPagoNomina.php?TipoNomina=$TipoNomina&NitEmpresa=$NitEmpresa&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa&Usuario=$Usuario");
                   }else{
                      if($TipoNomina=='GRUPAL'){
	                      $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
	                      where  maestro.codmuni=municipio.codmuni and
	                      maestro.codmaestro='$empresa'";
	                      $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
	                      $reg1=mysql_affected_rows();
		              $filas=mysql_fetch_array($resu1);
		              $Empresa=$filas["nomaestro"];
		              $NitEmpresa=$filas["codmaestro"];
		              $Dv=$filas["dvmaestro"];
		              $Direccion=$filas["dirmaestro"];
		              $Telefono=$filas["telmaestro"];
		              $Municipio=$filas["municipio"];
		              header("location: CrearPagoNominaGrupal.php?TipoNomina=$TipoNomina&NitEmpresa=$NitEmpresa&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa&Usuario=$Usuario");
                      }else{
                         ?>
                         <script language="javascript">
                            alert("Debe de Seleccionar el tipo de comprobante para Nómina")
                            history.back()
                         </script>
                         <?
                      }
                   }
                }else{
                    if($tipopago=='vacacion'){
                        if($TipoNomina=='INDIVIDUAL'){
		                 $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
			         where  maestro.codmuni=municipio.codmuni and
			         maestro.codmaestro='$empresa'";
			         $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
				 $reg1=mysql_affected_rows();
				 $filas=mysql_fetch_array($resu1);
				 $Empresa=$filas["nomaestro"];
				 $NitEmpresa=$filas["codmaestro"];
				 $Dv=$filas["dvmaestro"];
				 $Direccion=$filas["dirmaestro"];
				 $Telefono=$filas["telmaestro"];
				 $Municipio=$filas["municipio"];
			         header("location: CrearPago.php?NitEmpresa=$NitEmpresa&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa&Usuario=$Usuario");
                        }else{
                           if($TipoNomina=='GRUPAL'){
                              $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
			         where  maestro.codmuni=municipio.codmuni and
			         maestro.codmaestro='$empresa'";
			         $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
				 $reg1=mysql_affected_rows();
				 $filas=mysql_fetch_array($resu1);
				 $Empresa=$filas["nomaestro"];
				 $NitEmpresa=$filas["codmaestro"];
				 $Dv=$filas["dvmaestro"];
				 $Direccion=$filas["dirmaestro"];
				 $Telefono=$filas["telmaestro"];
				 $Municipio=$filas["municipio"];
			         header("location: CrearPagoVacacion.php?NitEmpresa=$NitEmpresa&TipoNomina=$tipopago&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa&Usuario=$Usuario");
                          }else{
                            ?>
                             <script language="javascript">
                                alert("Debe de Seleccionar el tipo de comprobante para vacaciones")
                                history.back()
                            </script>
                            <?
                          }
                        }
                    }else{
                        if($TipoNomina=='INDIVIDUAL'){
                            ?>
                             <script language="javascript">
                                alert("Esta opción no aplica para comprobantes de primas")
                                history.back()
                            </script>
                            <?
                        }else{
                              if($tipopago=='prima'){
	                          if($TipoNomina=='GRUPAL'){
	                             $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
		                      where  maestro.codmuni=municipio.codmuni and
		                      maestro.codmaestro='$empresa'";
		                      $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
		                      $reg1=mysql_affected_rows();
			              $filas=mysql_fetch_array($resu1);
			              $Empresa=$filas["nomaestro"];
			              $NitEmpresa=$filas["codmaestro"];
			              $Dv=$filas["dvmaestro"];
			              $Direccion=$filas["dirmaestro"];
			              $Telefono=$filas["telmaestro"];
			              $Municipio=$filas["municipio"];
			              header("location: CrearPagoPrimaGrupal.php?TipoNomina=$TipoNomina&NitEmpresa=$NitEmpresa&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa&Usuario=$Usuario");
	                          }else{
	                            ?>
	                             <script language="javascript">
	                                alert("Debe de Seleccionar el tipo de comprobante para primas")
	                                history.back()
	                            </script>
	                            <?
	                          }
                              }else{
                                   if($TipoNomina=='GRUPAL'){
	                             $con1="select  maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio from maestro,municipio
		                      where  maestro.codmuni=municipio.codmuni and
		                      maestro.codmaestro='$empresa'";
		                      $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
		                      $reg1=mysql_affected_rows();
			              $filas=mysql_fetch_array($resu1);
			              $Empresa=$filas["nomaestro"];
			              $NitEmpresa=$filas["codmaestro"];
			              $Dv=$filas["dvmaestro"];
			              $Direccion=$filas["dirmaestro"];
			              $Telefono=$filas["telmaestro"];
			              $Municipio=$filas["municipio"];
			             header("location: CrearPagoDeduccion.php?NitEmpresa=$NitEmpresa&TipoNomina=$tipopago&Dv=$Dv&TipoPago=$tipopago&estado=$estado&Direccion=$Direccion&Telefono=$Telefono&Municipio=$Municipio&Empresa=$Empresa&Usuario=$Usuario");
	                          }else{
	                            ?>
	                             <script language="javascript">
	                                alert("Debe de Seleccionar el tipo de comprobante para deducciones")
	                                history.back()
	                            </script>
	                            <?
	                          }
                              }
                       }
                    }
                }
             }
          }
     }
}
  ?>
</body>
</html>
