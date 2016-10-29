 <script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='ImprimirCartaRestriccion.php?NroCarta=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>
<input type="hidden" value="<?echo $UsuarioPreparador;?>" name="UsuarioPreparador" id="UsuarioPreparador">
<?
if(empty($Dato)){
    ?>
    <script language="javascript">
       alert("Debe de chequear al menos un Item para generar la carta de Restricciones Medicas.")
       history.back()
    </script>
    <?
}else{
    include("../conexion.php");
    $Sql = "select count(*) from maestrocartarestriccion";
    $Rs = mysql_query ($Sql);
    $sw = mysql_fetch_row($Rs);
    if ($sw[0]>0):
           $consulta = "select max(cast(nrocarta as unsigned)) + 1 from maestrocartarestriccion";
           $result = mysql_query($consulta) or die ("Fallo en la consulta");
           $IdCarta = mysql_fetch_row($result);
           $NroCarta = str_pad ($IdCarta[0], 5, "0", STR_PAD_LEFT);
    else:
          $NroCarta="00001";
    endif;
    $UsuarioPreparador= strtoupper($UsuarioPreparador);
    $FechaP=date('Y-m-d');
    $ConSql="insert into maestrocartarestriccion(nrocarta,cedula,empleado,fechaexamen,dias,tiporevision,firma,profesion,licencia,cargo,fechaproceso,usuario)
                   values('$NroCarta','$Documento','$Trabajador','$FechaExamen','$Dias','$TipoRevision','$Firma','$Profesion','$Licencia','$Cargo','$FechaP','$UsuarioPreparador')";
    $RsI=mysql_query($ConSql)or die("inserección incorrecta $consulta");
    $registro=mysql_affected_rows();
    for ($k=1 ; $k<=$TotalR; $k ++):
           if   ($Dato[$k] != ""){
                 $con="insert into detalladorestriccionmedica(idrestriccion,concepto,nrocarta)
                 values('$Dato[$k]','$Concepto[$k]','$NroCarta')";
                 $resulta=mysql_query($con)or die("Error al grabar el detalle de la restriccion medica");
                 $registro=mysql_affected_rows();
           }
    endfor;
        echo "<script language=\"javascript\">";
        echo ("open (\"ImprimirCartaRestriccion.php?NroCarta=$NroCarta\" ,\"\");");
        echo "</script>";
            ?>
              <script language="javascript">
                open("CrearRestriccion.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>","_self");
             </script>
          <?
}
?>
