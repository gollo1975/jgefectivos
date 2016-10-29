<html>
<head>
  <title>Solictud Cupo de Crédito</title>
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
                            alert ("Favor digite el documento de identidad del Empleado");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matcupo").submit();

                    }
                </script>
</head>
<body>
<?
  if (!isset($cedula)):

  ?>
  <center><h4><u>Solicitud de Cupo</u></h4></center>
<form action="" method="post" id="matcupo">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Documento Empleado:</b></td>
     <td><input type="text" name="cedula" value="" size="15" maxlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">
     </tr>
      <tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="button" value="Buscar" class="boton" Onclick="chequearcampos()">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
   <tr><td></td></tr>
    <tr><td></td></tr>
</table>
</form>
<?
else:
 include("../conexion.php");
   $conH="select cupocredito.* from cupocredito,empleado
              where empleado.cedemple=cupocredito.cedemple and
                    empleado.cedemple='$cedula'";
   $resH=mysql_query($conH)or die("Error al buscar contratos cupos de creditos");
   $regH=mysql_num_rows($resH);
   if($regH != 0 ):
      ?>
     <center><h4><u>Listado de Cupos</u></h4></center>
     <table border="0" align="center">
       <tr class="cajas">
          <th>Reg.</th>
          <th>Nro_Cupo</th>
          <th>Documento</th>
          <th>Empleado</th>
          <th>F_Proceso</th>
          <th>Vlr_Cupo</th>
          <th>Solicitado</th>
       </tr>
       <?$x=1;
        while($filas_T=mysql_fetch_array($resH)):
        $valor=number_format($filas_T["vlrcupo"],0);
           ?>
             <tr class="cajas">
                 <th><?echo $x;?></th>
                 <td><div align="center"><?echo $filas_T["nrocupo"];?></div></td>
                <td><? echo $filas_T["cedemple"];?> </td>
                <td><?echo $filas_T["empleado"];?></td>
                <td><div align="center"><?echo $filas_T["fechap"];?></div></td>
                <td><div align="center"><?echo $valor;?></div></td>
                <td><?echo $filas_T["documento"];?></td>
             </tr>
           <?$x=$x+1;
        endwhile;
       ?>
     </table>
    <?
    else:
      ?>
         <script language="javascript">
             alert("Este documento no tiene cupos de créditos generados.!")
             history.back()
         </script>
         <?
    endif;
  endif;
  ?>
</table>

</body>
</html>
