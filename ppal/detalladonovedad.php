<html>

<head>
<title>Consulta Novedades </title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($desde)):
?>
<center><h4><u>Novedades de Nómina</u> </h4></center>
  <form action="" method="post">
    <table border="0" align="center">
     <tr><td><br></td></tr>
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10">&nbsp;</td>
       </tr>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10">&nbsp;</td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar" class="boton"></td>
        </tr>
        
    </table>

  </form>
   <?
elseif (empty($desde)):
   ?>
   <script language="javascript">
     alert("Debe colocar la fecha inicio")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
     $variable="select pnovedad.codigo,zona.zona,pnovedad.firma from zona,pnovedad where
                 zona.codzona=pnovedad.codzona and
		 pnovedad.codzona='$codigo' and
		 pnovedad.desde='$desde' and pnovedad.hasta='$hasta'";
         $resultado=mysql_query($variable)or die("consulta incorrecta ");
        $registro=mysql_num_rows($resultado);
         ?>
          <table border="0" align="center">
              <?
             while($filas=mysql_fetch_array($resultado)):
             $firma=$filas["firma"];
             ?>
               <table border="0" align="center">
                <tr class="cajas">
                 <td colspan="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["zona"];?></td>
                </tr>
                <tr class="cajas">
                  <td colspan="1"><b>Desde:&nbsp;&nbsp;</b><?echo $desde;?></td>
                  <td colspan="1"><b>Hasta:&nbsp;&nbsp;</b><?echo $hasta;?></td>
                </tr>
               </table>

             <?
              endwhile;
              $variable1="select novedadnomina.* from zona,novedadnomina where
                    zona.codzona=novedadnomina.codzona and
                    novedadnomina.desde between '$desde'and'$hasta' and
                    zona.codzona='$codigo'order by novedadnomina.nombre";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta $variable1");
        $registro=mysql_num_rows($resultado1);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No hay novedades de Nomina en este rango de Fechas ?")
            history.back()
          </script>
         <?
         else:
         ?>
         <center><h4>Listado de Empleados</h4></center>
         <table border="0" align="center">
           <tr><td class="cajas">Para ver las Novedades por Empleado, presione Click Sobre La ["cedula"]...</td></tr>
         </table>
          <table border="1" align="center">
           <tr >
              <th>Cedula</th>
              <th class="cajas">Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th class="cajas">HEO</th>
              <th class="cajas">HEDF</th>
              <th class="cajas">DC</th>
              <th class="cajas">DNC</th>
              <th class="cajas">H_N</th>
              <th class="cajas">R_N</th>
              <th class="cajas">Retorno</th>
              <th class="cajas">HNF</th>
              <th class="cajas">Otros Dcto</th>
              <th class="cajas">Nota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             $aux=number_format($filas_s["otros"],0);
             ?>
               <tr class="cajas">
                <td><a href="detallado1.php?cedula=<?echo $filas_s["cedemple"];?>"><?echo $filas_s["cedemple"];?></a></td>
                <td>&nbsp;<?echo $filas_s["nombre"];?></td>
                 <td>&nbsp;<?echo $filas_s["hed"];?></td>
                 <td>&nbsp;<?echo $filas_s["hedf"];?></td>
                 <td>&nbsp;<?echo $filas_s["dc"];?></td>
                 <td>&nbsp;<?echo $filas_s["dnc"];?></td>
                 <td>&nbsp;<?echo $filas_s["hn"];?></td>
                 <td>&nbsp;<?echo $filas_s["rn"];?></td>
                 <td>&nbsp;<?echo $filas_s["retorno"];?></td>
                 <td>&nbsp;<?echo $filas_s["hnf"];?></td>
                 <td>&nbsp;<?echo $aux;?></td>
                 <td>&nbsp;<?echo $filas_s["nota"];?></td>
                 </tr>
                <?
                $con=$con+1;
                $con1=$con1+$filas_s["hed"];
                $con2=$con2+$filas_s["hedf"];
                $con3=$con3+$filas_s["dc"];
                $con4=$con4+$filas_s["dnc"];
                $con5=$con5+$filas_s["hn"];
                $con6=$con6+$filas_s["rn"];
                $con7=$con7+$filas_s["retorno"];
                $con9=$con9+$filas_s["hnf"];
                $con8=$con8+$filas_s["otros"];
                endwhile;
                $con8=number_format($con8,0); 
                ?>
                  </table>
                  <table border="0" align="center">
                    <tr>
                    <center><td class="cajas"><b>Registros:</b>&nbsp;<?echo $con;?>&nbsp;<b>HEO:</b>&nbsp;<?echo $con1;?>&nbsp;<b>HEDF:</b>&nbsp;<?echo $con2;?>&nbsp;<b>DC:</b>&nbsp;<?echo $con3;?>&nbsp;<b>DNC:</b>&nbsp;<?echo $con4;?>&nbsp;<b>HN:</b>&nbsp;<?echo $con5;?>&nbsp;<b>RN:</b>&nbsp;<?echo $con6;?>&nbsp;<b>Retorno:</b>&nbsp;<?echo $con7;?>&nbsp;<b>HNF:</b>&nbsp;<?echo $con9;?>&nbsp;<b>Otros Dcto:</b>&nbsp;<?echo $con8;?></td></center>
                    </tr>
                    </table>
                    <tr><td><br></td></tr>
					<?
					$var="select accesozona.nombre from accesozona where
                       accesozona.cedula='$firma'";
                     $res=mysql_query($var)or die("Error al buscar firma");
                     $reg=mysql_num_rows($res);
                     $filas_f=mysql_fetch_array($res);
                     if($reg!=0):
		              ?>
				      <div align="center"><u><b>Firma Autorizada:&nbsp;</b></u><? echo $filas_f["nombre"];?></div>
                      <?
else:
			?>
				      <div align="center"><u><b>Firma Autorizada:&nbsp;</b></u><? echo $filas_f["nombre"];?></div>
                      <?		  
					 endif; 
              endif;
         endif;
         ?>
       </body>

  </html>
