<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
         <script language="javascript">

            function Comision()
            {
              a = 0
              b = 0
              c = 0
              d = 0
              e = 0
              a = total = document.getElementById("convenio").value
              b = document.getElementById("porcentaje").value
              d = document.getElementById("can").value
              c =(a * b)/100 * d;
              document.getElementById("comision").value = c.toFixed(0);
            }
          </script>
<?
  if(empty($datos)):

     ?>
      <script language="javascript">
        alert("Debe de Seleccionar un Item ?")
        history.back()
        </script>
     <?
   else:
     include("../conexion.php");
     $buscador="select decomision.fechaini,decomision.fechacorte from decomision
     where decomision.codzona='$datos' and
           decomision.fechaini='$desde' and
           decomision.fechacorte='$hasta'";
     $sql=mysql_query($buscador)or die("Error en la busqueda de zonas $buscador");
     $reg=mysql_num_rows($sql);
     if($reg==0):
        $consulta="select zona.codzona from zona where codzona=$datos";
         $resultado=mysql_query($consulta) or die ("Error en la busqueda de Facturas");
         $registros=mysql_affected_rows();
         ?>
            <center><h5>Procesar Zonas</h5></center>
                         <?
                        while ($filas=mysql_fetch_array($resultado)):
                         ?>
                            <form action="guardar.php" method="post">
                            <input type="hidden" name="datos" value="<? echo $datos;?>">
                            <input type="hidden" name="desde" value="<? echo $desde;?>">
                            <input type="hidden" name="hasta" value="<? echo $hasta;?>">
                              <input type="hidden" name="zona" value="<? echo $zona;?>">
                              <input type="hidden" name="cedula" value="<? echo $cedula;?>">
                            <input type="hidden" name="codcomision" value="<? echo $codcomision;?>">
                              <table border="0" align="center">
                              <tr><td><br></td></tr>
                             <tr>
                               <td><b>Cod_Zona:</b></td>
                               <td colspan=3><input type="text" value="<?echo $filas["codzona"];?>"name="codzona" size="3" class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Zona:</b></td>
                               <td colspan=3><input type="text" value="<?echo $zona;?>" name="zona" size="50"  class="cajas" readonly></td>
                             </tr>
                             <tr>
                               <td><b>Desde:</b></td>
                               <td colspan=3><input type="text" value="<?echo $desde;?>" name="desde" size="10" class="cajas"  readonly"></td>
                             </tr>
                              <tr>
                               <td><b>Hasta:</b></td>
                               <td colspan=3><input type="text" value="<?echo $hasta;?>" name="hasta" size="10" class="cajas" readonly></td>
                             </tr>
                               <tr>
                               <td><b>Convenio:</b></td>
                               <td colspan=3><input type="text" value="" name="convenio" size="11" maxlength="11" class="cajas"></td>
                             </tr>
                             <tr>
                               <td><b>Porcentaje:</b></td>
                               <td colspan=3><input type="text" value="" name="porcentaje" size="5" maxlength="5" class="cajas" ></td>
                             </tr>
                             <tr>
                               <td><b>Cantidad:</b></td>
                               <td colspan=3><input type="text" value="" name="can" size="5" maxlength="5" class="cajas" ></td>
                             </tr>
                             <tr>
                               <td><b>Vlr_Comisión:</b></td>
                               <td colspan=3><input type="text" value="" name="comision" size="11" maxlength="11" class="cajas" onfocus="Comision()"></td>
                             </tr>
                             <tr><td><br></td></tr>
                             <tr>
                                <td colspan="5"><input type="submit" value="Enviar Dato" class="boton"></td>
                             </tr>
                              <?
                           endwhile;
     else:
       ?>
       <script language="javascript">
         alert("Esta zona ya fue grabada en este rango de fechas ?")
         history.back()
       </script>
       <?
     endif;
endif;

