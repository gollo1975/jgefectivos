<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimir.php?nronota=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<td ><input type="hidden" name="buscar" value="<?echo $buscar;?>"</td>
<?
   if($ValorP > $Cons):

     ?>
      <script language="javascript">
        alert("El valor digitado no puede ser mayor que el saldo de la factura ?")
        history.back()
      </script>
     <?
   else:
        include("../conexion.php");
        $conB="select parametroiva.* from parametroiva  where parametroiva.nro='$AplicaBase'";
        $resB=mysql_query($conB) or die("Error al buscar");
        $fila=mysql_fetch_array($resB);
        $BaseFteRteIva = $fila["fuentereteiva"];
        $BaseFte = $fila["fuente"];
        $SoloReteIva = $fila["soloreteiva"];
        $BaseExcenta = $fila["excento"];
        $Vlr_Base = $fila["valor"];
        $Aplica_Base = $fila["estado"];
        $ValorCre = 0; $RteIva = 0; $GenerarIva = 0; $Rtefuente = 0; $BaseTotal = 0; $TotalD = 0;
          if($TipoFactura==1){
              if($Aplica_Base=='SI'){
                /*FACTURAS QUE TIENE FUENTE Y RETEIVA*/
                   if($ConF != 0 and $ConR != 0){
                        $BaseTotal = round($ValorP/$BaseFteRteIva);
                        $BaseSubtotal = round($BaseTotal/$Vlr_Base);
	                $Rtefuente = round(($BaseSubtotal * $porfte)/100); /*genera la retencion en la fuente*/
                        $GenerarIva = round(($BaseSubtotal * $IvaEstado)/100); /*genera el iva */
                        $RteIva =  round(($GenerarIva * $poreteiva)/100); /*genera el rete iva */
                        $ValorCre = round(($BaseSubtotal * $porcre)/100); /*genera el cree */
		        $TotalS=($Cons - $ValorP);
	                include("../numeros.php");
	                $letra=num2letras($ValorP);
	                $letra=strtoupper($letra);
	                $nota=strtoupper($nota);
                   }else{
                        /*FACTURAS QUE PRESENTAN SOLO RETENCION*/
                         if($ConF != 0 and $ConR == 0){
                                $BaseTotal = round($ValorP/$BaseFte);
	                        $BaseSubtotal = round($BaseTotal/$Vlr_Base);
		                $Rtefuente = round(($BaseSubtotal * $porfte)/100); /*genera la retencion en la fuente*/
	                        $GenerarIva = round(($BaseSubtotal * $IvaEstado)/100); /*genera el iva */
	                        $RteIva =  0; /*genera el rete iva */
	                        $ValorCre = round(($BaseSubtotal * $porcre)/100); /*genera el cree */
			        $TotalS=($Cons - $ValorP);
		                include("../numeros.php");
		                $letra=num2letras($ValorP);
		                $letra=strtoupper($letra);
		                $nota=strtoupper($nota);
                        }else{
                              /*FACTURAS SIN RETENCION EN LA FUENTE PERO CON  RETEIVA*/
                               if($ConF == 0 and $ConR != 0){
                                        $BaseTotal = round($ValorP/$SoloReteIva);
		                        $BaseSubtotal = round($BaseTotal/$Vlr_Base);
			                $Rtefuente = 0; /*genera la retencion en la fuente*/
		                        $GenerarIva = round(($BaseSubtotal * $IvaEstado)/100); /*genera el iva */
		                        $RteIva =  round(($GenerarIva * $poreteiva)/100); /*genera el rete iva */
		                        $ValorCre = round(($BaseSubtotal * $porcre)/100); /*genera el cree */
				        $TotalS=($Cons - $ValorP);
			                include("../numeros.php");
			                $letra=num2letras($ValorP);
			                $letra=strtoupper($letra);
			                $nota=strtoupper($nota);
                               }else{
                                        /*EXCENTO DE TODO*/
                                        $BaseTotal = round($ValorP/$BaseExcenta);
		                        $BaseSubtotal = round($BaseTotal/$Vlr_Base);
			                $Rtefuente = 0; /*genera la retencion en la fuente*/
		                        $GenerarIva = round(($BaseSubtotal * $IvaEstado)/100); /*genera el iva */
		                        $RteIva =  0; /*genera el rete iva */
		                        $ValorCre = round(($BaseSubtotal * $porcre)/100); /*genera el cree */
				        $TotalS=($Cons - $ValorP);
			                include("../numeros.php");
			                $letra=num2letras($ValorP);
			                $letra=strtoupper($letra);
			                $nota=strtoupper($nota);
                               }
                        }
                   }
              }
         }else{
               if($ConF != 0 and $ConR != 0){
                        $BaseTotal = round($ValorP);
                        $BaseSubtotal = ($ValorP);
	                $Rtefuente = round(($BaseTotal * $PorFuente)/100); /*genera la retencion en la fuente*/
                        $GenerarIva = round(($BaseTotal * $IvaEstado)/100); /*genera el iva */
                        $RteIva =  round(($GenerarIva * $poreteiva)/100); /*genera el rete iva */
                        $ValorCre = round(($BaseTotal * $porcre)/100); /*genera el cree */
	                 $TotalS=($Cons - $ValorP);
	                include("../numeros.php");
	                $letra=num2letras($ValorP);
	                $letra=strtoupper($letra);
	                $nota=strtoupper($nota);
               }else{
                        if($ConF != 0 and $ConR == 0){
                               $BaseTotal = round($ValorP);
	                        $BaseSubtotal = ($ValorP);
		                $Rtefuente = round(($BaseTotal * $PorFuente)/100); /*genera la retencion en la fuente*/
	                        $GenerarIva = round(($BaseTotal * $IvaEstado)/100); /*genera el iva */
	                        $RteIva =  0; /*genera el rete iva */
	                        $ValorCre = round(($BaseTotal * $porcre)/100); /*genera el cree */
			        $TotalS=($Cons - $ValorP);
		                include("../numeros.php");
		                $letra=num2letras($ValorP);
		                $letra=strtoupper($letra);
		                $nota=strtoupper($nota);
                        }else{
                               if($ConF == 0 and $ConR != 0){
                                        $BaseTotal = round($ValorP);
		                        $BaseSubtotal = ($ValorP);
			                $Rtefuente = 0; /*genera la retencion en la fuente*/
		                        $GenerarIva = round(($BaseTotal * $IvaEstado)/100); /*genera el iva */
		                        $RteIva =  round(($GenerarIva * $poreteiva)/100); /*genera el rete iva */
		                        $ValorCre = round(($BaseTotal * $porcre)/100); /*genera el cree */
				        $TotalS=($Cons - $ValorP);
			                include("../numeros.php");
			                $letra=num2letras($ValorP);
			                $letra=strtoupper($letra);
			                $nota=strtoupper($nota);
                               }else{
                                        $BaseTotal = round($ValorP);
		                        $BaseSubtotal = ($ValorP);
			                $Rtefuente = 0; /*genera la retencion en la fuente*/
		                        $GenerarIva = round(($BaseTotal * $IvaEstado)/100); /*genera el iva */
		                        $RteIva =  0; /*genera el rete iva */
		                        $ValorCre = round(($BaseTotal * $porcre)/100); /*genera el cree */
				        $TotalS=($Cons - $ValorP);
			                include("../numeros.php");
			                $letra=num2letras($ValorP);
			                $letra=strtoupper($letra);
			                $nota=strtoupper($nota);
                               }
                        }
               }
         }
        $consulta = "select count(*) from notacredito";
          $result = mysql_query ($consulta);
          $answ = mysql_fetch_row($result);
          if($answ[0]>0):
             $consulta = "select max(cast(nronota as unsigned)) + 1 from notacredito";
             $result = mysql_query ($consulta) or die ("Fallo en la consulta");
             $codc = mysql_fetch_row($result);
             $codca= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
          else:
              $codca="00001";
          endif;
             $consulta="insert into notacredito(nronota,nrofactura,zona,nit,dv,direccion,fecha,valor,vlrsaldo,valorbase,subtotal,vlriva,vlrfte,vlreteiva,vlrcre,letra,nota)
                       values('$codca','$nrofactura','$zona','$nitzona','$dvzona','$dirzona','$fecha','$ValorP','$TotalS','$BaseSubtotal','$BaseTotal','$GenerarIva','$Rtefuente','$RteIva','$ValorCre','$letra','$nota')";
             $resultado=mysql_query($consulta) or die("Error al grabar la nota credito");
             $reg=mysql_affected_rows();
             $con="update factura set nsaldo='$TotalS',estado='NOTA CREDITO' where factura.nrofactura='$nrofactura'";
             $resu=mysql_query($con) or die("Error al actualizar los saldos");
             $registro=mysql_affected_rows();
             if ($registro!=0):
                ?>
              <script language="javascript">
                 alert("La tabla Factura, se actuolizó con Exito ?")
              </script>
              <?
               echo ("<script language=\"javascript\">");
               echo ("open (\"imprimir.php?nronota=$codca\" ,\"\");");
               echo ("open (\"cargar.php\",\"_self\");");
               echo ("</script>");
            else:
              ?>
              <script language="javascript">
                 alert("No se guardaron registro en la tabla ?")
              </script>
              <?
            endif;
 endif;
?>


