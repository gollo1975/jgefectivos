
<script language="javascript">
                    function imprimir(numero)// para declara funcion
                    {
                    pagina='imprimirmercado.php?codmerca=' + numero
                    tiempo=100
                    ubicacion='_self'
                    setTimeout("open(pagina,ubicacion)",tiempo)
                    }
                </script>
<input type="hidden" name="codigo" value="<?echo $codigo?>">
 <?
 if (empty($cupo)):
   ?>
     <script language="javascript">
       alert("El Campo CUPO no puede ser vacío ..")
       history.back()
     </script>
   <?
 elseif (empty($autoriza)):
     ?>
     <script language="javascript">
       alert("El Campo Quien Autoriza No se pueder ser vacio ..")
       history.back()
     </script>
   <?
    elseif (empty($codigo)):
     ?>
     <script language="javascript">
       alert("Seleccion el codigo de Nomina de la lista ?")
       history.back()
     </script>
   <?
 else:
     include("../conexion.php");
     $consulta = "select count(*) from mercado";
     $result = mysql_query ($consulta);
     $sw = mysql_fetch_row($result);
     $autoriza = strtoupper($autoriza);
     $estado = strtoupper($estado);
     if ($sw[0]>0):
        $consulta = "select max(cast(codmerca as unsigned)) + 1  from mercado";
        $result = mysql_query ($consulta);
        $codec = mysql_fetch_row($result);
        $code = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
     else:
       $code="000001";
     endif;
        $consulta="insert into mercado(codmerca,cedemple,fecha,cupo,estado,autoriza,nsaldo,codsala)
        values('$code','$cedemple','$fecha','$cupo','$estado','$autoriza','$cupo','$codigo')";
        $resultado=mysql_query($consulta) or die("Insercion incorrecta");
        echo ("<script language=\"javascript\">");
        echo ("open (\"imprimirmercado.php?codmerca=$code\" ,\"\");");
        echo "open (\"../menudepartamento.php?op=mercados&codigo=$codigo\",\"contenido\");";
        echo ("</script>");

 endif;
