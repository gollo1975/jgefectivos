<?
 session_start();
?>
<html>
        <head>
                <title>Impersion de Contrato comercial</title>
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
     if(session_is_registered("xsession")):
        include("../conexion.php");
         $variable="select contratocomercial.* from contratocomercial
                   where contratocomercial.nroc='$Nro'";
        $resultado=mysql_query($variable)or die("Error al bsucar contratos");
        $registro=mysql_num_rows($resultado);
        $filas=mysql_fetch_array($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Radicado no existe en la b.d.")
            history.back()
          </script>
         <?
        else:
             ?>
             <table border="0" align="center" width="720">
                 <tr>
                      <td><td><tr></td><div align="center"><b>CONTRATO COMERCIAL CON EMPRESA USUARIA</b></div></td><td><div align="right"><b>Nro:</b></b>&nbsp;CC-<?echo $filas["nroc"];?></div></td
                   </tr>
                   <tr><td><br></td></tr>
                </table>
                <table border="0" align="center" width="720">
                   <tr>
                      <td><p align="justify"><?echo $filas["nota"];?></p></td>
                   </tr>
                </table>

             <?
      endif;
      else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
            ?>

                   </body>
</html>
