<?
 session_start();
?>
<html>
<head>
<title></title>
<LINK REL="stylesheet"  HREF="../estilo.css" type="text/css">
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
                        if (document.getElementById("cedemple").value.length <=0)
                        {
                            alert ("El Nro de Documento  no puede estar vacío");
                            document.getElementById("cedemple").focus();
                            return;
                        }
                        if (document.getElementById("valor").value.length <=0)
                        {
                            alert ("El campo valor  no puede estar vacío");
                            document.getElementById("valor").focus();
                            return;
                        }
                         document.getElementById("matapt").submit();
                    }
                </script>
</head>
<body>
<?
if(session_is_registered("xsession")):
if (empty($cedemple)):
?>
    <center><h4><u>Matricular Aporte</u></h4></center>
  <form action="" method="post" id="matapt">
    <table border="0" align="center">
     <tr><td><br></td></tr>
     <tr>
       <td><b>Documento de Identidad:</b></td>
       <td><input type="text" name="cedemple" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
     </tr>
     <tr><td><br></td></tr>
     <tr>
       <td colspan="2">
           <input type="submit" value="Buscar" class="boton" onclick="chequearcampos()">
           <input type="reset" value="Limpiar" class="boton">
       </td>
     </tr>
    </table>
  </form>
  <?
  elseif(empty($cedemple)):
       ?>
     <script language="javascript">
       alert("Digite el documento del empleado " )
       history.back()
     </script>
      <?
    else:
      include("../conexion.php");
         $consulta1="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.codbanco,banco.bancos from empleado,banco where
         empleado.codbanco=banco.codbanco and
         empleado.cedemple='$cedemple'";
         $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
         $regis=mysql_num_rows($resultado1);
         if ($regis==0):
         ?>
          <script language="javascript">
            alert("El documento no existe en la b.d")
            history.back()
          </script>
          <?
         else:
         ?>
         <center><h4><u>Matricular Aporte</u></h4></center>
         <?
          while ($filas=mysql_fetch_array($resultado1)):
          ?>

          <form action="guardarnuevo.php" method="post" id="matapt">
            <table border="0" align="center">
              <tr>
               <td colspan="6"><br></td>
              </tr>
            <tr>
            <td><b>Documento:</b></td>
            <td><input type="text" name="cedemple" value="<? echo $filas["cedemple"];?>" size="11" maxlength="11" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
          </tr>
          <tr>
           <td><b>Empleado:</b></td>
           <td><input type="text" name="nomemple" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?><? echo $filas["apemple1"];?>&nbsp;" class="cajas" size="40" maxlength="40" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"</td>
          </tr>
          <tr>
           <td><b>Cod_Banco:</b></td>
           <td><input type="text" name="codbanco" value="<? echo $filas["codbanco"];?>" readonly size="2" maxlength="4"</td>
           </tr>
           <tr>
           <td><b>Banco:</b></td>
           <td><input type="text" name="bancos" value="<? echo $filas["bancos"];?>" class="cajas" readonly</td>
          </tr>
          <tr>
            <td><b>Fecha_Proceso:</b></td>
                <td><input type="text" name="fechapro" value="<? echo date("Y-m-d");?>" size="10" maxlength="10" readonly</td>
          </tr>
          <tr>
                <td><b>Fecha Nomina:</b></td>
                <td><table width="100%">
                                <tr>
                                        <td><select name="d1">
                                                <option value="01">01
                                                <option value="02">02
                                                <option value="03">03
                                                <option value="04">04
                                                <option value="05">05
                                                <option value="06">06
                                                <option value="07">07
                                                <option value="08">08
                                                <option value="09">09
                                                <option value="10">10
                                                <option value="11">11
                                                <option value="12">12
                                                <option value="13">13
                                                <option value="14">14
                                                <option value="15">15
                                                <option value="16">16
                                                <option value="17">17
                                                <option value="18">18
                                                <option value="19">19
                                                <option value="20">20
                                                <option value="21">21
                                                <option value="22">22
                                                <option value="23">23
                                                <option value="24">24
                                                <option value="25">25
                                                <option value="26">26
                                                <option value="27">27
                                                <option value="28">28
                                                <option value="29">29
                                                <option value="30">30
                                                <option value="31">31
                                        </td>
                                        <td><select name="m1">
                                                <option value="01">Enero
                                                <option value="02">Febrero
                                                <option value="03">Marzo
                                                <option value="04">Abril
                                                <option value="05">Mayo
                                                <option value="06">Junio
                                                <option value="07">Julio
                                                <option value="08">Agosto
                                                <option value="09">Septiembre
                                                <option value="10">Octubre
                                                <option value="11">Noviembre
                                                <option value="12">Diciembre
                                        </td>
                                        <td><select name="a1">

                                                <option value="2008">2008
                                                <option value="2009">2009
                                                <option value="2010">2010
                                                <option value="2011">2011
                                                <option value="2012">2012
                                                <option value="2013">2013
                                                <option value="2014">2014
                                                <option value="2015">2015
                                                <option value="2016">2016
                                                <option value="2017">2017
                                                <option value="2018">2018
                                                <option value="2019">2019
                                        </td>
                                </tr>
                        </table>
                </td>
       </tr>
       <tr>
       <td><b>Valor_Consignado.:</b></td>
       <td><input type="text" name="valor" value="" size="10" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
     </tr>
     <tr><td><br></td></tr>
     <tr>
       <td colspan="2">
           <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">
           <input type="reset" value="Limpiar" class="boton">
       </td>
     </tr>
    </table>
  </form>
 <?
 endwhile;
 endif;
endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
?>
 </body>
</html>
