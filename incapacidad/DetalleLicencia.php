<html>
        <head>
                <title>Proceso de Licencias</title>
               <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">

        </head>
        <body>

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
                        if (document.getElementById("Cedula").value.length <=0)
                        {
                            alert ("Digite el documento de identidad del Empleado.!");
                            document.getElementById("Cedula").focus();
                            return;
                        }
                         document.getElementById("matmemo").submit();

                    }
                </script>
                <?
include("../conexion.php");
/*codigo que busca el tipo de proceso*/
$conM="select licencia.*,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombres,empleado.basico,empleado.codzona,zona.zona  from empleado,licencia,zona
	    where empleado.cedemple=licencia.cedemple and
                  licencia.codzona=zona.codzona and
	          empleado.cedemple='$Cedula'";
$resulM=mysql_query($conM) or die("Error al busca empleados");
$reg=mysql_num_rows($resulM);
if($reg==0){
	?>
	<script language="javascript">
	alert("Este empleado no presenta registros en la Consulta.!")
	history.back()
	</script>
	<?
}else{
	?>
	<center><h4><u>TIPOS LICENCIAS..</u></h4></center>
        <table border="0" align="center"
	   <tr class="cajas">
           <th>#</td>
              <th>Id_Licencia</td>
              <th>Tipo_Licencia</td>
              <th>Desde</td>
              <th>Hasta</td>
              <th>Nro_Dias</td>
              <th>Salario</td>
              <th>Zona</td>
			   <th>Motivo</td>
	   </tr>
        <?
        $a=1;
        while($fila=mysql_fetch_array($resulM)){
            $salario = number_format($fila["salario"],0);
            ?>
            <tr class="cajas">
               <th><?echo $a;?></th>
                <td><b><a href="EditarLicencia.php?NroId=<?echo $fila["idlicencia"];?>&Cedula=<?echo $Cedula;?>&Empleado=<?echo $fila["nombres"];?>&codigo=<?echo $codigo;?>"><div align="center"><?echo $fila["idlicencia"];?></div></a></b></td>
                <td><?echo $fila["concepto"];?></td>
                <td><?echo $fila["fechainicio"];?></td>
                <td><?echo $fila["fechafinal"];?></td>
                <td><div align="center"><?echo $fila["dias"];?></div></td>
                <td><div align="center"><?echo $salario;?></div></td>
                <td><?echo $fila["zona"];?></td>
				<td><?echo $fila["nota"];?></td>
            </tr>
            <?
            $a +=1;
        }
        ?>
        </table>
        <tr>&nbsp;</td>
  <div align="center"><a href="ListaLicencia.php?codigo=<?echo $codigo;?>"><img src="../image/regresar.png" border="0" alt="Regresar al menu de consulta"></div>
	<?
}

?>
</body>
</html>
