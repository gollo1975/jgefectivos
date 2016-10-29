<html>

<head>
  <title>Parametros</title>
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
                        if (document.getElementById("cupo").value.length <=0)
                        {
                            alert ("Digite el cupo de mercado autorizado?");
                            document.getElementById("cupo").focus();
                            return;
                        }
                         document.getElementById("matfune").submit();

                    }
                </script>
</head>
<body>
<?
if (!isset($cupo)):
  include("../conexion.php");
?>
<center><h4><u>Parametros Mercado</u></h4></center>
  <form action="" method="post"id="matfune">
    <table border="0" align="center">
      <tr><td><br></td></tr>
      <tr>
       <td><b>Cupo de Mercado:</b></td>
        <td><input type="text" name="cupo" value="" size="15" maxlength="15" class="cajas"></td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
          <td colspan="2">
            <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">
            <input type="reset" value="Limpiar" class="boton">
           </td>
         </tr>
   </table>

   </form>
   <?
              else:
                include("../conexion.php");
                  $consulta="insert into parametromercado(cupo)
                        values('$cupo')";
                   $resultado=mysql_query($consulta)or die ("Error al grabar datos.");
                   $registro=mysql_affected_rows();
                   if($registro!=0):
	                   ?>
	                   <script language="javascript">
	                     alert("Registro almacenado Correctamente")
	                     open("parametromercado.php","_self")
	                   </script>
	                 <?
                   else:
	                    ?>
	                   <script language="javascript">
	                     alert("El Registro no se grabó con exito en sistema..")
	                     open("parametromercado.php","_self")
	                   </script>
	                 <?
                   endif;
   endif;
   ?>
</body>
</html>
