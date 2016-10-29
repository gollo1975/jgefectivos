<html>
        <head>
                <title>Modificacion de Salario</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
<?
include("../conexion.php");
$consulta="select * from salario where codsala='$codsala'";
$resultado=mysql_query($consulta) or die("consulta incorrecta");
$registros=mysql_num_rows($resultado);
$filas=mysql_fetch_array($resultado);
if ($registros==0):
   ?>
   <script language="javascript">
           alert("No Existen Registros")
           history.back()
   </script>
   <?
else:
   ?>
    <center><h4><u>Datos a Modificar</u></h4></center>
    <form action="guardar.php" method="post">
    <table border="0" align="center">
        <tr>
        <td><b>Nro Cuenta:</b></td>
        <td><input type="text" name="codsala" value="<?echo $filas["codsala"];?>"size="15" class="cajas" readonly></td>
        </tr>
        <tr>
        <td><b>Descripción:</b></td>
        <td><input type="text" name="desala" value="<?echo $filas["desala"];?>" size="50" class="cajas"maxlength="45"></td>
        </tr>
        <tr>
        <td><b>Pocentaje:</b></td>
        <td><input type="text" name="porcentaje" value="<?echo $filas["porcentaje"];?>" size="10" class="cajas"maxlength="5"></td>
        </tr>
        <tr>
        <tr>
        <td><b>Auxilio de Trans.:</b></td>
        <td><input type="text" name="ayuda" value="<?echo $filas["ayuda"];?>" size="15" class="cajas" maxlength="15"></td>
        </tr>
        <tr>
        <td><b>Prestación:</b></td>
        <td><select name="prestacion" class="cajas">
        <option value="<?echo $filas["prestacion"];?>" selected><?echo $filas["prestacion"];?>
        <option value="NO">NO
        <option value="SI">SI
        </select></td>
        </tr>
        <tr>
        <td><b>C.Costo_Vis.:</b></td>
        <td><select name="control" class="cajas">
        <option value="<?echo $filas["control"];?>" selected><?echo $filas["control"];?>
        <option value="NO">NO
        <option value="SI">SI
        </select></td>
        </tr>
        <tr>
        <td><b>V_Directa:</b></td>
        <td><select name="Variable" class="cajas">
        <option value="<?echo $filas["insertar"];?>" selected><?echo $filas["insertar"];?>
        <option value="NO">NO
        <option value="SI">SI
        </select></td>
        </tr>
        <tr>
        <td><b>S_Crédito.:</b></td>
        <td><select name="SumarC" class="cajas">
        <option value="<?echo $filas["sumarcupo"];?>" selected><?echo $filas["sumarcupo"];?>
        <option value="NO">NO
        <option value="SI">SI
        </select></td>
        </tr>
        <tr>
        <td><b>Ingreso:</b></td>
        <td><select name="Ingreso" class="cajas">
        <option value="<?echo $filas["ingreso"];?>" selected><?echo $filas["ingreso"];?>
        <option value="NO">NO
        <option value="SI">SI
        </select></td>
        </tr>
        <tr>
        <td><b>Egreso:</b></td>
        <td><select name="Egreso" class="cajas">
        <option value="<?echo $filas["egreso"];?>" selected><?echo $filas["egreso"];?>
        <option value="NO">NO
        <option value="SI">SI
        </select></td>
        </tr>
        <tr>
        <td><b>Forma_Pago:</b></td>
        <td><select name="FormaPago" class="cajas">
        <option value="<?echo $filas["formapago"];?>" selected><?echo $filas["formapago"];?>
        <option value="DIAS">DIAS
        <option value="HORAS">HORAS
        <option value="NINGUNA">NINGUNA
        <option value="COMISION">COMISION
        <option value="DEDUCCION">DEDUCCION
          <option value="ANUAL">ANUAL
        </select></td>
        </tr>
        <tr>
        <td><b>Acumular_Horas:</b></td>
        <td><select name="TotalHoras" class="cajas">
        <option value="<?echo $filas["totalhoras"];?>" selected><?echo $filas["totalhoras"];?>
        <option value="SI">SI
        <option value="NO">NO
        <option value="IGUAL">IGUAL
         <option value="ING">ING
        </select></td>
        </tr>
        <tr>
        <td><b>Activo</b></td>
        <td><select name="Activo" class="cajas">
        <option value="<?echo $filas["activo"];?>" selected><?echo $filas["activo"];?>
        <option value="NO">NO
        <option value="SI">SI
        </select></td>
        </tr>
         <tr>
        <td><b>Permanente:</b></td>
        <td><select name="Permanente" class="cajas">
        <option value="<?echo $filas["permanente"];?>" selected><?echo $filas["permanente"];?>
        <option value="NO">NO
        <option value="SI">SI
        </select></td>
        </tr>
         <tr>
        <td><b>Estado:</b></td>
        <td><select name="Estado" class="cajas">
        <option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
        <option value="ACTIVO">ACTIVO
        <option value="INACTIVO">INACTIVO
        </select></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
        <td colspan="2"><input type="submit" value="Guardar" class="boton"></td>
        </tr>
        </table>
        </form>

        <?
endif;
        ?>
       </body>
</html>
