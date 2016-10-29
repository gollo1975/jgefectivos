<html>

<head>
  <title></title>
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
         function Blanqueo()
                    {
                        if (document.getElementById("Dias").value.length <= 0)
                        {
                            alert ("El campo DIAS no puede estar vacio");
                            document.getElementById("Dias").focus();
                            return;
                        }
                        if (document.getElementById("Ibc").value.length <= 0)
                        {
                            alert ("El campo IBC no puede Estar Vacio ?");
                            document.getElementById("Ibc").focus();
                            return;
                        }
                         document.getElementById("matPrima").submit();
             }

  </script>
</head>

<body>
<?php
include("../conexion.php");
$conP="select cesantiainteres.* from cesantiainteres where
cesantiainteres.nrocesantia='$NroCesa'";
$reP=mysql_query($conP)or die("Error al buscar las cesantias");
$regP=mysql_num_rows($reP);
$filas_F=mysql_fetch_array($reP);
$Desde=$filas_F["inicioperiodo"];
$Hasta=$filas_F["fechafinal"];
$Nombres=$filas_F["nombre"];
$DiaLicencia = $filas_F["dialicencia"];
/*CODIGO DE VALIDAR PRIMAS, PARA MODIFICAR*/
$conV="select periodocesantia.* from periodocesantia where
periodocesantia.desde='$Desde' and
periodocesantia.hasta='$Hasta' and
periodocesantia.estado='ACTIVO'";
$reV=mysql_query($conV)or die("Error al buscar el periodo");
$regV=mysql_num_rows($reV);
if($regV !=0 ):
   ?>
   <center><h4><u>Editar Cesantias</u> </h4></center>
    <form action="GrabarEditarCesa.php" method="post" id="matPrima">
    <input type="hidden" name="CodZona" value="<? echo $CodZona;?>">
     <input type="hidden" name="DiaLicencia" value="<? echo $DiaLicencia;?>">
     <table border="0" align="center" width="300">
         <tr>
          <td><b>Nro_Cesant.:</b></td>
         <td><input type="text" name="NroCesa" value="<? echo $NroCesa;?>"class="cajas" size="13" readonly></td>
         <td><b>Cedula:</b></td>
         <td><input type="text" name="Cedula" value="<? echo $filas_F["cedemple"];?>"class="cajas" size="13" readonly></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
         <td colspan="3"><input type="text" name="nombres" value="<? echo $Nombres;?>" class="cajas"size="41" readonly></td>
       </tr>
       <tr>
         <td><b>F_Inicio:</b></td>
         <td colspan="1"><input type="text" name="FechaI" value="<? echo $filas_F["inicioperiodo"];?>"class="cajas" size="13" readonly></td>
         <td><b>F_Corte:</b></td>
         <td><input type="text" name="FechaC" value="<? echo $filas_F["fechafinal"];?>"class="cajas" size="13" readonly></td>
       </tr>
       <tr>
         <td><b>F_Validar:</b></td>
         <td colspan="1"><input type="text" name="FechaV" value="<? echo $filas_F["fechainicio"];?>" class="cajas" size="13" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="FechaV"></td>
         <td><b>Dias:</b></td>
         <td><input type="text" name="Dias" value="<? echo $filas_F["dias"];?>" class="cajas" size="13" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Dias"></td>
       </tr>
       <tr>
         <td><b>Ibc:</b></td>
         <td colspan="1"><input type="text" name="Ibc" value="<? echo $filas_F["salario"];?>" class="cajas" size="13" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Ibc"></td>
         <td><b>Auxilio:</b></td>
         <td><input type="text" name="Auxilio" value="<? echo $filas_F["auxilio"];?>" class="cajas" size="13" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Auxilio"></td>
       </tr>
       <tr>
         <td><b>Nota:</b></td>
         <td colspan="5"><textarea  name="Nota" cols="41" rows="4" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nota"><? echo $filas_F["nota"];?></textarea></td>
        </tr>
        <tr><td><br></td></tr>
      <tr>
         <td><input type="button" value="Validar" class="boton" onclick="Blanqueo()"></td>
      </tr>
   </table>
  </form>
     <?
else:
    ?>
    <script language="javascript">
        alert("Este registro del señor(a) : <?echo $Nombres;?>, no se puede modificar por que el periodo ya se cerro.!")
        history.back()
    </script>
    <?
endif;
?>
</body>

</html>
