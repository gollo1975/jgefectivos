<head>
                <title>Centro de Nómina</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <script type="text/javascript">
 function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
         function enviar()
        {
               if (document.getElementById("cedemple").value.length <=0)
           {
                alert ("Digite el Documento del Empleado para procesar la informacion.!");
                document.getElementById("cedemple").focus();
                return;
           }
             document.getElementById("imacentro").submit();
        }

</script>
<?
if (!isset($cedemple)){
   include("../conexion.php");
   ?>
    <center><h4><u>Centro de Nómina</u></h4></center>
    <form action="" method="post" id ="imacentro">
        <table border="0" align="center"
            <tr><td><br></td></tr>
            <tr>
                <td><b>Documento de identidad:</b></td>
                <td><input type="text" name="cedemple" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
            </tr>
             <tr>
        <td><b>Auxilio:</b></td>
             <td colspan="12"><select name="CodUnico" class="cajas">
                  <?
                  $consulta="select codsala,desala from salario where salario.formapago='DIAS'";
                   $resultado=mysql_query($consulta)or die ("consulta incorrecta");
                    while($filas=mysql_fetch_array($resultado)){?>
                        <option value="<?echo $filas["codsala"];?>"> <?echo $filas["desala"];?>
                       <?
                    }
                       ?>
              </select></td>
        </tr>
            <tr><td><br></td></tr>
            <tr><td ><input type="button" Value="Buscar" class="boton" onclick="enviar()"></td></tr>
        </table>
    </form>
<?
}else{
     include("../conexion.php");
      $conE="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as Nombres,contrato.zona,empleado.basico from empleado,contrato where
         empleado.codemple=contrato.codemple and
        contrato.fechater='0000-00-00' and
        empleado.cedemple='$cedemple' and
        empleado.nomina='SI'";
     $resuE=mysql_query($conE)or die ("Consulta Incorrecta de Empleado");
     $PagarE=mysql_num_rows($resuE);
     $filas_E = mysql_fetch_array($resuE);
     $Nombres=$filas_E["Nombres"];
     $Zona=$filas_E["zona"];
     $Basico=$filas_E["basico"];
     /*CODIGO QUE ACTUALIZA EL AUXILIO DE TRANSPORTE*/
      $conT="select decentro.*,empleado.basico,centro.codcentro,salario.ayuda,salario.formapago,salario.totalhoras from empleado,centro,decentro,salario
            where empleado.cedemple=centro.cedemple and
            centro.codcentro=decentro.codcentro and
            decentro.codsala=salario.codsala and
            salario.codsala='$CodUnico' and
            empleado.cedemple='$cedemple'";
      $resuT=mysql_query($conT)or die ("eRROR al buscar el auxilio de trasnporte");
      $filas_T = mysql_fetch_array($resuT);
      $CodC=$filas_T["codcentro"];
      $AyudaTP=$filas_T["ayuda"];
      $FormaP=$filas_T["formapago"];
      $TotalH=$filas_T["totalhoras"];
      if($FormaP=='DIAS' and $TotalH=='NO'){
           $AuxH= $AyudaTP/30;
	   $conA="update decentro set vlrhora='$AuxH' where decentro.codcentro='$CodC' and decentro.codsala='$CodUnico'";
	   $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina sexto");
	   $datos=mysql_affected_rows();
      }
      if($PagarE != 0){
        /*CODIGO QUE BUSCA Y ACTUALIZAR*/
         $conM="select parametroauxilio.maximo,parametroauxilio.porincapacidad,parametroauxilio.minimo,parametroauxilio.valor from parametroauxilio
            where parametroauxilio.estado='ACTIVO'";
         $ReM=mysql_query($conM)or die("Error al buscar salario maximo");
         $filas_M=mysql_fetch_array($ReM);
         $Maximo=$filas_M["maximo"];
         $PorIncapa=$filas_M["porincapacidad"];
         $Minimo=$filas_M["minimo"];
         $AyudaT=$filas_M["valor"];
         /*CODIGO QUE BUESCA EL SALARIO*/
         $conS="select empleado.basico from empleado
         where empleado.cedemple='$cedemple'";
         $Res=mysql_query($conS)or die("Error al buscar salario");
         $filas=mysql_fetch_array($Res);
         $Basico=$filas["basico"];
         /*CODIGO QUE BUSCA EL CENTRO DE NOMINA*/
         $conE="select decentro.*,empleado.basico,centro.codcentro from empleado,centro,decentro
         where empleado.cedemple=centro.cedemple and
               centro.codcentro=decentro.codcentro and
               decentro.prestacion='SI' and
               empleado.cedemple='$cedemple'";
         $resuE=mysql_query($conE)or die ("Error al validar la Empleado");
         while ($filas_E=mysql_fetch_array($resuE)){
             $CodSala=$filas_E["codsala"];
             $CodCentro=$filas_E["codcentro"];
             $conB="select salario.codsala,salario.formapago,salario.totalhoras,salario.porcentaje from salario
             where  salario.estado='ACTIVO' and
                   salario.codsala='$CodSala'";
              $ResB=mysql_query($conB)or die("Error al buscar codigos de salario");
              $filas_S=mysql_fetch_array($ResB);
              $FormaPago=$filas_S["formapago"];
              $TotalHora=$filas_S["totalhoras"];
              $Porcentaje=$filas_S["porcentaje"];
              if($FormaPago=='HORAS' and $TotalHora=='SI'){
                 $Aux01=($Basico/30/8);
                 $conA="update decentro set vlrhora='$Aux01' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
                 $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina Uno");
                 $datos=mysql_affected_rows();
              }else{
                  if($FormaPago=='HORAS' and $TotalHora=='NO'){
                     $AuxH= $Basico/30/8;
                     $AuxTiempo=($AuxH * $Porcentaje)/100;
                     $conA="update decentro set vlrhora='$AuxTiempo' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
                     $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina Dos");
                     $datos=mysql_affected_rows();
                  }else{
                       if($FormaPago=='HORAS' and $TotalHora=='IGUAL'){
                             $AuxH=($Basico/30/8);
	                     $AuxTiempo=($AuxH * $Porcentaje)/100;
	                     $conA="update decentro set vlrhora='$AuxTiempo' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
	                     $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina Tres");
	                     $datos=mysql_affected_rows();
                       }else{
                            if($FormaPago=='HORAS' and $TotalHora=='ING'){
                                  $VarT=round($Minimo * $PorIncapa);
                                 if($Basico <= $VarT){
                                    $AuxH = $Minimo/30/8;
		                    $conA = "update decentro set vlrhora='$AuxH' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
		                    $ResA = mysql_query($conA)or die("Error al actualizar el centro de Nomina cuatro");
		                    $datos = mysql_affected_rows();
                                }else{
                                   $AuxH = $Basico/30/8;
                                    $AuxIncapa=($AuxH * $Porcentaje)/100;
		                    $conA="update decentro set vlrhora='$AuxIncapa' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
		                    $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina quinto");
		                    $datos=mysql_affected_rows();
                                }
                            }else{
                                 if($FormaPago=='NINGUNA' and $TotalHora=='ING'){
                                      $AuxH= $Basico/30/8;
		                      $conA="update decentro set vlrhora='$AuxH' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSala'";
		                      $ResA=mysql_query($conA)or die("Error al actualizar el centro de Nomina sexto");
		                      $datos=mysql_affected_rows();
                                 }
                            }
                       }
                 }
              }
         }/*cierra ciclo del mientras*/
           /*FIN CODIGO*/
           $conP="select decentro.* from empleado,centro,decentro
                where empleado.cedemple=centro.cedemple and
                centro.codcentro=decentro.codcentro and
                empleado.cedemple='$cedemple' order by decentro.codsala";
            $resuP=mysql_query($conP)or die ("Error al buscar el centro de nomina");
            $ConP=mysql_num_rows($resuP);
            if($ConP==0){
                     ?>
                      <script language="javascript">
                         alert("Este empleado no tiene centro de nomina generado.!")
                         history.back()
                      </script>
                      <?
            }else{
                     ?>
                     <center><h4><u>Centro de Costo</u></h4></center>
                     <form action="" method="post">
                          <table border="0" align="center">
                              <tr>
                                 <td><b>Documento:</b></td>
                                 <td><input type="text" name="cedemple" value="<? echo $cedemple;?>" size="15" class="cajas"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
                              </tr>
                              <tr>
                                 <td><b>Empleado:</b></td>
                                    <td><input type="text"  value="<? echo $Nombres;?>" name="nombre" class="cajas" size="50"  readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
                              </tr>
                              <tr>
                                  <td><b>Zona:</b></td>
                                  <td><input type="text"  value="<? echo $Zona;?>" name="zona" class="cajas" size="50"  readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona"></td>
                              </tr>
		          </table>
                          <table border="0" align="center">
	                      <tr>
	                          <th>#</th> <th>Cod_Sala.</th><th><b>Concepto</b></th><th><b>Vrl_Hora</b></th><th><b>Nro_Hora</b></th><th><b>Salario</b></th><th><b>Prest.</b></th><th><b>%Por.</b></th><th><b>Deducción</b></th><th><b>Actiov</b></th><th><b>Perma.</b></th>
	                      </tr>
	                      <?
	                      $i=1;
	                      echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resuP) . "\">");
	                      while ($registro = mysql_fetch_array($resuP)):
	                                         ?>
						 <tr class="cajas">
                                                 <th><? echo $i;?></th>
						     <td class="cajas"><input type="text" value="<?echo $registro["codsala"];?>"  size="7" readonly class="cajas"></td>
						     <td class="cajas"><input type="text" value="<?echo $registro["descripcion"];?>"  size="50" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["vlrhora"];?>"  size="9" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["nrohora"];?>" size="9" readonly class="cajas"></td>
                                                     <td class="cajas"><input type="text" value="<?echo $registro["salario"];?>"  size="11" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["prestacion"];?>" size="3" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["porcentaje"];?>"  size="6" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["deduccion"];?>" size="11" readonly class="cajas"></td>
	                                             <td class="cajas"><input type="text" value="<?echo $registro["activo"];?>"  size="3" readonly class="cajas"></td>
                                                     <td class="cajas"><input type="text" value="<?echo $registro["permanente"];?>" size="3" readonly class="cajas"></td>
						 <tr>
					         <?
						 $i=$i+1;
	                                   endwhile;
	                                    ?>

	                              </table>
	                              <tr><td><br></td></tr>
	                              <center><td ><a href="ActualizarCentroIndividual.php"><h4><u><font color="blue">Otra Consulta</font></u></h4></a></td></center>
	             </form><?
            }
     }else{
     ?>
         <script language="javascript">
             alert("El documento digitado no existe en sistema o el contrato esta cerrado.!")
             history.back()
         </script>
     <?
    }
}
?>
</body>
</html>
