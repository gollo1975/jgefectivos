<html>

<head>
  <title>Consulta de Pago de Incapacidades</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
if (!isset($dato)):
   include("../conexion.php");
     ?>
     <center><h4>Consulta de Pago de Incapacidades</h4></center>
    <form action="" method="post">
      <table border="0" align="center">
      <tr>
           <td colspan="2"><br></td>
      </tr>
      <tr>
       <td><b>Nombre de Eps:</b></td>
          <td><select name="dato" class="cajas">
          <option value="0">Seleccione la Eps
          <?
            $consulta_e="select eps.codeps,eps.eps from eps order by eps";
            $resultado_e=mysql_query($consulta_e)or die ("Consulta de eps incorrecta");
            while($filas_e=mysql_fetch_array($resultado_e)):
              ?>
              <option value="<?echo $filas_e["codeps"];?>"> <?echo $filas_e["eps"];?>
              <?
              endwhile;
              ?></select></td>
       </tr>
       <tr><td><br></td></tr>
      <tr>
        <td colspan="2">
          <input type="submit" value="Buscar" class="boton">
          <input type="reset" value="limpiar" class="boton">
        </td>
      </tr>
    </table>
    </form>
<?
elseif(empty($dato)):
?>
  <script language="javascript">
    alert ("Seleccione una administradora de la lista ?")
    history.back()
  </script>
 <?
  else:
    include("../conexion.php");
    $opcion=" select eps.eps from eps where eps.codeps='$dato'";
    $re=mysql_query($opcion)or die ("Eror de consulta $opcion");
    $reg= mysql_num_rows($re);
    if ($reg!=0):
        while($filas=mysql_fetch_array($re)):
         ?>
         <table border="0" align="center">
           <tr class="cajas">
           <center><td>&nbsp;&nbsp;<?echo $filas["eps"];?></td></center>
           </tr>
         </table>
         <?
        endwhile;
      $consulta="select descarga.documento,descarga.nroinca,descarga.fechap,descarga.diaspagado,descarga.valor,descarga.nota from descarga,eps,incapacidad where
           eps.codeps=incapacidad.codeps and
           incapacidad.nroinca=descarga.nroinca and
           eps.codeps='$dato'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta $consulta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
         ?>
        <script language="javascript">
        alert ("Esta Eps no tiene incapacidades descargadas  ?")
       open("pagada.php","_self")
        </script>
        <?
       else:
        ?>
          <tr><td><br></td></tr>
             <table border="0" align="center">
               <tr>
                 <td colspan="30"></td>
               </tr>
               <tr class="cajas">
                 <th>Documento/Cheque</th>
                 <th>Nro_Incapacidad</th>
                 <th>Fecha_Pago</th>
                 <th>Dias_Pagado</th>
                 <th>Vrl_Pagado</th>
                 <th>Nota</th>
                 </tr>
                <?
                 while($filas_s=mysql_fetch_array($resultado)):
                           ?>
                     <tr class="cajas align="center">
                       <td>&nbsp;&nbsp;<?echo $filas_s["documento"];?></a></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["nroinca"];?></td>
                        <td>&nbsp;&nbsp;<?echo $filas_s["fechap"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["diaspagado"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["valor"];?></td>
                       <td>&nbsp;&nbsp;<?echo $filas_s["nota"];?></td>
                       </tr>
                       <?
                  endwhile;
                  ?>
                   </table>
                  <?
           endif;
     else:
        ?>
          <script language="javascript">
             alert("El documento digitado no existe en Sistema ?")
             open("prueba.php","_self")
          </script>
        <?
     endif;
 endif;
 ?>
</body>
</html>
