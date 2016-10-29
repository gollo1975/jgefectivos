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
$conP="select prima.* from prima where
prima.nroprima='$NroPrima'";
$reP=mysql_query($conP)or die("Error al buscar la prima semestral");
$regP=mysql_num_rows($reP);
$filas_F=mysql_fetch_array($reP);
$Desde=$filas_F["fechai"];
$Hasta=$filas_F["fechacorte"];
$Nombres=$filas_F["nombre"];
/*CODIGO DE VALIDAR PRIMAS, PARA MODIFICAR*/
$conV="select periodoprima.* from periodoprima where
periodoprima.desde='$Desde' and
periodoprima.hasta='$Hasta' and
periodoprima.estado='FALTA'";
$reV=mysql_query($conV)or die("Error al buscar el periodo");
$regV=mysql_num_rows($reV);
if($regV !=0 ):
   ?>
   <center><h4><u>Editar Prima</u> </h4></center>
    <form action="GrabarEditar.php" method="post" id="matPrima">
    <input type="hidden" name="CodZona" value="<? echo $CodZona;?>">
    <input type="hidden" name="Validar" value="<? echo $Validar;?>">
     <table border="0" align="center" width="300">
         <tr>
          <td><b>Nro_Prima:</b></td>
         <td><input type="text" name="NroPrima" value="<? echo $NroPrima;?>"class="cajas" size="13" readonly></td>
         <td><b>Cedula:</b></td>
         <td><input type="text" name="Cedula" value="<? echo $filas_F["cedemple"];?>"class="cajas" size="13" readonly id="Cedula"></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
         <td colspan="3"><input type="text" name="nombres" value="<? echo $Nombres;?>" class="cajas"size="41" readonly></td>
       </tr>
       <tr>
         <td><b>F_Inicio:</b></td>
         <td colspan="1"><input type="text" name="FechaI" value="<? echo $filas_F["fechai"];?>"class="cajas" size="13" readonly></td>
         <td><b>F_Corte:</b></td>
         <td><input type="text" name="FechaC" value="<? echo $filas_F["fechacorte"];?>"class="cajas" size="13" readonly></td>
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
	      <td><b>Validar días</b></td>
	      <td colspan="10"><input type="radio" value="SI"  name="Control">No descontar días </td>
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
