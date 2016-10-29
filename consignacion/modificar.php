<?
 session_start();
?>
<html>
<head>
<title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<?
 if(session_is_registered("xsession")):
if (!isset($nrocon)):
?>
    <center><h4><u>Modificar Datos</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center">
     <tr><td><br></td></tr>
      <tr>
        <td><b>Nro_Consignacion:</b></td>
        <td><input type="text" name="nrocon" value="" size="10" maxlength="10"></td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
    </tr>
   </table>
   </form>
<?
elseif(empty($nrocon)):
?>
  <script language="javascript">
    alert("Digite el valor a consultar ?")
    history.back()
  </script>
<?
  else:
    include("../conexion.php");
    $consulta="select * from consignacion where nrocon='$nrocon'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
     ?>
     <script language="javascript">
       alert("No existe el Nro de consignacion en la bd. ?")
       history.back()
     </script>
    <?
     else:
       while($filas=mysql_fetch_array($resultado)):
       ?>
        <center><h4><u>Datos Modificar</u></h4></center>
         <form action="guardar.php" method="post">
           <table border="0" align="center">
             <tr>
               <td colspan="2"><br></td>
             </tr>
             <tr>
               <td><b>Nro_Consignacion:</b></td>
               <td><input type="text" value="<?echo $filas["nrocon"];?>" name="nrocon" readonly></td>
             </tr>
             <tr>
               <td><b>Empleado:</b></td>
               <td><select name="empleado"  class="cajas">
                 <?
                 $depaux=$filas["cedemple"];
                 $consulta_e="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato
                 where empleado.codemple=contrato.codemple and
                 contrato.fechater='0000-00-00' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
                 $resultado_e=mysql_query($consulta_e)or die("Consulta de empleado incorrecta");
                 while($filas_e=mysql_fetch_array($resultado_e)):
                   if ($depaux==$filas_e["cedemple"]):
                 ?>
                 <option value="<?echo $filas_e["cedemple"];?>" selected><?echo $filas_e["nomemple"];?>&nbsp;<?echo $filas_e["nomemple1"];?>&nbsp;<?echo $filas_e["apemple"];?>&nbsp;<?echo $filas_e["apemple1"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_e["cedemple"];?>"><?echo $filas_e["nomemple"];?>&nbsp;<?echo $filas_e["nomemple1"];?>&nbsp;<?echo $filas_e["apemple"];?>&nbsp;<?echo $filas_e["apemple1"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
               </tr>
               <tr>
               <td><b>Nombre_Banco:</b></td>
               <td><select name="nombre" class="cajas">
                 <?
                 $aux=$filas["codbanco"];
                 $consulta_b="select * from banco order by codbanco";
                 $resultado_b=mysql_query($consulta_b)or die("Consulta de banco incorrecta");
                 while($filas_b=mysql_fetch_array($resultado_b)):
                   if ($aux==$filas_b["codbanco"]):
                 ?>
                 <option value="<?echo $filas_b["codbanco"];?>" selected><?echo $filas_b["bancos"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_b["codbanco"];?>"><?echo $filas_b["bancos"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
               </tr>
                <tr>
                  <td><b>Fecha_Proceso:</b></td>
                  <td><input type="text" value="<?echo $filas["fechapro"];?>" name="fechapro" readonly></td>
                </tr>
          <tr>
                <td><b>Fecha Final:</b></td>
                <td><table width="100%">
                <?
                    $fecha=$filas["fechapago"];
                    $d1=substr($fecha,8,2);
                    $m1=substr($fecha,5,2);
                    $a1=substr($fecha,0,4);
                ?>
                   <tr>
                      <td><select name="d1">
                        <option value="<?echo $d1;?>" selected><?echo $d1;?>
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
                                                <?
                         switch ($m1)
                          {
                            case 1:
                              $mes="Enero";
                               break;
                            case 2:
                              $mes="Febrero";
                               break;
                            case 3:
                               $mes="Marzo";
                                break;
                            case 4:
                               $mes="Abril";
                                break;
                            case 5:
                               $mes="Mayo";
                               break;
                            case 6:
                               $mes="Junio";
                               break;
                            case 7:
                              $mes="Julio";
                              break;
                            case 8:
                              $mes="Agosto";
                               break;
                            case 9:
                              $mes="Septiembre";
                               break;
                            case 10:
                              $mes="Octubre";
                              break;
                            case 11:
                             $mes="Noviembre";
                             break;
                            case 12:
                              $mes="Diciembre";
                            break;
                             }
                            ?>
                            <option value="<?echo $m1;?>" selected><?echo $mes;?>
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
                                  <option value="<?echo $a1;?>" selected><?echo $a1;?>
                                  <option value="2000">2000
                                  <option value="2001">2001
                                  <option value="2002">2002
                                  <option value="2003">2003
                                  <option value="2004">2004
                                  <option value="2005">2005
                                  <option value="2006">2006
                                  <option value="2007">2007
                                  <option value="2008">2008
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
                 <td><b>Valor:</b></td>
                 <td><input type="text" value="<?echo $filas["valor"];?>" name="valor"size="11" maxlength="11"></td>
               </tr>
               <tr><td><br></td></tr>
               <tr>
               <td colspan="2">
                 <input type="submit" value="Guardar" class="boton">
                 <input type="reset" value="Limpiar" class="boton">
               </td>
              </tr>
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
       <tr><td><br></td></tr>
     </table>
     </form>
</body>
</html>
