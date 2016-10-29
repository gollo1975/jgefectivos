<html>
        <head>
                <title>Listar Documento</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
                 <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }

                    function chequearcampos()
                    {
                        if (document.getElementById("concepto").value.length <=0)
                        {
                            alert ("Digite el concepto o el detalle de documento.!");
                            document.getElementById("concepto").focus();
                            return;
                        }
						if (document.getElementById("Obligatorio").value.length <=0)
                        {
                            alert ("Digite la cantidad sugerida.!");
                            document.getElementById("Obligatorio").focus();
                            return;
                        }
                         document.getElementById("Mat").submit();

                    }
                </script>
        </head>
        <body>
<?
if (!isset($concepto)){
   include("../conexion.php");
   ?>
   <center><h4><u>Registrar Documentos</u></h4></center>
   <form action="" method="post"id="Mat" name="Mat">
         <table border="0" align="center">
                <tr><td><br></td></tr>
                <tr>
                    <td><b>Concepto:</b></td>
                    <td><input type="text" name="concepto" value="" size="93" maxlength="90" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="concepto">
                </tr>
				<tr>
                    <td><b>Sugerido:</b></td>
                    <td><input type="text" name="Obligatorio" value="" size="4" maxlength="4" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Obligatorio">
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar"class="boton"></td>
                </tr>

         </table>

   </form>
   <?
  $sql="SELECT listadodocumentoempleado.* from listadodocumentoempleado";
   $Rt=mysql_query($sql)or die("Error al buscar los datos del listado");
   $Cont=mysql_num_rows($Rt);
   if($Cont != 0){
       ?>
        <table border="0" align="center" width="650">
       <tr class="cajas">
           <th>#</th>
           <th>id</th>
           <th>Descripcion</th>
		   <th>Cantidad</th>
           <th>Estado</th>

       </tr>
       <?
       $a=1;
       while($register=mysql_fetch_array($Rt)){
            ?>
             <tr class="cajas">
                 <th><?echo $a;?></th>
                 <td><a href="DetalladoRequisito.php?Id=<?echo $register["iddocumento"];?>"><?echo $register["iddocumento"];?></a></td>
                 <td><?echo $register["concepto"];?></td>
				 <td><?echo $register["sugerido"];?></td>
                 <td><?echo $register["estado"];?></td>
                
             </tr>
            <?
            $a += 1;
       }
     ?>
     </table>
     <?
   }
}else{
    $fechap=date("Y-m-d");
    $concepto=strtoupper($concepto);
    include("../conexion.php");
    $consulta="insert into listadodocumentoempleado (concepto,sugerido,fechap)
                                value('$concepto','$Obligatorio','$fechap')";
    $resultado=mysql_query($consulta) or die("Insercion incorrecta");
    $re=mysql_affected_rows();
    echo "<script language=\"javascript\">";
    echo "alert (\"Registro Grabado con exito en sistema\",\"\");";
    echo "open(\"ListarDocumento.php\",\"_self\");";
    echo "</script>";
}
?>
        </body>
</html>
