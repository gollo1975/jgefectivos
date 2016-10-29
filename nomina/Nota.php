<html>
<head>
<title>Seguimiento de Incapacidad</title>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
                <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                       function validar()
                    {
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de Identidad ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matvali").submit();
                    }
                    function chequearcampos()
                    {
                        if (document.getElementById("nota").value.length <=0)
                        {
                            alert ("El campo Observacion no puede ser vacio");
                            document.getElementById("nota").focus();
                            return;
                        }
                         document.getElementById("matN").submit();
                    }

                </script>
</head>
<body>
<?
  include("../conexion.php");
   $con="select procesonomina.codproceso from procesonomina
      where  procesonomina.codproceso='$CodProceso'";
   $res=mysql_query($con)or die ("Error de busqueda de empleado");
   $filas_s=mysql_fetch_array($res);
   $reg=mysql_num_rows($res);
   $filas=mysql_fetch_array($res);
   ?>
    <center><h4><u>Observaciones</u></h4></center>
          <form action="NotaGrabar.php" method="post" width="200" id="matN">
           <td><input type="hidden" name="cedula" value="<? echo $cedula;?>"</td>
            <td><input type="hidden" name="hasta" value="<? echo $hasta;?>"</td>
             <td><input type="hidden" name="desde" value="<? echo $desde;?>"</td>
           <table border="0" align="center">
           <tr><td><br></td></tr>
            <tr>
                <td><b>Cod_Proceso:</b></td>
               <td><input type="text" name="codigo" value="<? echo $CodProceso;?>"class="cajas" size="10" readonly></td>
             </tr>
             <tr>
                <td><b>Zona:</b></td>
               <td><input type="text" name="" value="<? echo $zona;?>"class="cajas" size="55" readonly></td>
             </tr>
             <tr>
              <td><b>Observación:</b></td>
               <td colspan="5"><textarea  name="nota" cols="59" rows="8" class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
              </tr>
             <tr><td><br></td></tr>
             <tr>
               <td colspan="5">
                  <input type="button" value="Guardar Dato" class="boton" onclick="chequearcampos()"></td>
             </tr>
           </table>
         </form>

</body>
</html>
