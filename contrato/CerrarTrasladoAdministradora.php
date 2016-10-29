<html>

<head>
  <title>Traslado de Administradora</title>
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
                         if (document.getElementById("cedula").value == 0)
                        {
                            alert ("Digitar el Documento del posible Empleado.!");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("IdInicio").submit();
                     }

   </script>
</head>

<body>

<?
include("../conexion.php");
 $Sql="select maestrocartatraslado.*  from maestrocartatraslado where maestrocartatraslado.estadoproceso='ABIERTO' order by zona DESC";
 $Rs=mysql_query($Sql)or die("Error al validar os traslado.");
?>
<center><h4><u>Cerrar Traslados de Administradoras</u></h4></center>
<table border="0" align="center">
    <input type="hidden" name="UsuarioPreparador" value="<? echo $UsuarioPreparador;?>" id="UsuarioPreparador">
     <tr>
           <th>#</td>
           <th>Nro_Carta</th>
           <th>Documento</th>
           <th>Empleado</th>
           <th>Eps_Actual</th>
           <th>Nueva_Eps</th>
           <th>Pension_Actual</th>
           <th>Nueva_Fondo</th>
		    <th>F_Proceso</th>
           <th>F_Pago</th>
           <th>Zona</th>
           <th>Estado</th>
       </tr>
       <?
       $a=1;
       while($filas=mysql_fetch_array($Rs)){
        ?>
        <tr class="cajas">
           <th><?echo $a;?></th>
           <td><a href="DetalleCierre.php?NroId=<?echo $filas["nrocartatraslado"];?>&Estado=<?echo $filas["estadoproceso"];?>&Empleado=<?echo $filas["empleado"];?>&Documento=<?echo $filas["cedemple"];?>&UsuarioPreparador=<?echo  $UsuarioPreparador;?>"><?echo $filas["nrocartatraslado"];?></a></td>
           <td><?echo $filas["cedemple"];?></td>
           <td><?echo $filas["empleado"];?></td>
           <td><?echo $filas["epsactual"];?></td>
           <td><?echo $filas["epsnueva"];?></td>
           <td><?echo $filas["pensionactual"];?></td>
           <td><?echo $filas["pensionnueva"];?></td>
		     <td><?echo $filas["fechaproceso"];?></td>
           <td><?echo $filas["fechatraslado"];?></td>
           <td><?echo $filas["zona"];?></td>
           <td><?echo $filas["estadoproceso"];?></td>
        </tr>
        <?
        $a += 1;
       }

       ?>

   </table>
</body>

</html>
