<html>

<head>
  <title>Consulta de Zonas</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
include("../conexion.php");
$conE="select acceso.cedula from acceso where
                acceso.usuario='$Auxiliar'";
$resE=mysql_query($conE)or die ("Consulta incorrecta de usuario");
$filas_s=mysql_fetch_array($resE);
$Documento=$filas_s["cedula"];
        $consulta="select zona.zona,zona.codzona from zona,periodo,comisionomina,acceso where
                 zona.codzona=periodo.codzona and
                 periodo.codzona=comisionomina.codzona and
                 comisionomina.cedemple=acceso.cedula and
                 acceso.cedula='$Documento' and
                 periodo.estado='FALTA'";
               $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
            $registro=mysql_num_rows($resultado);
            if ($registro==0):
            ?>
            <script language="javascript">
            alert ("No hay zonas con periodo de Nomina registrado?")
            history.back()
            </script>
           <?
             else:
             ?>
                <center><h4>Listado de Zonas</h4></center>
                 <table border="0" align="center">
                  <tr class="fondo">
                    <td colspan="20"></td>
                  </tr>
                <tr class="cajas">
                   <th>Cod_Zona</th>
                   <th>Zona</th>
                   </tr>
                    <?
                     while($filas=mysql_fetch_array($resultado)):
                   ?>
                     <tr class="cajas">
                        <td><a href="Abrir.php?codzona=<?echo $filas["codzona"];?>&Auxiliar=<?echo $Auxiliar;?>&Documento=<?echo $Documento;?>"><?echo $filas["codzona"];?></td>
                       <td><?echo $filas["zona"];?></td>
                     </tr>

                       <?
                    endwhile;
         endif;
  ?>
</table>

</body>
</html>
