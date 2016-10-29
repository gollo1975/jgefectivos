 <head>
                <title>Crear Centro de Costo</title>
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
         function enviar()
        {
               if (document.getElementById("cedemple").value.length <=0)
           {
                alert ("Digite el Documento del Empleado");
                document.getElementById("cedemple").focus();
                return;
           }
             document.getElementById("imacentro").submit();
        }

</script>
                <?
 if (!isset($cedemple)):
                          ?>
                               <center><h4><u>Modificar Datos</u></h4></center>
                               <form action="" method="post" id ="imacentro">
                                        <table border="0" align="center"
                                          <tr><td><br></td></tr>
                                       <tr>
                                        <td><b>Documento de identidad:</b></td>
                                        <td><input type="text" name="cedemple" value="" size="15" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
                                       </tr>
                                       <tr><td><br></td></tr>
                                        <tr><td ><input type="button" Value="Buscar" class="boton" onclick="enviar()"></td></tr>
                                        <tr><td><br></td></tr>
                                     </table>
                                 </form>
                        <?
  else:
       include("../conexion.php");
        $con="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where
             empleado.cedemple='$cedemple'";
        $resu=mysql_query($con)or die ("Consulta Incorrecta");
        $reg=mysql_num_rows($resu);
        if($reg!=0):
                include("../conexion.php");
                $con1="select centro.codcentro,decentro.*,empleado.basico,empleado.periodo from centro,empleado,decentro where
                       empleado.cedemple=centro.cedemple and
                        decentro.codcentro=centro.codcentro
                       and empleado.cedemple='$cedemple'";
                $resu1=mysql_query($con1)or die ("Consulta Incorrecta 1");
                $reg1=mysql_num_rows($resu1);
                if($reg1!=0):
                                ?>
                                <form action="eliminar.php" method="post">
                                <input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
                                <table border="0" align="center">
                                 <?
                                  while ($filas = mysql_fetch_array($resu)):
                                ?>
                                       <tr class="cajas">
                                         <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                                       </tr>
                                <?
                                  endwhile;
                                  ?>
                                  </table>
                                     <table boder="0" align="center">
                                     <tr class="cajas">
                                       <td><b>Para Modificar el Item, debe de presionar Click sobre el Cod_Salario..</b></td>
                                     </tr>
                                   </table>
                                   <table border="0" align="center">
                                    <tr class="cajas">
                                      <th><br></th><th><br></th><th><b><u>Código</u></b></th><th><b>&nbsp;<u>Concepto</u></b></th><th><b><u>Vlr_Hora</u></b></th><th><b><u>Nro_Hora</u></b></th><th><b><u>Salario</u></b></th><th><b><u>Prest.</u></b></th><th><b><u>Porcent.</u></b></th><th><b><u>Deducc.</u></b></th><th><b><u>Activo</u></b></th><th><b><u>Perman.</u></b></th>
                                     </tr>
                                     <tr>
                                        <td><br></td>
                                     </tr>
                                     <?
                                      while ($filas_s = mysql_fetch_array($resu1)):
                                         $cambio=$filas_s["salario"];
                                         $conel=$filas_s["deduccion"];
                                         $Salario=$filas_s["basico"];
                                         $Periodo=$filas_s["periodo"];
                                         $suma1=number_format($filas_s["vlrhora"]);
                                         $xcambio1= number_format($conel,2);
                                         $xcambio= number_format($cambio,2);
                                     ?>
                                       <tr class="cajas">
                                         <input type="hidden" name="codcentro" value="<? echo $filas_s["codcentro"];?>">
                                         <td>&nbsp;<input type="checkbox" name="busca[]" value="<?echo $filas_s["codsala"];?>"></td>
                                         <td>&nbsp;&nbsp;<a href="decargar.php?datos=<?echo $filas_s["codsala"];?>&conse=<?echo $filas_s["conse"];?>&cedemple=<?echo $cedemple;?>"><img src="../image/mod.jpg" border="0" alt="Permite Modificar el Registro"></a></td><td>&nbsp;&nbsp;<?echo $filas_s["codsala"];?></td>
                                         <td>&nbsp;&nbsp;<?echo $filas_s["descripcion"];?></td>
                                         <td><input type="text" value="<?echo $filas_s["vlrhora"];?>" size="11" mexlength="11" readonly></td>
                                         <td><input type="text" value="<?echo $filas_s["nrohora"];?>" size="5" mexlength="5" readonly></td>
                                         <td><input type="text" value="<?echo $xcambio;?>" size="11" mexlength="11"readonly></td>
                                         <td><input type="text" value="<?echo $filas_s["prestacion"];?>" class="cajas" size="3" mexlength="3"readonly></td>
                                         <td><input type="text" value="<?echo $filas_s["porcentaje"];?>" size="5" mexlength="5"readonly></td>
                                         <td><input type="text" value="<?echo $xcambio1;?>" size="11" mexlength="11"readonly></td>
                                         <td><input type="text" value="<?echo $filas_s["activo"];?>" size="3" readonly></td>
                                         <td><input type="text" value="<?echo $filas_s["permanente"];?>" size="3" readonly></td>
                                      </tr>
                                       <?
                                       endwhile;
                                       ?>

                                       <tr>
                                        <td align="right" colspan="2"><input type="submit" value="Eliminar" class="boton"></td>
                                       </tr>
                                   </table>
                                 </form>
                                   <?
                else:
                                   ?>
                                 <script language="javascript">
                                   alert("Este Empleado No tiene centro de costo Creado ?")
                                   open("modificar.php","_self")
                                 </script>
                                 <?
                endif;
        else:
               ?>
               <script language="javascript">
                       alert("Este Empleado, No Existe en el sistema ?")
                       open("modificar.php","_self")
               </script>
               <?
         endif;
                           $con1="select centro.codcentro,centro.cedemple,decentro.* from centro,empleado,decentro where
                                    empleado.cedemple=centro.cedemple and
                                    decentro.codcentro=centro.codcentro
                                    and empleado.cedemple='$cedemple'";
                             $resu1=mysql_query($con1)or die ("Consulta Incorrecta 1");
                             $filas=mysql_fetch_array($resu1);
                             $codcentro=$filas["codcentro"];
                             $cedemple=$filas["cedemple"];
                             $consulta = "select salario.codsala,salario.desala,salario.prestacion,salario.activo,salario.permanente,salario.control from salario where estado='ACTIVO'order by codsala,ingreso";
                              $resultado = mysql_query ($consulta) or die ("Error en la consulta 1" )
                                        ?>
                                        <td><a href="modificar.php"><b><u><h5>Regresar</h5></u></b></td>
                                        <table border="0" align="center">
                                        <input type="hidden" name="codcentro" value="<? echo $codcentro;?>">
                                          <tr class="cajas">
                                            <td><b>Para Agregar un Item, Presiones Click sobre el Cod_Salario..</b></td>
                                          </tr>
                                        </table>
                                        <form action="cargar.php" method="post">
                                          <table border="0" align="center">
                                               <tr class="cajas">
                                                <th><br></th><th><b><u>&nbsp;&nbsp;Código</u></b></th><th><b><u>Concepto</u></b></th><th><b><u>Prest.</u></b></th><th><b><u>Activo</u></b></th><th><b><u>Perma.</u></b></th><th><b><u>C.C._Visi.</u></b></th>
                                                </tr>

                                                  <?

                                                     while ($registro = mysql_fetch_array($resultado))
                                                    {
                                                    ?>
                                                     <tr class="cajas">
                                                       <td>&nbsp;&nbsp;<a href="cargardato.php?datos=<?echo $registro["codsala"];?>&codcentro=<? echo $codcentro;?>&cedemple=<?echo $cedemple;?>&Periodo=<?echo $Periodo;?>&Salario=<?echo $Salario;?>"><img src="../image/mod.jpg" border="0" alt="Permite agregar Registro"></a></td><td>&nbsp;&nbsp;&nbsp;<?echo $registro["codsala"];?></td>
                                                       <td>&nbsp;&nbsp;<?echo $registro["desala"];?></td>
                                                       <td>&nbsp;&nbsp;<?echo $registro["prestacion"];?></td>
                                                       <td>&nbsp;&nbsp;<?echo $registro["activo"];?></td>
                                                       <td>&nbsp;&nbsp;<?echo $registro["permanente"];?></td>
                                                       <td>&nbsp;&nbsp;<?echo $registro["control"];?></td>
                                                     </tr>
                                                    <?
                                                     }
                                                    ?>

                                       </table>
                                      </form>
<?
endif;
?>

</body>
</html>
