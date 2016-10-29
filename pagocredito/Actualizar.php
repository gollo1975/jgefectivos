        <html>
        <head>
                <title>Actulizar Saldo</title>
                  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
                  <script language="javascript">
            function sumarTotal()
        {
               total = document.getElementById("cantidad").value
               total1 = document.getElementById("vlruni").value
               subtotal = parseFloat (total) * parseFloat(total1);
               document.getElementById("total").value =  parseFloat(subtotal);
         }
</script>
        </head>
        <body>
<?
include("../conexion.php");
$consulta="select credito.nrocredito,credito.tcredito,credito.cuota,credito.nuevo,credito.plazo,credito.nota from credito where nrocredito='$NroCredito'";
$resultado=mysql_query($consulta) or die("consulta incorrecta");
$registros=mysql_num_rows($resultado);
$filas=mysql_fetch_array($resultado);
  ?>
   <center><h4><u>Actualizar</u></h4></center>
   <form action="GrabarA.php" method="post">
       <td><input type="hidden" name="cedula" value="<?echo $cedula;?>"</td>
       <table border="0" align="center">
            <tr><td><br></td></tr>
            <tr>
               <td><b>Nro_Credito:</b></td>
               <td><input type="text" name="nrocredito" value="<?echo $NroCredito;?>" class="cajas" size="10" readonly></td>
               <td><b>Plazo:</b></td>
               <td><input type="text"  value="<?echo $filas["plazo"];?>" class="cajas" size="10" readonly></td>
            </tr>
             <tr>
               <td><b>Saldo:</b></td>
               <td><input type="text" name="saldo" value="<?echo $filas["nuevo"];?>" class="cajas" size="10" readonly></td>
              <td><b>T_Credito:</b></td>
               <td><input type="text" name="tcredito" value="<?echo $filas["tcredito"];?>" class="cajas" size="10" readonly></td>
            </tr>
             <tr>
               <td><b>N_Valor:</b></td>
               <td><input type="text" name="nuevo" value="" class="cajas" size="10"></td>
                  <td><b>N_Cuota:</b></td>
               <td><input type="text" name="cuota" value="" class="cajas" size="10"></td>
            </tr>
              <tr>
                            <td><b>Nota:</b></td>
                            <td colspan="9"><textarea name="nota" cols="35" rows="6" class="cajas"><?echo $filas["nota"];?></textarea></td></tr>
             <tr><td><br></td></tr>
            <tr>
    <td colspan="2">
      <input type="submit" value="Procesar" class="boton">
          </td>
  </tr>

       </table>
    </form>


        </body>
</html>
