<?
 session_start();
?>
<html>
<head>
<title>Modificacion de Municipio</title>
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
                        if (document.getElementById("municipio").value.length <=0)
                        {
                            alert ("El campo Municipio no puede estar vacío");
                            document.getElementById("municipio").focus();
                            return;
                         }   
                          document.getElementById("mat1").submit();
                    }

                   </script>
</head>
<body>
<?
 if(session_is_registered("xsession")):
   include("../conexion.php");
    $consulta="select * from municipio where municipio.codmuni='$codmuni'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
     while($filas=mysql_fetch_array($resultado)):

       ?>
       <center><h4><u>Datos a Modificar</u></h4></center>
         <form action="guardar.php" method="post" id="mat1">
           <table border="0" align="center">
           <tr><td><br></td></tr>
             <tr>
               <td colspan="2"></td>
             </tr>
             <tr>
               <td><b>Cod_Municipio:</b></td>
               <td><input type="text" value="<?echo $filas["codmuni"];?>" size="10" name="codmuni" class="cajas"readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codmuni"></td>
             </tr>
               <td><b>Municipio:</b></td>
               <td><input type="text" value="<?echo $filas["municipio"];?>" name="municipio" class="cajas" size="40" maxlength="40" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="municipio"></td>
             </tr>
             <tr>
               <td><b>Departamento:</b></td>
               <td><select name="depart"class="cajas">
                 <?
                 $depa=$filas["codepart"];
                 $consulta_e="select departamento.codepart,departamento.departamento from departamento order by departamento.departamento";
                 $resultado_e=mysql_query($consulta_e)or die("Consulta  incorrecta");
                 while($filas_e=mysql_fetch_array($resultado_e)):
                   if ($depa==$filas_e["codepart"]):
                 ?>
                 <option value="<?echo $filas_e["codepart"];?>"selected><?echo $filas_e["departamento"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_e["codepart"];?>"><?echo $filas_e["departamento"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
              </tr>
               <tr><td><br></td></tr>
               <td colspan="2">
                 <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">
                 <input type="reset" value="Limpiar"class="boton">
               </td>
              </tr>
            <?
            endwhile;
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
     </table>
     </form>
</body>
</html>
