<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function chequearcampos()
                    {

 </script>
</head>
<body>
<?
if (!isset($Hasta)){
include("../conexion.php");
?>
	<center><h4><u>Retiro de Empleados</u></h4></center>
	<form action="" method="post">
	  <table border="0" align="center">
	    <tr><td><br></td></tr>
             <tr>
                  <td><b>Empresa:</b></td>
                       <td colspan="12"><select name="NitEmpresa" class="cajas" id="NitEmpresa" style="width: 235px">
                         <?
                          $consulta_z="select maestro.codmaestro,maestro.nomaestro from maestro ";
                          $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                         while($filas_z=mysql_fetch_array($resultado_z)):
                            ?>
                            <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
                           <?
                           endwhile;
                           ?>
                           </select></td>
            </tr>
	    <tr>
		<td><b>F_Inicio:</b></td>
		<td><input type="text" name="Desde" value="<?echo date("Y-m-d");?>" size="12"class="cajas" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Desde"></td>
		<td><b>F_Final:</b></td>
		<td><input type="text" name="Hasta" value="<?echo date("Y-m-d");?>" size="12" class="cajas"maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Hasta"></td>
	    </tr>
	       <td><b>Tipo_Proceso:</b></td>
	       <td  colspan="10"><input type="radio" value="Zona"  name="Estado"><font color="red">Zona</font><input type="radio" value="Sucursal"  name="Estado"><font color="red">Sucursal</font><input type="radio" value="General"  name="Estado"><font color="red">General</font></td>
	      <tr><td><br></td></tr>
	    </tr>
	       <tr><td ><input type="submit" Value="Exportar" class="boton"></td></tr>
	  </table>
	</form>
<?
}elseif(empty($Estado)){
    ?>
     <script language="javascript">
	  alert("Seleccion el estado de exportación del registro.!")
	 history.back()
    </script>
    <?
}else{
      if($Estado=='Zona'){?>
            <center><h4><u>Retiro Empleados x Zona</u></h4></center>
	    <form action="" method="post">
		  <table border="0" align="center" width="300">
		      <tr>
		         <tr><td><br></td></tr>
		        <?
		        include("../conexion.php");?>
		        <td><b>Zona:</b></td><td><select name="select" onChange="location.href=this.value" class="cajas" style="width: 435px">
		        <option>Seleccione la zona</option>
		        <?$con="select zona.codzona,zona.zona from zona where zona.tiponegociacion='MISIONAL' and zona.estado='ACTIVA' order by zona ASC";
		        $resu=mysql_query($con)or die("Error en la busqueda de zonas");
		        while($filas=mysql_fetch_array($resu)):
		        ?>
		           <option value="DetalladoRetiro.php?CodZona=<? echo $filas["codzona"];?>&Estado=<?echo $Estado;?>&Desde=<?echo $Desde?>&Hasta=<?echo $Hasta;?>"><?echo $filas["zona"];?>
		        <?
		        endwhile;?>
		        </select></td>
		      </tr>
		      <tr><td><br></td></tr>
		  </table>
           </form>
      <?
      }else{
            if($Estado=='Sucursal'){ ?>
                 <center><h4><u>Retiro Empleados x Sucursales</u></h4></center>
	        <form action="" method="post">
		  <table border="0" align="center" width="300">
		      <tr>
		         <tr><td><br></td></tr>
		        <?
		        include("../conexion.php");?>
		        <td><b>Zona:</b></td><td><select name="select" onChange="location.href=this.value" class="cajas" style="width: 235px">
		        <option>Seleccione la sucursal</option>
		        <?$con="select sucursal.codsucursal,sucursal.sucursal from sucursal where sucursal.estado='ACTIVA' order by sucursal ASC";
		        $resu=mysql_query($con)or die("Error en la busqueda de zonas");
		        while($filas=mysql_fetch_array($resu)):
		        ?>
		           <option value="DetalladoRetiro.php?CodSucursal=<? echo $filas["codsucursal"];?>&Estado=<?echo $Estado;?>&Desde=<?echo $Desde?>&Hasta=<?echo $Hasta;?>"><?echo $filas["sucursal"];?>
		        <?
		        endwhile;?>
		        </select></td>
		      </tr>
		      <tr><td><br></td></tr>
		  </table>
                </form>
                <?
            }else{
                  include("../conexion.php");
                  $Sql="select contrato.*,zona.zona, concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as Empleado,empleado.cedemple,empleado.diremple,
					empleado.telemple,empleado.email,empleado.celular,sucursal.sucursal from zona,contrato,empleado,sucursal,maestro
					where contrato.codzona=zona.codzona and
					   zona.codsucursal=sucursal.codsucursal and
					   sucursal.codmaestro=maestro.codmaestro and
					   maestro.codmaestro='$NitEmpresa' and	
					  contrato.fechater between '$Desde' and '$Hasta' and
					   contrato.codemple=empleado.codemple order by sucursal.sucursal";
	          $Rs=mysql_query($Sql)or die ("Error al buscar los empleados en general" );
	          $Cont=mysql_num_rows($Rs);
                  if($Cont==0){
                      ?>
                        <script language="javascript">
                                alert("No hay empleados retirados en este rango de fechas.!")
                                history.back()
                        </script>
                      <?
                 }else{
                       header("Content-type: application/vnd.ms-excel");
                       header("Content-Disposition: attachment; filename=Empleados Retirados.xls");
                       header("Pragma: no-cache");
                       header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                       header("Expires: 0");
                       ?>
                       <table border="0" align="center">
                            <tr class="cajas">
	                          <td style='font-weight:bold;font-size:1.1em;'>Nro</td>
	                          <td style='font-weight:bold;font-size:1.1em;'>Nro_Contrato</td>
	                            <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
	                            <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
	                            <td style='font-weight:bold;font-size:1.1em;'>Teléfono</td>
	                            <td style='font-weight:bold;font-size:1.1em;'>Dirección</td>
	                            <td style='font-weight:bold;font-size:1.1em;'>Celular</td>
                                    <td style='font-weight:bold;font-size:1.1em;'>Email</td>
                                    <td style='font-weight:bold;font-size:1.1em;'>F_Ingreso</td>
                                    <td style='font-weight:bold;font-size:1.1em;'>F_retiro</td>
                                    <td style='font-weight:bold;font-size:1.1em;'>Dias_Laborados</td>
									<td style='font-weight:bold;font-size:1.1em;'>Cargo</td>
		                            <td style='font-weight:bold;font-size:1.1em;'>Salario</td>
	                                <td style='font-weight:bold;font-size:1.1em;'>Sucursal</td>
									<td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                                    
                            </tr>
                            <?
                            $i=1;
                            while ($filas=mysql_fetch_array($Rs)):
                                  ?>
                                   <tr class="cajas">
                                        <td><?echo $i;?></td>
                                        <td><?echo $filas["contrato"];?></td>
                                        <td><?echo $filas["cedemple"];?></td>
                                        <td><?echo $filas["Empleado"];?></td>
                                        <td><?echo $filas["telemple"];?></td>
                                        <td><?echo $filas["diremple"];?></td>
                                        <td><?echo $filas["celular"];?></td>
                                        <td><?echo $filas["email"];?></td>
                                        <td><?echo $filas["fechainic"];?></td>
                                        <td><?echo $filas["fechater"];?></td>
                                        <td><?echo $DiasLaborados;?></td>
										 <td><?echo $filas["cargo"];?></td>
										  <td><?echo $filas["salario"];?></td>
                                        <td><?echo $filas["zona"];?></td>
										 <td><?echo $filas["sucursal"];?></td>
                                       </tr>
                               <?
                               $i=$i+1;
                              endwhile;

                  }

            }
      }
}
?>
</body>
</html>
