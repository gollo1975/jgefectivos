<html>
<head>
<title><u>Generando Prestaciones</u></title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">

  function cesantia()
  {
    x = 0
    z = 0
    total = 0
    t1 = 0
    devo = 0
    if (document.getElementById("cesantia[]").checked == true )
   {
      x = parseFloat(document.getElementById("salario").value) + parseFloat(document.getElementById("auxilio").value);
      z = document.getElementById("dias").value;
      total = (x * z)/360;
      document.getElementById("valor1").value = total.toFixed(0);
      document.getElementById("pagar").value=total.toFixed(0)
   }
   else
   {
    total = parseFloat(document.getElementById("pagar").value)- parseFloat(document.getElementById("valor1").value);
    document.getElementById("valor1").value= total.toFixed(0);
    document.getElementById("pagar").value=total.toFixed(0)
    }
  }
  function interes()
     {
     uno = 0
     dos = 0
     t2 = 0
     acumulador = 0
     if (document.getElementById("interes[]").checked == true )
     {
      dos = document.getElementById("dias").value;
      uno = ((total * z)*0.12)/360;
      document.getElementById("valor2").value = uno.toFixed(0);
      acumulador = parseFloat(document.getElementById("valor1").value)+  parseFloat(document.getElementById("valor2").value);
      document.getElementById("pagar").value=acumulador.toFixed(0)
     }
     else
     {
     total = parseFloat(document.getElementById("pagar").value)- parseFloat(document.getElementById("valor2").value);
     document.getElementById("valor2").value= 0;
     document.getElementById("pagar").value=total.toFixed(0)
     }
   }
   function prima()
     {
      c = 0
      d = 0
      h = 0
     total = 0
     acumulador = 0
     aux = 0
     if (document.getElementById("diaprima").value != 0 )
          {
             c = parseFloat(document.getElementById("salario").value);
             h = parseFloat(document.getElementById("auxilio").value);
	     d = document.getElementById("diaprima").value;
	     aux = ((c + h) * d)/360;
	     document.getElementById("valor3").value = aux.toFixed(0);
             acumulador = parseFloat(document.getElementById("valor1").value) +  parseFloat(document.getElementById("valor2").value)+  parseFloat(document.getElementById("valor3").value);
	     document.getElementById("pagar").value=acumulador.toFixed(0)
          }
         else
          {
           alert("Debe de Digitar el Nro de Dias Para Calcular la Prima");
           document.getElementById("valor3").value= 0;
          }
          if (document.getElementById("prima[]").checked == true )
            {
            }
            else
            {
             total = parseFloat(document.getElementById("pagar").value)- parseFloat(document.getElementById("valor3").value);
             document.getElementById("valor3").value= 0;
             document.getElementById("pagar").value=total.toFixed(0)
           }
         }
     function vacacion()
     {
     xvar = 0
     xvar1 = 0
     xvar2 = 0
     xvar3 = 0
     t4 = 0
     acumulador = 0
     if (document.getElementById("vacacion[]").checked == true )
     {
      xvar = document.getElementById("dias").value;
      xvar1 = document.getElementById("compensacion").value;
      xvar2 = (xvar * 15)/360;
      xvar3=  (xvar1 /30)* xvar2;
      document.getElementById("valor4").value = xvar3.toFixed(0);
      acumulador = parseFloat(document.getElementById("valor1").value) +  parseFloat(document.getElementById("valor2").value) +  parseFloat(document.getElementById("valor3").value)+  parseFloat(document.getElementById("valor4").value);
      document.getElementById("pagar").value=acumulador.toFixed(0)
     }
     else
     {
      total = parseFloat(document.getElementById("pagar").value)- parseFloat(document.getElementById("valor4").value);
      document.getElementById("valor4").value= 0;
      document.getElementById("pagar").value=total.toFixed(0)
     }
   }

</script>
</head>
<body>
<?
include("../conexion.php");
  ?>
 <center><h4><u>Generar Prestaciones</u> </h4></center>
   <form action="guardarcesantia.php" method="post">
     <table border="0" align="center" width="300">
      <tr><td><br></td></tr>
         <tr>
         <td><b>Cedula:</b></td>
         <td colspan="1"><input type="text" name="cedula" value="<? echo $cedula;?>"class="cajas" size="13" maxlength="13"></td>
         <td><b>Salario:</b></td>
         <td colspan="1"><input type="text" name="compensacion" value="<? echo $salario;?>"class="cajas" size="13" maxlength="13"></td>
       </tr>
       <tr>
         <td><b>Empleado:</b></td>
         <td colspan="3"><input type="text" name="nombre" value="<? echo $nombre;?>&nbsp;<? echo $nombre1;?>&nbsp;<? echo $apellido;?>&nbsp;<? echo $apellido1;?>" class="cajas"size="44" maxlength="44"></td>
       </tr>
       <tr>
         <td><b>Fecha_Proceso:</b></td>
         <td colspan="1"><input type="text" name="fechap" value="<? echo date("Y-m-d");?>"class="cajas" size="13" maxlength="10" readonly></td>
         <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="fechainic" value="<? echo $fechai;?>"class="cajas" size="13" maxlength="10" readonly></td>
       </tr>
       <tr>
         <td><b>Fecha_Corte:</b></td>
         <td colspan="1"><input type="text" name="fechacorte" value="<? echo $fechac;?>" class="cajas" size="13" maxlength="10" ></td>
         <td><b>Ibc:</b></td>
         <td colspan="1"><input type="text" name="salario" value="<? echo $ibc;?>" class="cajas" size="13" maxlength="10" ></td>
       </tr>
        <tr>
         <td><b>Dias:</b></td>
         <td colspan="1"><input type="text" name="dias" value="<? echo $dia;?>" class="cajas" size="13" maxlength="10"></td>
         <td><b>Auxilio:</b></td>
         <td colspan="1"><input type="text" name="auxilio" value="" class="cajas" size="13" maxlength="10" ></td>
        </tr>
         <tr>
         <td><b>Prestamos:</b></td>
         <td colspan="1"><input type="text" name="prestamo" value="" class="cajas" size="13" maxlength="10"></td>
         <td><b>Vestuario:</b></td>
         <td colspan="1"><input type="text" name="vestuario" value="" class="cajas" size="13" maxlength="10" ></td>
        </tr>
         <tr>
         <td><b>Otros Dcto:</b></td>
         <td colspan="1"><input type="text" name="otros" value="" class="cajas" size="13" maxlength="10"></td>
         <td><b>Dcto_Comf.:</b></td>
         <td colspan="1"><input type="text" name="comfenalco" value="" class="cajas" size="13" maxlength="10" ></td>
        </tr>
         <tr>
         <td><b>Total_Pagar:</b></td>
         <td colspan="1"><input type="text" name="pagar" value="" class="cajas" size="13" maxlength="10"></td>
         </tr>
         <table border="0" align="center" width="300">
              <tr>
               <td>&nbsp;<input type="checkbox" name="cesantia[]" onClick="cesantia()"<b>&nbsp;&nbsp;&nbsp;<b>Cesantia:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="valor1" value="" size="11" maxlength="11" ></td>
             </tr>
             <tr>
              <td>&nbsp;<input type="checkbox" name="interes[]"onClick="interes()"<b>&nbsp;&nbsp;&nbsp;<b>Interes:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="valor2" value="" size="11" maxlength="11"></td>
             </tr>
             <tr>
              <td>&nbsp;<input type="checkbox" name="prima[]" onClick="prima()"<b>&nbsp;&nbsp;&nbsp;<b>Primas:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="valor3" value="0" size="11" maxlength="11"><b>Dias_Prima:</b><input type="text" name="diaprima" value="" size="4" maxlength="4"></td>
            </tr>
            <tr>
              <td>&nbsp;<input type="checkbox" name="vacacion[]" onClick="vacacion()"<b>&nbsp;&nbsp;&nbsp;<b>Vacaciones:</b>&nbsp;&nbsp;&nbsp;<input type="text" name="valor4" value="" size="11" maxlength="11"></td>
            </tr>
            <tr>
              <td colspan="5"><textarea name="nota" cols="55" rows="5"  class="cajas">JGEFECTIVOS S.A.S. "E.S.T.", QUEDA A PAZ Y SALVO CON EL PAGO DE SUS PRESTACIONES SOCIALES.</textarea></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
         <td><input type="submit" value="Guardar" class="boton"></td>
      </tr>
      </table>
        </table>
   </form>
</body>
</html>
