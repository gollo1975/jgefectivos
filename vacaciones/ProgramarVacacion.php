
<html>
<head>
<title></title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>
<body>
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
                        if (document.getElementById("Documento").value.length <=0)
                        {
                            alert ("Digite el Documento del Empleado para consultar..");
                            document.getElementById("Documento").focus();
                            return;
                        }
                        document.getElementById("contrato").submit();
                    }


</script>
<?
if (empty($Documento)):
?>
  <center><h4><u>Programar Vacaciones</u><h4></center>
  <form action="" method="post" id="contrato">
    <input type="hidden" name="Usuario" value="<?echo $Usuario?>" id="Usuario">
    <table border="0" align="center">
     <tr><td><br></td></tr>
      <tr>
       <td><b>Documento de Identidad:</b></td>
         <td><input type="text" name="Documento" value="" size="14" maxlength="14" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento">
     </tr>
     <tr>
        <td><b>Tipo_Proceso:</b></td>
        <td><input type="radio" value="Agregar" checked name="TipoP"><b>Agregar</b><input type="radio" value="Modificar"  name="TipoP"><b>Modificar</b></td>
     </tr>
      <tr><td><br></td></tr>
      <tr>
         <td colspan="5">
           <input type="button" value="Buscar Dato" class="boton" onclick="chequearcampos()">
         </td>
       </tr>
      </table>
    </form>
    <?
    else:
        if($TipoP=='Agregar'){
	      include("../conexion.php");
	      $busca="select empleado.codemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona,zona.codzona from zona,empleado
	             where  zona.codzona=empleado.codzona and
	                    empleado.cedemple='$Documento'";
	      $resultado=mysql_query($busca)or die("Error de Busqueda");
	      $registro=mysql_num_rows($resultado);
	      $filas=mysql_fetch_array($resultado);
	      if ($registro!=0):
	           $consulta="select empleado.codemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato
	              where contrato.codemple=empleado.codemple and
	                   contrato.fechater = '0000-00-00' and
	                   empleado.cedemple='$Documento'";
	              $result=mysql_query($consulta)or die("Error de Busqueda contrato");
	              $regi=mysql_num_rows($result);
	             if($regi ==0):
	                   ?>
	                <script language="javascript">
	                  alert("Este empleado aparece retirado de la compañia..!")
	                  history.back()
	                </script>
	                  <?
	            else:
	                ?>
	                 <h4><div align="center"><u>Programar Vacaciones</u></div></h4>
	                  <form action="GrabarProgramacion.php" method="post" id="nuevo">
	                   <input type="hidden" name="Usuario" value="<?echo $Usuario?>" id="Usuario">
	                   <table border="0" align="center">
	                    <tr>
	                      <td><b>Documento:</b></td>
	                       <td><input type="text"  value="<? echo $Documento;?>" size="13" name="Documento" class="cajas" readonly id="Documento"><td>
	                   </tr>
	                   <tr>
	                      <td><b>Empleado:</b></td>
	                       <td><input type="text"  value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>"class="cajas" size="45" readonly></td>
	                   </tr>
	                   <tr>
	                      <td><b>Desde:</b></td>
	                       <td><input type="text" name="Desde" value="<?echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Desde"></td>
	                   </tr>
	                   <tr>
	                       <td><b>Hasta:</b></td>
	                       <td><input type="text" name="Hasta" value="<?echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Hasta"></td>
	                   </tr>
	                   <tr>
	                       <td><b>Dias:</b></td>
	                       <td><input type="text" name="Dias" value="" size="13" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Dias">
	                   </tr>
	                    <tr>
	                       <td><b>Zona:</b></td>
	                       <td><input type="text"  value="<?echo $filas["zona"];?>" size="45" maxlength="45" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly>
	                   </tr>
	                   <tr>
	                     <td><b>Cod_Salario:</b></td>
	                      <td><select name="Codigo" class="cajas" id="Codigo">
	                         <option value="0">Seleccione
	                          <?
	                            $conS="select codsala,desala from salario where salario.ibcprestacional='SI' ";
	                            $resuS=mysql_query($conS)or die ("error al buscar salarios");
	                            while($fila=mysql_fetch_array($resuS)):
	                              ?>
	                              <option value="<?echo $fila["codsala"];?>"><?echo $fila["desala"];?>
	                              <?
	                              endwhile;
	                      ?></select></td>
	                   </tr>
	                   <tr>

	                       <input type="hidden" name="CodZona" value="<?echo $filas["codzona"];?>" size="4" id="CodZona">
	                    </tr>
	                   <tr><td><br></td></tr>
	                   <tr>
	                         <td colspan="2">
	                           <input type="submit" value="Guardar" class="boton" id="grabar" name="grabar">
	                         </td>
	                       </tr>
	                      </table>
	                 </form>
	             <?
	            endif;
	       else:

	        ?>
	        <script language="javascript">
	          alert("Este empleado no existe en el Sistema de la Empresa..!")
	          history.back()
	        </script>
	        <?
	     endif;
         }else{
              include("../conexion.php");
                $busca="select vacacionprogramada.*,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona from zona,empleado,vacacionprogramada
	             where  zona.codzona=vacacionprogramada.codzona and
                            empleado.cedemple=vacacionprogramada.cedemple and
                            empleado.cedemple='$Documento'";
	      $resultado=mysql_query($busca)or die("Error de Busqueda");
	      $registro=mysql_num_rows($resultado);
              if($registro != 0){?>
                    <div align="center"><b><h4>Listado de Programaciones</h4></b></div>
                    <table border="0" align="center" width="500">
                        <tr class="cajas">
                           <th>#</th>
                           <th>Nro_Id</th>
                           <th>Desde</th>
                           <th>Hasta</th>
                           <th>F_Proceso</th>
                           <th>Dias</th>
                           <th>Zona</th>
                        </tr>
                        <?
                        $a=1;
                        while($fila=mysql_fetch_array($resultado)){
                            ?>
                             <tr class="cajas">
                                 <th><?echo $a;?></th>
                                 <td><div align="center"><a href="DetalleVacacion.php?Id_V=<?echo $fila["codigo_vacacion_programada_pk"];?>&Usuario=<?echo $Usuario;?>"><?echo $fila["codigo_vacacion_programada_pk"];?></a></div></td>
                                 <td><?echo $fila["desde"];?></td>
                                 <td><?echo $fila["hasta"];?></td>
                                 <td><?echo $fila["fecha_proceso"];?></td>
                                  <td><div align="center"><?echo $fila["dias"];?></div></td>
                                 <td><?echo $fila["zona"];?></td>
                             </tr>
                            <?
                            $a = $a+1;
                        }
                        ?>
                    </table>
                   <?
              }else{
                  ?>
                  <script language="javascript">
                     alert("No presenta informacion para ser modificada..!")
                     history.back()
                  </script>
                  <?
              }
         }
        endif;
 ?>
 </body>
</html>
