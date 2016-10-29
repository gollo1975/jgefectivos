 <script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='ImprimirEntregaDocumento.php?NroEntrega=' + numero
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>
<input type="hidden" value="<?echo $UsuarioPreparador;?>" name="UsuarioPreparador" id="UsuarioPreparador">
<?
if(empty($Dato)){
    ?>
    <script language="javascript">
       alert("Debe de chequear al menos un Item para generar la carta de entrega de Documentos.")
       history.back()
    </script>
    <?
}else{
    include("../conexion.php");
    $Sql = "select count(*) from maestroentregadocumento";
    $Rs = mysql_query ($Sql);
    $sw = mysql_fetch_row($Rs);
    if ($sw[0]>0):
           $consulta = "select max(cast(nroentrega as unsigned)) + 1 from maestroentregadocumento";
           $result = mysql_query($consulta) or die ("Fallo en la consulta");
           $IdCarta = mysql_fetch_row($result);
           $NroEntrega = str_pad ($IdCarta[0], 7, "0", STR_PAD_LEFT);
    else:
          $NroEntrega="0000001";
    endif;
    $UsuarioPreparador= strtoupper($UsuarioPreparador);
    $FechaP=date('Y-m-d');
    $ConSql="insert into maestroentregadocumento(nroentrega,cedemple,empleado,zona,lugarexpedicion,fechaentrega,usuario)
                   values('$NroEntrega','$Documento','$Trabajador','$Zona','$LugarExpedicion','$FechaP','$UsuarioPreparador')";
    $RsI=mysql_query($ConSql)or die("Error al grabar el maestro de la Tabla.");
    $registro=mysql_affected_rows();
    for ($k=1 ; $k<=$TotalR; $k ++):
           if   ($Dato[$k] != ""){
                 $con="insert into detalladoentregadocumento(iddocumento,concepto,nroentrega)
                 values('$Dato[$k]','$Concepto[$k]','$NroEntrega')";
                 $resulta=mysql_query($con)or die("Error al grabar el detalle de la entrega de documento");
                 $registro=mysql_affected_rows();
           }
    endfor;
        echo "<script language=\"javascript\">";
        echo ("open (\"ImprimirEntregaDocumento.php?NroEntrega=$NroEntrega\" ,\"\");");
        echo "</script>";
            ?>
              <script language="javascript">
                open("EntregaDocumento.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>","_self");
             </script>
          <?
}
?>
