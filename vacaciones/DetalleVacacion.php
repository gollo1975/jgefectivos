
<html>
<head>
<title></title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>
<body>
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
                        if (document.getElementById("Dias").value.length <=0)
                        {
                            alert ("Digite el nro de dias de las vacaciones");
                            document.getElementById("Dias").focus();
                            return;
                        }
                        document.getElementById("nuevo").submit();
                    }
</script>
<?php
include("../conexion.php");
$busca="select vacacionprogramada.* ,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona from zona,empleado,vacacionprogramada
        where  zona.codzona=vacacionprogramada.codzona and
               empleado.cedemple=vacacionprogramada.cedemple and
               vacacionprogramada.codigo_vacacion_programada_pk='$Id_V'";
$resultado=mysql_query($busca)or die("Error de Busqueda");
$filas=mysql_fetch_array($resultado);
?>
<h4><div align="center"><u>Editar Programaciones</u></div></h4>
<form action="GrabarEditarProgamacion.php" method="post" id="nuevo">
   <input type="hidden" name="Usuario" value="<?echo $Usuario?>" id="Usuario">
   <table border="0" align="center">
    <tr>
      <td><b>Id_V:</b></td>
       <td><input type="text"  value="<? echo $Id_V;?>" size="6" name="Id_V" class="cajas" readonly id="Id_V"><td>
       </tr>
        <tr>
            <td><b>Documento:</b></td>
       <td><input type="text"  value="<? echo $filas["cedemple"];?>" size="13" name="Documento" class="cajas" readonly id="Documento"><td>
       </tr>
           <tr>
                <td><b>Empleado:</b></td>
                <td><input type="text"  value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>"class="cajas" size="45" readonly></td>
           </tr>
           <tr>
               <td><b>Desde:</b></td>
               <td><input type="text" name="Desde" value="<? echo $filas["desde"];?>" size="13" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Desde"></td>
           </tr>
            <tr>
               <td><b>Hasta:</b></td>
               <td><input type="text" name="Hasta" value="<? echo $filas["hasta"];?>" size="13" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Hasta"></td>
           </tr>
            <tr>
               <td><b>Dias:</b></td>
               <td><input type="text" name="Dias" value="<? echo $filas["dias"];?>" size="6" maxlength="6" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Dias"></td>
           </tr>
            <tr>
               <td><b>Zona:</b></td>
               <td><input type="text" value="<? echo $filas["zona"];?>" size="45" maxlength="45" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" ></td>
           </tr>
           <tr>
                <td><b>Cod_Salario:</b></td>
                    <td colspan="30"><select name="CodSala"class="cajas" id="CodSala">
                           <?
                           $aux=$filas["codsala"];
                           $consulta_c="select codsala,desala from salario  where salario.ibcprestacional='SI' order by desala";
                           $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
                           while ($filas_c=mysql_fetch_array($resultado_c)){
                                 if($aux==$filas_c["codsala"]){
                                      ?>
                                      <option value="<?echo $filas_c["codsala"];?>" selected><?echo $filas_c["desala"];?>
                                      <?
                                 }else{
                                      ?>
                                      <option value="<?echo $filas_c["codsala"];?>"><?echo $filas_c["desala"];?>
                                      <?
                                 }
                           }
                           ?>
                     </select></td>
           </tr>
           <tr><td><br></td></tr>
          <tr>
             <td colspan="5">
                <input type="button" value="Grabar Dato" class="boton" id="grabar" onclick="chequearcampos()">
            </td>
          </tr>
      </table>
  </form>
 </body>
</html>
