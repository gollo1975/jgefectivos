<?
 session_start();
?>
<script type="text/javascript">
        function volver()// para declara funcion
        {
                pagina='../index.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

        function actualizarSaldo()
        {
               totalCobro = document.getElementById("valor").value
               totalAutorizaciones = document.getElementById("tActualizaciones").value
               subtotal =0
               for (i=1;i<=totalAutorizaciones;i++)
               {
                        if (document.getElementById("autorizacion[" + i+ "]").checked == true )
                        {
                                subtotal = parseFloat(subtotal) + parseFloat(document.getElementById("vAutorizacion[" + i+ "]").value);
                        }
                        restante =   parseFloat (totalCobro) - parseFloat(subtotal);
                        if (restante <0 )
                        {
                           document.getElementById("autorizacion[" + i+ "]").checked = false;
//                        document.getElementById("saldo").value =  parseFloat(restante) + parseFloat(subtotal) ;
                        }
                        else
                        document.getElementById("saldo").value =  parseFloat(restante);

               }

                }
        function enviar()
        {
               if (document.getElementById("zona").value ==0 )
           {
                alert ("Debe escoger una Zona");
                document.getElementById("zona").setFocus();
                return;
           }
           if (document.getElementById("valor").value.length <=0 )
           {
                alert ("Debe escribir un valor en el campo [Total_Cobro]");
                document.getElementById("valor").setFocus();
                return;
           }



          if (document.getElementById("saldo").value != 0)
           {
                alert ("El saldo de esta cuenta de cobro no está en cero");
                return;
           }
           document.getElementById("ccobro").submit();
        }

</script>
        <head>
                <title>Descargar Mercados</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        </head>
        <body>
                <?
                if(session_is_registered("xsession")):
                if ($grabado=="ok")
                {
                 ?>
                                               <script language="javascript">
                                                 alert("Datos actualizados con éxito")
                                                </script>
                                                <?
                }


                if (strlen($zona) == 0):
                          ?>
                               <center><h4><u>Descargar Mercados</u></h4></center>
                               <form action="" method="post" name="ccobro" id ="ccobro">
                                        <table border="0" align="center"
                                          <tr>
                                              <td colspan="6"><br></td>
                                           </tr>
                <?
                                include("../conexion.php");


                                     ?>
                                     <tr>
                                     <td><b>Zona:</b></td>
                                      <td><select name="zona" class="cajas">
                                       <option value="0">Seleccione la Zona
                                      <?
                                      $codzona=$filas["codzona"];
                                                                $consulta_z="select * from zona order by zona";
                                                                $resultado_z=mysql_query($consulta_z) or die("consulta incorrecta");
                                                                while ($filas_z=mysql_fetch_array($resultado_z)):
                                                                  if ($codzona==$filas_z["codzona"]):
                                                                   ?>
                                                                                <option value="<?echo $filas_z["codzona"];?>" selected><?echo $filas_z["zona"];?>
                                                        <?
                                                                   else:
                                                        ?>
                                                                                <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
                                                         <?
                                                               endif;
                                                               endwhile;
                                                        ?>

                                      </select></td>
                                     </tr>
                                       <tr>
                                        <td><b>Fecha_Proceso:</b></td>
                                        <td><input type="text" name="fecha" value="<?echo date("Y-m-d");?>" size="11" maxlength="10"></td>
                                        </tr>
                                        <tr>
                                          <td><b>Total_Cobro:</b></td>
                                          <td><input type="text" name="valor" value="" size="11" maxlength="11" id="valor" onblur="actualizarSaldo()"  ></td></tr>
                                        <tr><td><b>Saldo:</b></td>
                                        <td><input type="text" name="saldo" size="11" maxlength="11" id="saldo" readonly="yes"></td></tr>
                                       </table>
                                                                         <?


                            $consulta = "select mercado.codmerca, concat(empleado.nomemple,' ' ,empleado.nomemple1,' ' , empleado.apemple,' ' ,empleado.apemple1) as fullname, mercado.fecha,mercado.cupo, mercado.estado from mercado, empleado where mercado.cedemple = empleado.cedemple and mercado.historia='PENDIENTE'";
                                $resultado = mysql_query ($consulta) or die ("Error en la consulta " );

//                                while ($registro = mysql_fetch_array ($resultado))
//                                {
                                        ?>

                                          <table border="0" align="center">
                                                <tr>
                                                        <td><br></td>
                                                </tr>
                                                <tr>
                                                <td><br></td><td><b>No. Autorización</b></td><td><b>Nombre Empleado</b></td><td><b>Fecha Mercado</b></td><td><b>Cupo</b></td><td><b>Estado</b></td>
                                                </tr>
                                                <tr>
                                                        <td><br></td>
                                                </tr>

                                          <?
                                                echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
                                                $i = 1;
                                            while ($registro = mysql_fetch_array($resultado))
                                            {
                                                echo ("<tr>");
                                                echo ("<td class=\"cajas\"><input type=\"checkbox\" id=name=\"autorizacion[" . $i . "]\" name=\"autorizacion[" . $i . "]\" value=\"" . $registro['codmerca'] ."\" onClick=\"actualizarSaldo()\" ></td>");
                                                echo ("<input type=\"hidden\" id = \"vAutorizacion[" . $i . "]\" value=\"" . $registro['cupo'] ."\">");
                                                echo ("<td class=\"cajas\"><center>" . $registro['codmerca'] . "</center></td>");
                                                echo ("<td class=\"cajas\">" . $registro['fullname'] . "</font></td>");
                                                echo ("<td class=\"cajas\">" . $registro['fecha'] . "</td>");
                                                echo ("<td class=\"cajas\">" . $registro['cupo'] . "</td>");
                                                echo ("<td class=\"cajas\">" . $registro['estado'] . "</td></tr>");
                                                $i = $i + 1;
                                             $aux=$aux +  $registro['cupo'] ;
                                            }
                                            $aux=number_format($aux,0);
                                          ?>
                                           </table>
                                          <br>
                                           <table border="0" align="center" >
                                             <tr><td><b>Total Cartera:</b>&nbsp;<? echo $aux;?></td></tr>
                                            </table>
                                           <table border="0" align="center" >
                                             <tr><td ><input type="button" Value="Procesar" class="boton" onclick="enviar()"></td></tr>
                                            </table>
                                          </form>
                                        <?

                 else:

                                         include("../conexion.php");
                                          $actualiza="PAGADO";
                                          $consulta = "select count(*) from cartera";
                                          $result = mysql_query ($consulta);
                                          $answ = mysql_fetch_row($result);
                                          if ($answ[0] > 0):
                                             $consulta = "select max(cast(radicado as unsigned)) + 1 from cartera";
                                            $result2 = mysql_query($consulta);
                                            $codc = mysql_fetch_row($result2);
                                            $codme= str_pad($codc[0], 4, "0", STR_PAD_LEFT);
                                          else:
                                             $codme= "0001";
                                          endif;
                                            $consulta="insert into cartera (radicado,codzona,fecha,valor)
                                                values('$codme','$zona','$fecha','$valor')";

                                              $resultado=mysql_query($consulta) or die("Insercion nueva incorrecta");

                                              //ciclo

                                              for ($i=1 ; $i<=$tActualizaciones; $i ++)
                                              {
                                                if   ($autorizacion[$i] != "" )
                                                {
                                                        $consulta1="insert into demerca (codmerca,radicado) values('$autorizacion[$i]','$codme')";
                                                      $con1="update mercado set historia='$actualiza' where mercado.codmerca='$autorizacion[$i]'";



                                                        $resultado1=mysql_query($consulta1) or die("Insercion  incorrecta demerca uno 01");
                                                        $resu1=mysql_query($con1) or die("Insercion  incorrecta");
                                                }
                                              }


                                                header ("location:agregar.php?grabado=ok");


       endif;
       else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
?>
</body>
</html>
