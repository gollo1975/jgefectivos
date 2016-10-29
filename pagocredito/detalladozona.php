<html>

<head>
<title>Créditos por Zona</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
     include("../conexion.php");
     $variable="select zona.zona from zona where
                zona.codzona='$codzona'";
         $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
          ?>
                 <table border="0" align="center">
                 <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">
                 <td><?echo $filas["zona"];?></td>
               </tr>
                <?
              endwhile;
           ?>
           </table>
           <?
            include("../conexion.php");
            $variable1="SELECT empleado.cedemple, empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1, credito.nrocredito, salario.desala, credito.fesalida, credito.vlrsolicitado, credito.nuevo, credito.cuota, credito.vlrinteres
                        FROM empleado, credito, salario, zona
                        WHERE zona.codzona = empleado.codzona
                        AND empleado.cedemple = credito.cedemple
                        AND credito.codsala = salario.codsala
                        and credito.nuevo > 0
                        AND zona.codzona = '$codzona'
                        ORDER BY empleado.nomemple";
           $resultado1=mysql_query($variable1)or die("consulta incorrecta dos");
           $registro=mysql_num_rows($resultado1);
            ?>
         <tr><td><br></td></td>
         <td><center><h5>Listado de Creditos</h5></center></td>
          <table align="center">
                <tr>
                  <td class="cajas">Para Imprimir el crédito, presione Click sobre el Nro de Crédito, Para ver el Listado de Crédito por empleado, Presione Click sobre el Documento </td>
                </tr>
          </table>
              <tr><td><br></td></td>  
          <table border="1" align="center">
           <tr>
             <td colspan="30" class="fondo"></td>
           </tr>
           <tr class="cajas">
              <th class="fondo">Cedula</th>
              <th class="fondo">Empleado</th>
              <th class="fondo">Nro_Credito</th>
              <th class="fondo">Descripción</th>
              <th class="fondo">Fecha_Salida</th>
              <th class="fondo">Vlr_Solici.</th>
              <th class="fondo">Saldo</th>
              <th class="fondo">Cuota</th>
              <th class="fondo">Interes</th>
           </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
                 $solicitud=number_format($filas_s["vlrsolicitado"],0); 
                 $cuota=number_format($filas_s["cuota"],0);
                 $nuevo=number_format($filas_s["nuevo"],0); 
              ?>
               <tr class="cajas">
                 <td>&nbsp;<a href="detalladocredito1.php?cedemple=<?echo $filas_s["cedemple"];?>"><?echo $filas_s["cedemple"];?></a></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                <td>&nbsp;<a href="imprimir.php?nrocredito=<?echo $filas_s["nrocredito"];?>"><?echo $filas_s["nrocredito"];?></a></td>
                 <td><?echo $filas_s["desala"];?></td>
                 <td><?echo $filas_s["fesalida"];?></td>
                 <td><?echo $solicitud;?></td>
                 <td><?echo $nuevo;?></td>
                <td><?echo $cuota;   ?></td>
                 <td><?echo $filas_s["vlrinteres"];?></td>
                  </tr>
                <?
                  $suma=$suma+$filas_s["nuevo"];
                  endwhile;
                  $suma=number_format($suma,0);  
              ?>
              </table>
              <tr><td><br></td></tr>
            <tr>
              <center><td><b>Total Cartera:</b>&nbsp;&nbsp;<?echo $suma?></td></center>
            </tr>
        </table>

       </body>
  </html>
