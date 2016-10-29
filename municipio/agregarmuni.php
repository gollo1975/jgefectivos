<html>
        <head>
                <title>Matricula de municipios</title>
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
                         if (document.getElementById("codigo").value.length <=0)
                        {
                            alert ("El campo código_ municipio, no puede estar vacío");
                            document.getElementById("codigo").focus();
                            return;
                         }
                        if (document.getElementById("municipio").value.length <=0)
                        {
                            alert ("El campo Municipio no puede estar vacío");
                            document.getElementById("municipio").focus();
                            return;
                         }

                        document.getElementById("matzona").submit();
                    }

                   </script>


        </head>
        <body>
        <?
                        if (!isset($municipio)):
                                  include("../conexion.php");
                ?>
                <center><h4><u>Matricular Municipios</u></h4></center>
                <form action="" id="matzona" method="post">
                        <table border="0" align="center">
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                        <td><b>Cod_Municipio:</b></td>
                                        <td><input type="text" name="codigo" value="" size="10" maxlength="10"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo">
                                </tr>
                                <tr>
                                        <td><b>Municipio:</b></td>
                                        <td><input type="text" name="municipio" value="" size="40" maxlength="40"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="municipio">
                                </tr>
                                 <tr>
                                        <td><b>Departamento:</b></td>
                                        <td>
                                           <select name="depart" class="cajas">
                                           <option value="0">Seleccione el Dpto
                                                   <?
                                                                $consulta="select departamento.codepart,departamento.departamento from departamento";
                                                                $resultado=mysql_query($consulta) or die("consulta de departamento Incorrecta");
                                                                while ($filas=mysql_fetch_array($resultado))
                                                                {
                                                        ?>
                                                                <option value="<?echo $filas["codepart"];?>"><?echo $filas["departamento"];?>
                                                        <?
                                                                }
                                                        ?>
                                        </select></td>
                                </tr>
                                  <tr><td><br></td></tr>
                                <tr>
                                              <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                        </table>
                </form>

                <?
                 elseif(empty($depart)):
                   ?>
                   <script language="javascript">
                     alert("Debe de Seleccionar un departamento ?")
                     history.back()
                   </script>
                   <?
                  else: 
                    include("../conexion.php");
                    $zona=strtoupper($zona);
                    $consulta = "select codmuni  from municipio where codmuni='$codigo'";
                    $result = mysql_query ($consulta);
                    $answ = mysql_num_rows($result);
                    if ($answ==0):
                       $consulta="insert into municipio (codmuni,municipio,codepart)
                          value('$codigo','$municipio','$depart')";
                       $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                      ?>
                       <script language="javascript">
                            alert("Registros Grabados con Exito en la bd.?")
                            open("agregarmuni.php","_self");
                       </script>
                       <?
                     else:
                        ?>
                       <script language="javascript">
                            alert("Este código de municipio, ya xiste en Sistema ?")
                            history.back()
                       </script>
                       <?
                     endif;

           endif;
?>
        </body>
</html>
