<script language="javascript">
                function imprimir()// para declara funcion
                {
                pagina='detalladosubir.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>
<td><input type="hidden" name="i" value="<? echo $i;?>"></td>
<td><input type="hidden" name="codnomina" value="<? echo $codnomina;?>"></td>
<td><input type="hidden" name="codbanco" value="<? echo $codbanco;?>"></td>
<td><input type="hidden" name="Auxiliar" value="<? echo $Auxiliar;?>"></td>
  <td><input type="hidden" name="Documento" value="<? echo $Documento;?>"></td>
  <td><input type="hidden" name="codigo" value="<? echo $codigo;?>"></td>
<?
  if(empty($datos)):
      ?>
      <script language="javascript">
        alert("Debe de Seleccionar los Item que se van a Enviar para el Proceso de Nomina ?")
        history.back()
        </script>
      <?
   else:

       include("../conexion.php");
       $descripcion=strtoupper($descripcion);
       $estado='ABIERTO';
       $consulta = "select count(*) from nomina";
       $result = mysql_query ($consulta);
       $sw1 = mysql_fetch_row($result);
       if ($sw1[0]>0):
          $consult1 = "select max(cast(consecutivo as unsigned)) + 1  from nomina";
          $result1 = mysql_query ($consult1);
          $codec = mysql_fetch_row($result1);
          $code = str_pad($codec[0], 10,"0", STR_PAD_LEFT);
       else:
         $code="0000000001";
       endif;
       $consulta="insert into nomina(consecutivo,codigo,cedemple,fechap,desde,hasta,devengado,deduccion,neto,presta,periodo,basico,pagado,tiempo,horap,estado)
       values('$code','$codnomina','$cedula','$fechap','$desde','$hasta','$devengado','$dedu','$neto','$presta','$periodo','$basico','$pagado','$tiempo','$fechahora','$estado')";
       $resultad=mysql_query($consulta)or die("Error al grabar Nomina");
       //ciclo de grabar
       for ($k=1 ; $k<=$tActualizaciones; $k ++):
           if   ($datos[$k] != "" ):
               $con="insert into denomina(consecutivo,codsala,descripcion,vlrhora,nrohora,salario,porcentaje,deduccion,prestacion)
               values('$code','$datos[$k]','$descrip[$k]','$vlrhora[$k]','$nrohora[$k]','$salario[$k]','$porcenta[$k]','$deduccion[$k]','$prestacion[$k]')";
               $resulta=mysql_query($con)or die("Error al grabar detallado de Nomina");
                /*ciclo de parametro*/
	       $con="select parametro.codigo,parametro.nivel from parametro where parametro.codigo='$datos[$k]'";
	       $resup=mysql_query($con)or die("Error al buscar");
               $regis=mysql_num_rows($resup);
	       $filas_s=mysql_fetch_array($resup);
               $nivel=$filas_s["nivel"];
               if($regis!=0 and $nivel==1):
                   $con_C="select credito.nuevo,credito.codsala,credito.nrocredito from credito where credito.cedemple='$cedula' and credito.nuevo > 0 and credito.codsala='$datos[$k]'";
		   $resu_C=mysql_query($con_C)or die("Error al buscar Creditos");
		   $reg_C=mysql_num_rows($resu_C);
		   $filas_C=mysql_fetch_array($resu_C);
		   $aux_C=$filas_C["nrocredito"];
		   $aux_P=$filas_C["nuevo"];
		   if($reg_C != 0):
		      $auxM=$deduccion[$k] * (-1);
		      $calculo=$aux_P-$auxM;
		      $consulta = "select count(*) from abono";
		      $result = mysql_query ($consulta);
		      $sw = mysql_fetch_row($result);
		      if ($sw[0] > 0):
		          $consulta1 = "select max(cast(codabono as unsigned)) + 1 from abono";
			  $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta de los abonos");
			  $codc = mysql_fetch_row($result1);
			  $codA= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
		      else:
		         $codA="000001";
		      endif;
                      $nota='POR MEDIO DEL SISTEMA DE NOMINA';
		      $fechaR=date("Y-m-d");
		      $consul="insert into abono(codabono,cedemple,nrocredito,nuevo,abono,fecha,nota)
		      values('$codA','$cedula','$aux_C','$calculo','$auxM','$fechaR','$nota')";
		      $res=mysql_query($consul)or die("Error al Grabar en la tabla Abono");
		      $actualiza="update credito set nuevo='$calculo' where credito.nrocredito='$aux_C'";
		      $resulta=mysql_query($actualiza) or die("Error al actualizar los datos del credito");
		      $regis=mysql_affected_rows();
                    endif;
                else:
                    if($regis!=0 and $nivel==2):
                           $consul = "select count(*) from consignacion";
		           $result = mysql_query ($consul);
		           $sw = mysql_fetch_row($result);
	                   $auxva=$deduccion[$k] * (-1);
		           if ($sw[0] > 0):
	                     $consulta1 = "select max(cast(nrocon as unsigned)) + 1 from consignacion";
	                     $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
		             $codc = mysql_fetch_row($result1);
		             $codca= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
	                   else:
	                     $codca='00001';
	                   endif;
	                   $consul="insert into consignacion(nrocon,cedemple,codbanco,fechapro,fechapago,valor)
		           values('$codca','$cedula','$codbanco','$fechap','$fechap','$auxva')";
		           $res=mysql_query($consul)or die("Error al grabar aportes ");
                    else:
                          if($regis!=0 and $nivel==3):
	                       $fechaR=date("Y-m-d");
		               $con_M="select mercado.nsaldo,mercado.codmerca from mercado where mercado.cedemple='$cedula' and mercado.nsaldo > 0 and mercado.codsala='$datos[$k]'";
			       $resu_M=mysql_query($con_M)or die("Error al buscar Mercados");
		               $reg_M=mysql_num_rows($resu_M);
		               $filas_M=mysql_fetch_array($resu_M);
			       $aux_M=$filas_M["codmerca"];
		               $aux_S=$filas_M["nsaldo"];
		               if($reg_M != 0):
		                  $auxM=$deduccion[$k] * (-1);
		                  $calculo=$aux_S-$auxM;
		                  $consulta = "select count(*) from debitomercado";
				   $result = mysql_query ($consulta);
				   $sw = mysql_fetch_row($result);
				   if ($sw[0] > 0):
				      $consulta1 = "select max(cast(numero as unsigned)) + 1 from debitomercado";
				      $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
				      $codc = mysql_fetch_row($result1);
				      $codca= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
				   else:
				      $codca="00001";
		                   endif;
				      $consul="insert into debitomercado(numero,cedemple,nsaldo,fechabono,abono)
				      values('$codca','$cedula','$calculo','$fechaR','$auxM')";
		                      $res=mysql_query($consul)or die("Error al Grabar en la tabla debitomercado");
				      $actualiza="update mercado set nsaldo='$calculo' where mercado.codmerca='$aux_M'";
				      $resulta=mysql_query($actualiza) or die("Fallo la inserccion");
				      $regis=mysql_affected_rows();
	                       endif;
                          endif;
	            endif;
               endif;
          endif;
       endfor;
       $registro=mysql_affected_rows();
       echo "<script language=\"javascript\">";
       echo "open (\"../pie.php?msg=Se Grabó $registro registro de la cedula: $cedula\",\"pie\");";
     // echo ("open (\"imprimir.php?codigo=$code\" ,\"\");");
       echo "</script>";
          $con="select nomina.codigo from nomina where nomina.codigo='$codnomina'";
          $reg=mysql_query($con);
          $filas=mysql_fetch_array($reg);
          $codnomina=$filas["codigo"];
        header("location: detalladosubir.php?codzona=$codzona&cedula=$cedula&desde=$desde&hasta=$hasta&codnomina=$codnomina&Auxiliar=$Auxiliar&Documento=$Documento&codigo=$codigo");
       ?>

            <?
  endif;
      ?>

