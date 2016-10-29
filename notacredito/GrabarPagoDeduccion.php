 <td><input type="hidden" value="<?echo $CodMuni;?>" name="CodMuni"  size="11" id="CodMuni"></td>
<?
if(empty($datoN)){
   ?>
   <script language="javascript">
      alert("Debe de chequear todas las cajas de verificacion para generar el Documento.")
      history.back()
   </script>
   <?
}else{
   include("../numeros.php");
   $letras=num2letras($TotalPagar);
   $letras=strtoupper($letras);
   $FechaV=date("Y-m-d");
   include("../conexion.php");
   $variable="select pagar.nitprove,pagar.nrofactura from pagar where
                pagar.conse='$Conse'";
   $resultado=mysql_query($variable)or die("Error al buscar zona");
   $filas=mysql_fetch_array($resultado);
   $NroFactura= $filas["nrofactura"];
   $NitProve= $filas["nitprove"];
   $consulta = "select count(*) from programardeduccion";
        $result = mysql_query ($consulta);
        $sw = mysql_fetch_row($result);
        if ($sw[0]>0):
           $consulta = "select max(cast(id_p as unsigned)) + 1 from programardeduccion";
           $result = mysql_query($consulta) or die ("Fallo en la consulta");
           $codco = mysql_fetch_row($result);
           $Nroc = str_pad ($codco[0], 6, "0", STR_PAD_LEFT);
        else:
          $Nroc="000001";
        endif;
     $consulta="insert into programardeduccion(id_p,codmaestro,codmuni,codsala,nrofactura,nitprove,desde,hasta,fechapro,vlrpagado,letras)
                   values('$Nroc','$Nit','$CodMuni','$CodSala','$NroFactura','$NitProve','$Desde','$Hasta','$FechaV','$TotalPagar','$letras')";
        $resultado=mysql_query($consulta)or die("inserección incorrecta $consulta");
        $fecha = date('Y-m-j');
        $nuevafecha = strtotime ( '+1 day' , strtotime ( $Hasta ) ) ;
        $nuevafecha = date ( 'Y-m-d' , $nuevafecha );
        $conE="update programardeduccion set ultimafecha='$nuevafecha' where programardeduccion.desde='$Desde' and programardeduccion.hasta='$Hasta' and programardeduccion.codsala='$CodSala'";
        $resuE=mysql_query($conE)or die("Error al actualizar datos de la clave $con");
        $registro=mysql_affected_rows();
         for ($k=1 ; $k<=$tActualizaciones; $k ++):
           if   ($datoN[$k] != ""){
                 $con="insert into detalleprogramardeduccion(cedemple,empleado,total,codzona,zona,fechap,id_p)
                 values('$datoN[$k]','$Empleado[$k]','$Vlr_Pagado[$k]','$CodZona[$k]','$Zona[$k]','$FechaV','$Nroc')";
                 $resulta=mysql_query($con)or die("Error al grabar el detalle de las deducciones");
                 $registro=mysql_affected_rows();
            }
       endfor;
      echo "<script language=\"javascript\">";
      echo ("open (\"ReporteDeduccion.php?NroReporte=$Nroc\" ,\"\");");
        echo "</script>";
            ?>
              <script language="javascript">
                open("InicioDeduccion.php","_self");
             </script>
          <?

}
?>
