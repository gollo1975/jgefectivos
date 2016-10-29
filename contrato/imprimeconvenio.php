<?
 session_start();
?>
<html>
        <head>
                <title>Impresión de contrato de trabajo</title>
              <LINK  REL="stylesheet" HREF="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?
             include("../conexion.php");
         $variable="select convenio.* from convenio
                   where convenio.nroconvenio='$codigo'";
        $resultado=mysql_query($variable)or die("Error al bsucar convenios");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Radicado no existe en la b.d.")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             ?>
            
               <table border="0" align="center" width="720">
                 <tr>
                      <td><b><div align="center"><u><?echo $filas["tipo"];?></u></b><b><div align="right">Nro:</b>&nbsp;<?echo $filas["nroconvenio"];?></div></td>
                   </tr>
                   <tr><td><br></td></tr>
                </table>
                <table border="0" align="center" width="720">
                   <tr>
                      <td><p align="justify"><?echo $filas["descripcion"];?></p></td>
                   </tr>
                </table>

             <?
           endwhile;
      endif;

            ?>

                   </body>
</html>
