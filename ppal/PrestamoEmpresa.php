<html>
<head>
  <title>Autorización Prestamo</title>
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
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de identidad del empleado");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matP").submit();

                    }
                </script>
</head>
<body>
<?
if (!isset($cedula)):
 ?>
 <center><h4><u>Autorización Prestamo</u></h4></center>
  <form action="" method="post" id="matP">
    <table border="0" align="center">
     <tr><td><br></td></tr>
       <tr>
         <td><b>Documento de Identidad:</b></td>
         <td><input type="text" name="cedula" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspna="3">
         <input type="button" value="Buscar Dato" class="boton" Onclick="chequearcampos()"></td>
       </tr>
    </table>
  </form>
<?
else:
   include("../conexion.php");
   $cons="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.codemple,zona.zona from empleado,contrato,zona where
         zona.codzona=empleado.codzona and
         empleado.codemple=contrato.codemple and
         contrato.fechater='0000-00-00' and
         empleado.cedemple='$cedula' and
         zona.codzona='$codigo'";
   $resu=mysql_query($cons)or die ("Error al buscar informaacion");
   $reg=mysql_num_rows($resu);
   if($reg!=0):
    while($filas=mysql_fetch_array($resu)):
     ?>
          <center><h4><u>Autorización Prestamo</u></h4></center>
          <form action="grabarprestamo.php" method="post" width="400">
           <table border="0" align="center">
           <input type="hidden" name="codigo" value="<? echo $codigo;?>">
             <tr><td><br></td></tr>
             <tr>
                <td><b>Documento:</b></td>
               <td><input type="text" name="cedula" value="<? echo $cedula;?>"class="cajas" size="15" maxlenght="15" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
             </tr>
             <tr>
                <td><b>Empleado:</b></td>
               <td colspan="5"><input type="text" name="nombre" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" class="cajas"size="55" maxlenght="55" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
             </tr>
              <tr>
                <td><b>Zona:</b></td>
               <td colspan="5"><input type="text" name="zona" value="<? echo $filas["zona"];?>" class="cajas"size="55" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona"></td>
             </tr>
             <tr>
               <td><b>F_Proceso:</b></td>
               <td ><input type="text" name="fechaP" value="<? echo date("Y-m-d");?>" class="cajas"size="13" maxlenght="10" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechaP"></td>
               <td><b>F_Desembolso:</b></td>
               <td><input type="text" name="fechaD" value="<? echo date("Y-m-d");?>" class="cajas"size="13" maxlenght="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechaD"></td>
             </tr>
             <tr>
                <td><b>Forma de Pago:</b></td>
               <td colspan="12"><input type="radio" name="formapago" value="SEMANAL" class="cajas"><b>Semanal</b>&nbsp;&nbsp;<input type="radio" name="formapago" value="DECADAL" class="cajas"><b>Decadal</b>&nbsp;&nbsp;<input type="radio" name="formapago" value="QUINCENAL" class="cajas"><b>Quincenal</b>&nbsp;&nbsp;<input type="radio" name="formapago" value="MENSUAL" class="cajas"><b>Mensual</b></td>
             </tr>
             <tr>
               <td><b>Vlr_Prestamo:</b></td>
               <td ><input type="text" name="valor" value="" class="cajas"size="13" maxlenght="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
               <td><b>Dias:</b></td>
               <td ><input type="text" name="dias" value="" class="cajas"size="13" maxlenght="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dias"></td>
             </tr>
             <tr>
               <td><b>Responsable:</b></td>
               <td colspan="4"><input type="text" name="responsable" value="" class="cajas"size="55" maxlenght="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="resposanble"></td>

             </tr>
              <tr>
                 <td><b>Observación:</b></td>
                            <td colspan="9"><textarea name="observacion" cols="60" rows="4" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion"></textarea></td></tr>
                 <tr>
             <tr><td><br></td></tr>
             <tr>
               <td colspan="5">
                  <input type="submit" value="Guardar Dato" class="boton"></td>
             </tr>
           </table>
         </form>
         <?
      endwhile;
   else:
     ?>
     <script language="javascript">
      alert("Este Documento no existe o no esta autorizado para crear este registro ?..")
     open("PrestamoEmpresa.php?codigo=<?echo $codigo;?>","_self")
     </script>
     <?
   endif;
endif;
 ?>
</body>
</html>
