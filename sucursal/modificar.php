<html>
<head>
<title>Consulta de sucursales</title>
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
<script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
</script>
</head>
<body>
<?
    include("../conexion.php");
    $consulta="select * from sucursal where codsucursal='$cod'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
     while($filas=mysql_fetch_array($resultado)):
       ?>
        <center><h4>Datos a modificar</h4></center>
         <form action="guardar.php" method="post">
           <table border="0" align="center">
             <tr>
                <td><br></td>
             </tr>
             <tr>
               <td><b>Código de Sucursal:</b></td>
               <td><input type="text" value="<?echo $filas["codsucursal"];?>" name="codsucursal" size="3" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codsucursal"></td>
             </tr>
             <tr>
               <td><b>Sucursal:</b></td>
               <td><input type="text" value="<?echo $filas["sucursal"];?>"name="sucursal" size="50" maxlength="50" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="sucursal"></td>
             </tr>
              <tr>
               <td><b>Dirección:</b></td>
               <td><input type="text" value="<?echo $filas["dirsucursal"];?>"name="dirsucursal" size="50" maxlength="50" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirsucursal"></td>
             </tr>
              <tr>
               <td><b>Teléfono:</b></td>
               <td><input type="text" value="<?echo $filas["telsucursal"];?>" name="telsucursal"size="10" maxlength="7" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telsucursal"></td>
             </tr>
              <tr>
               <td><b>Fax:</b></td>
               <td><input type="text" value="<?echo $filas["faxsucursal"];?>"name="faxsucursal" size="10" maxlength="7" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="faxsucursal"></td>
             </tr>
              <tr>
              <td><b>Municipio:</b></td>
              <td>    <select name="codmunicipio"class="cajas">
                              <?
                              $aux=$filas["codmuni"];
                              $consulta_c="select codmuni,municipio from municipio order by municipio";
                              $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
                              while ($filas_c=mysql_fetch_array($resultado_c))
                                    {
                                    if($aux==$filas_c["codmuni"])
                                    {
                                    ?>
                                    <option value="<?echo $filas_c["codmuni"];?>" selected><?echo $filas_c["municipio"];?>
                                    <?
                                    }
                                    else
                                    {
                                    ?>
                                    <option value="<?echo $filas_c["codmuni"];?>"><?echo $filas_c["municipio"];?>
                                    <?
                                    }
                                    }
                                    ?>
                                    </select></td>
                                    </tr>
             <tr>
               <td><b>Cuenta Nro 1:</b></td>
               <td><input type="text" value="<?echo $filas["cuenta1"];?>" name="cuenta1"size="20" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cuenta1"></td>
             </tr>
             <tr>
               <td><b>Tipo Cta 1:</b></td>
               <td><input type="text" value="<?echo $filas["tipocta1"];?>" name="tipo1"size="20" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipo1"></td>
             </tr>
             <tr>
               <td><b>Banco1 :</b></td>
               <td><input type="text" value="<?echo $filas["banco"];?>" name="banco"size="20" maxlength="20" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="banco"></td>
             </tr>
             <tr>
               <td><b>Cuenta Nro 2:</b></td>
               <td><input type="text" value="<?echo $filas["cuenta2"];?>" name="cuenta2"size="20" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cuenta2"></td>
             </tr>
             <tr>
               <td><b>Tipo Cta 2:</b></td>
               <td><input type="text" value="<?echo $filas["tipocta2"];?>" name="tipo2"size="20" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipo2"></td>
             </tr>
             <tr>
               <td><b>Banco2 :</b></td>
               <td><input type="text" value="<?echo $filas["banco1"];?>" name="banco1"size="20" maxlength="20" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="banco1"></td>
             </tr>
             <tr>
               <td><b>Resolución Dian:</b></td>
               <td><input type="text" value="<?echo $filas["dian"];?>" name="dian"size="60" maxlength="60" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dian"></td>
             </tr>
             <tr>
               <td><b>Desde:</b></td>
               <td><input type="text" value="<?echo $filas["rango"];?>" name="rango"size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="rango"></td>
             </tr>
              <tr>
               <td><b>Hasta:</b></td>
               <td><input type="text" value="<?echo $filas["rango2"];?>" name="rango2"size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="rango2"></td>
             </tr>
             <tr>
               <td><b>Departamento:</b></td>
               <td><select name="departamento" class="cajas">
                 <?
                 $depaux=$filas["codepart"];
                 $consulta_d="select * from departamento";
                 $resultado_d=mysql_query($consulta_d)or die("Consulta de departamento incorrecta");
                 while($filas_d=mysql_fetch_array($resultado_d)):
                   if ($depaux==$filas_d["codepart"]):
                 ?>
                 <option value="<?echo $filas_d["codepart"];?>" selected><?echo $filas_d["departamento"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_d["codepart"];?>"><?echo $filas_d["departamento"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
             <tr>
               <td><b>Email:</b></td>
               <td><input type="text" value="<?echo $filas["email"];?>" name="email" size="50" maxlength="50"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="email"></td>
             </tr>
             <tr>
             <td><b>Principal:</b></td>
               <td><select name="principal" class="cajasletra">
                  <option value="<?echo $filas["estadosucu"];?>"selected><?echo $filas["estadosucu"];?>
                  <option value="NO">NO
                  <option value="SI">SI
                  </select>
                </td>
               </tr>
             <tr>
               <td><b>Empresa:</b></td>
               <td><select name="empresa" class="cajas">
                 <?
                 $empaux=$filas["codmaestro"];
                 $consulta_e="select * from maestro";
                 $resultado_e=mysql_query($consulta_e)or die("Consulta de empresas incorrecta");
                 while($filas_e=mysql_fetch_array($resultado_e)):
                   if ($empaux==$filas_e["codmaestro"]):
                 ?>
                 <option value="<?echo $filas_e["codmaestro"];?>" selected><?echo $filas_e["nomaestro"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_e["codmaestro"];?>"><?echo $filas_e["nomaestro"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
                           <tr><td><br></td></tr>
             <tr>
               <td colspan="2">
                 <input type="submit" value="Guardar" class="boton">
                 <input type="reset" value="Limpiar" class="boton">
               </td>
              </tr>
              <tr><td><br></td></tr>
            <?
            endwhile;
  ?>
     </table>
     </form>
</body>
</html>
