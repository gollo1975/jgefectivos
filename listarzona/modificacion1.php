<html>
        <head>
                <title>Modificacion de Zona</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
               if (!isset($codigo)):
                        include("../conexion.php");
                       
    $consulta="select * from zona where codzona='$cod'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
     ?>
     <script language="javascript">
       alert("No existe el registro en la bd ?")
       history.back()
     </script>
    <?
     else:
     ?><center><h4>Datos de la Zona</h4></center><?
     while($filas=mysql_fetch_array($resultado)):
       ?>

         <form action="" method="post">
           <table border="0" align="center">
             <tr>
               <td><b>Cod_Zona:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["codzona"];?>" name="codzona" size="4"class="cajas" readonly></td>
             </tr>
             <tr>
               <td><b>Zona:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["zona"];?>"name="zona" size="50"class="cajas"class="cajas" readonly></td>
             </tr>
             <tr>
               <td><b>Teléfono:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["telzona"];?>" name="telzona"size="10"  readonly></td>
             </tr>
              <tr>
               <td><b>Fax:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["faxzona"];?>"name="faxzona" size="10"  class="cajas"readonly></td>
             </tr>
            <tr>
               <td><b>Dirección:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["dirzona"];?>"name="dirzona" size="50"  class="cajas" readonly></td>
             </tr>

              <tr>
               <td><b>Barrio:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["barzona"];?>" name="barzona"size="50" class="cajas" readonly></td>
             </tr>
             <tr>
               <td><b>Email:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["emailzona"];?>" name="emailzona" size="50"  class="cajas" readonly></td>
             </tr>

             <tr>
               <td><b>Sucursal:</b></td>
               <td colspan=3><select name="departamento" class="cajas">
                 <?
                 $sucaux=$filas["codsucursal"];
                 $consulta_s="select * from sucursal";
                 $resultado_s=mysql_query($consulta_s)or die("Consulta de sucursal incorrecta");
                 while($filas_s=mysql_fetch_array($resultado_s)):
                   if ($sucaux==$filas_s["codsucursal"]):
                 ?>
                 <option value="<?echo $filas_s["codsucursal"];?>" selected><?echo $filas_s["sucursal"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_s["codsucursal"];?>"><?echo $filas_s["sucursal"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
             <tr>
               <td><b>Nit_Zona:</b></td>
               <td><input type="text" value="<?echo $filas["nitzona"];?>" name="nitzona" size="12"class="cajas" readonly></td>
               <td><b>Dv:</b></td>
               <td><input type="text" value="<?echo $filas["dvzona"];?>" name="dvzona" class="cajas" size="2" readonly></td>
             </tr>
               <tr>
                <td>&nbsp;</td>
                <td colspan=3><table width="100%">
                    <tr>
                       <td><b>Dia</b></td>
                       <td><b>Mes</b></td>
                       <td><b>Ano</b></td>
                    </tr>
                   </table>
                </td>
               </tr>
               <tr>
                <td><b>Fecha Inicio</b></td>
                <td colspan=3><table width="100%">
                <?
                    $fechaini=$filas["fechaini"];
                    $d=substr($fechaini,8,2);
                    $m=substr($fechaini,5,2);
                    $a=substr($fechaini,0,4);
                ?>
                   <tr>
                      <td><select name="d">
                        <option value="<?echo $d;?>" class="cajas"selected><?echo $d;?>
                        <option value="01">01
                        <option value="02">02
                        <option value="03">03
                        <option value="04">04
                        <option value="05">05
                        <option value="06">06
                        <option value="07">07
                        <option value="08">08
                        <option value="09">09
                        <option value="10">10
                        <option value="11">11
                        <option value="12">12
                        <option value="13">13
                        <option value="14">14
                        <option value="15">15
                        <option value="16">16
                        <option value="17">17
                        <option value="18">18
                        <option value="19">19
                        <option value="20">20
                        <option value="21">21
                        <option value="22">22
                        <option value="23">23
                        <option value="24">24
                        <option value="25">25
                        <option value="26">26
                        <option value="27">27
                        <option value="28">28
                        <option value="29">29
                        <option value="30">30
                        <option value="31">31
                    </td>
                      <td><select name="m" class="cajas">
                                                <?
                         switch ($m)
                          {
                            case 1:
                              $mes="Enero";
                               break;
                            case 2:
                              $mes="Febrero";
                               break;
                            case 3:
                               $mes="Marzo";
                                break;
                            case 4:
                               $mes="Abril";
                                break;
                            case 5:
                               $mes="Mayo";
                               break;
                            case 6:
                               $mes="Junio";
                               break;
                            case 7:
                              $mes="Julio";
                              break;
                            case 8:
                              $mes="Agosto";
                               break;
                            case 9:
                              $mes="Septiembre";
                               break;
                            case 10:
                              $mes="Octubre";
                              break;
                            case 11:
                             $mes="Noviembre";
                             break;
                            case 12:
                              $mes="Dicimebre";
                            break;
                             }
                            ?>
                            <option value="<?echo $m;?>"class="cajas" selected><?echo $mes;?>
                            <option value="01">Enero
                            <option value="02">Febrero
                            <option value="03">Marzo
                            <option value="04">Abril
                            <option value="05">Mayo
                            <option value="06">Junio
                            <option value="07">Julio
                            <option value="08">Agosto
                            <option value="09">Septiembre
                            <option value="10">Octubre
                            <option value="11">Noviembre
                            <option value="12">Diciembre
                            </td>
                              <td><select name="a">
                                  <option value="<?echo $a;?>" selected><?echo $a;?>
                                  <option value="2000">2000
                                  <option value="2001">2001
                                  <option value="2002">2002
                                  <option value="2003">2003
                                  <option value="2004">2004
                                  <option value="2005">2005
                                  <option value="2006">2006
                                  <option value="2007">2007
                                  <option value="2008">2008
                                  <option value="2009">2009
                                                <option value="2010">2010
                                                <option value="2011">2011
                                                <option value="2012">2012
                                                <option value="2013">2013
                                                <option value="2014">2014
                                                <option value="2015">2015
                                                <option value="2016">2016
                                                <option value="2017">2017
                                                <option value="2018">2018
                                                <option value="2019">2019
                                                <option value="2020">2020

                               </td>
                             </tr>
                        </table>
                </td>
       </tr>

             <tr>
               <td><b>Nomina:</b></td>
               <td><input type="text" value="<?echo $filas["nomina"];?>" name="nomina" size="10"readonly class="cajas"></td>
                <td><b>Tipo_Empresa:</b></td>
               <td colspan=3><input type="text" value="<?echo $filas["tipofactura"];?>" size="10" readonly class="cajas"></td>
             </tr>
             <tr>
               <td><b>Iva:</b></td>
               <td><input type="text" value="<?echo $filas["iva"];?>" name="nitzona" size="9" readonly></td>
               <td><b>Prestación:</b></td>
               <td><input type="text" value="<?echo $filas["prestacion"];?>" name="dvzona" class="cajas" size="10" readonly></td>
             </tr>
             <tr>
               <td><b>S.s.:</b></td>
               <td><input type="text" value="<?echo $filas["seguridad"];?>" name="nitzona" class="cajas" size="10" readonly></td>
               <td><b>Admon:</b></td>
               <td><input type="text" value="<?echo $filas["admon"];?>" name="dvzona" class="cajas" size="10" readonly></td>
             </tr>
             <tr><td><br></td></tr>


        <?
                   endwhile;
                 endif;
          endif;

        ?>
           </table>
            <?
            $con="select detalladozona.* from detalladozona,zona
            where zona.codzona=detalladozona.codzona and
                  zona.codzona='$cod'";
	    $res=mysql_query($con)or die("Consulta incorrecta");
	    $reg=mysql_num_rows($res);
            $filas_d=mysql_fetch_array($res);
	    if ($reg!=0):
               ?>
               <table border="0" align="center">
                  <tr class="letras">
                     <th>R_Legal</th>
                     <th>Celular</th>
                     <th>Contacto_Nom.</th>
                      <th>Cargo</th>
                     <th>Teléfono</th>
                     <th>Ext.</th>
                     <th>Contacto_Pago</th>
                     <th>Teléfono</th>
                     <th>Ext.</th>
                     <th>pago_Nomina</th>
                     <th>Cartera</th>
                  </tr>
                  <tr class="cajas">
                     <td><?echo $filas_d["rl"];?></td>
                     <td><?echo $filas_d["celular"];?></td>
                     <td><?echo $filas_d["contacto"];?></td>
                     <td><?echo $filas_d["cargo"];?></td>
                     <td><?echo $filas_d["telefono"];?></td>
                     <td><?echo $filas_d["ext"];?></td>
                     <td><?echo $filas_d["pagos"];?></td>
                     <td><?echo $filas_d["telefono1"];?></td>
                     <td><?echo $filas_d["ext1"];?></td>
                      <td><?echo $filas_d["pnomina"];?></td>
                     <td><?echo $filas_d["periocidad"];?></td>
                  </tr>
               </table>
               <table border="0" align="center">
                 <tr>
                     <td><b>Observacion:</b></td>
                     <td colspan="60"><textarea name="nota" cols="60" rows="6" class="cajas" readonly><?echo $filas_d["nota"];?></textarea></td>
                 </tr>
               </table>
               <?
            else:
            endif;
            ?>

                              
                </form>


        </body>
</html>
