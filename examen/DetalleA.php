<html>
<head>
                <title>Actualizar Estado</title>
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
    function enviar()
        {
        if (document.getElementById("Valor").value.length <=0)
           {
                alert ("Digite el valor de cobro para la empresa usuaria!.");
                document.getElementById("Valor").focus();
                return;
           }
             document.getElementById("f1").submit();
       }
</script>
        </head>
        <body>
<?php
if(!isset($Registro)){?>
   <center><h4><u>Actualizar Estado de Examen</u></h4></center>
   <form action="" method="post" id="f1" name="f1">
   <input type="hidden" name="NroE" value="<?echo $NroE;?>">
      <table border="0" align="center">
         <tr>
           <td><b>Registro:</b></td>
            <td><input type="text" name="Registro" value="<?echo $NroC;?>" size="12" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Registro"></td>
         </tr>
          <tr class="cajas">
           <td><b>Documento:</b></td>
            <td><input type="text" name="Documento" value="<?echo $Documento;?>" size="12" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Documento"></td>
         </tr>
         <tr class="cajas">
           <td><b>Empleado:</b></td>
            <td><input type="text" name="Empleado" value="<?echo $Empleado;?>" size="45" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Empleado"></td>
         </tr>
          <tr class="cajas">
           <td><b>Estado_Actual:</b></td>
            <td><input type="text" name="EstadoA" value="<?echo $EstadoA;?>" size="20" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="EstadoA"></td>
         </tr>
         <tr class="cajas">
           <td><b>Vlr_Provedor:</b></td>
            <td><input type="text" name="ValorP" value="<?echo $ValorP;?>" size="12" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ValorP"></td>
         </tr>
         <tr class="cajas">
           <td><b>Vlr_Zona:</b></td>
            <td><input type="text" name="ValorZ" value="<?echo $ValorZ;?>" size="12" class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ValorZ"></td>
         </tr>
         <tr>
          <td><b>Estado.:</b></td>
             <td><select name="Estado" class="cajasletra">
                 <option value="0">Seleccione
                 <option value="AL DIA">AL DIA
                 <option value="FALTA POR COBRAR">FALTA POR COBRAR
                 <option value="COBRAR A ZONA">COBRAR A ZONA
                 <option value="SALDO A FAVOR">SALDO A FAVOR
             </select></td>
           </tr>
           <tr class="cajas">
           <td><b>Nuevo_Valor:</b></td>
            <td><input type="text" name="Valor" value="" size="10"  maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Valor"></td>
         </tr>
            <tr class="cajas">
              <td><b>Tipo_Proceso:</b></td>
             <td><input type="radio" value="actualizar" name="Tipo">Actualizar<input type="radio" value="Adicionar" name="Tipo">Nuevo_Valor</td>
          </tr>
          <tr><td><br></td></tr>
           <tr><td ><input type="button" Value="Actualizar" class="boton" onclick="enviar()" id="buscar" name="buscar"></td></tr>
      </table>
   <form>
<?}else{
      if($Tipo=='actualizar'){

         include("../conexion.php");
         $conA="update dexamen set estado='$Estado' where dexamen.conse='$Registro'";
         $Res=mysql_query($conA)or die ("Error al actualizar");
         echo "<script language=\"javascript\">";
         echo "alert (\"Se actualizó el registro con exito.\");";
        echo ("open (\"ActualizarEstado.php?cedemple=$Documento\",\"_self\");");
         echo "</script>";
      }else{
        include("../conexion.php");
         $conA="update examen set posicion='FALTA', costoe='$Valor' where examen.nro='$NroE'";
         $Res=mysql_query($conA)or die ("Error al actualizar");
         echo "<script language=\"javascript\">";
         echo "alert (\"Se actualizó el registro con exito.\");";
         echo ("open (\"ActualizarEstado.php?cedemple=$Documento\",\"_self\");");
         echo "</script>";
      }
 }
?>
</body>
</html>
