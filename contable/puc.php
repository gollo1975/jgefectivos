<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Plan de Cuentas</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#73EABD"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function chequearcampos()
                    {
                        if (document.getElementById("Idcuenta").value.length <=0)
                        {
                            alert ("Digite la cuenta contable ");
                            document.getElementById("Idcuenta").focus();
                            return;
                        }
                        if (document.getElementById("Descripcion").value.length <=0)
                        {
                            alert ("Digite la descripcion de la cuenta contable ?");
                            document.getElementById("Descripcion").focus();
                            return;
                         }
                         document.getElementById("matpuc").submit();

                    }
  </script>
</head>

<body>
<?
if (!isset($IdCuenta))
{
?>
  <td><div align="center"><h4>Plan Unico de Cuentas (PUC)</h4></div></td>
<form  name="form1" method="post" action="" id="matpuc">
  <table width="60%" border="0" align="center">
    <tr>
      <td><td><br></td></tr>
     <tr>
      <td><b>Cuenta:</b></td>
      <td><label>
        <input name="IdCuenta" type="text" id="IdCuenta" size="10" maxlength="10"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="IdCuenta"/>
      </label></td>
      <td><b>Nombre:</b></td>
      <td><input name="Descripcion" type="text" id="Descripcion" size="50" maxlength="100"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Descripcion"/></td>
    </tr>
    <tr>
      <td><b>Recibe Movimiento:</b> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><select name="Movimiento" id="Movimiento" class="cajas">
        <option value="SI">SI</option>
        <option value="NO">NO</option>
      </select>      </td>
    </tr>
    <tr>
      <td><b>Cartera:</b></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><select name="Cartera" id="Cartera"  class="cajas">
        <option value="CxC">CxC</option>
        <option value="CxP">CxP</option>
        <option value="NO">NO</option>
            </select></td>
    </tr>
    <tr>
      <td><b>Terceros:</b></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><select name="Terceros" id="Terceros"  class="cajas">
        <option value="SI">SI</option>
        <option value="NO">NO</option>
            </select></td>
    </tr>
    <tr>
      <td><b>Centro de Costos:</b></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><select name="CentrodeCostos" id="CentrodeCostos"  class="cajas">
        <option value="SI">SI</option>
        <option value="NO">NO</option>
            </select></td>
    </tr>
    <tr>
      <td><b>Documento Referencia:</b></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><select name="DocumentoRef" id="DocumentoRef"  class="cajas">
        <option value="SI">SI</option>
        <option value="NO">NO</option>
            </select></td>
    </tr>
    <tr>
      <td><b>Requiere Base:</b></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><select name="Base" id="Base"  class="cajas">
        <option value="SI">SI</option>
        <option value="NO">NO</option>
            </select></td>
    </tr>
    <tr>
      <td><b>Porcentaje de Base:</b> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="PorcenRetencion" type="text" id="PorcenRetencion" size="10" maxlength="10"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="PorcenRetencion"/></td>
    </tr>
    <tr>
      <td><b>Cuenta de Cierre:</b> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="CuentadeCierre" type="text" id="CuentadeCierre" size="10" maxlength="10"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CuentadeCierre"/></td>
    </tr>
    <tr>
      <td><b>Cuenta de Ajuste:</b> </td>
      <td><input name="CodCuentaAjuste" type="text" id="CodCuentaAjuste" size="10" maxlength="10"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CodCuentaAjuste"/></td>
      <td>&nbsp;</td>
      <td><select name="NatCa" id="NatCa"  class="cajas">
        <option value="Debito">Debito</option>
        <option value="Credito">Credito</option>
            </select></td>
    </tr>
    <tr>
      <td><b>Contrapartida:</b></td>
      <td><input name="CodContraPart" type="text" id="CodContraPart" size="10" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="CodContraPart"/></td>
      <td>&nbsp;</td>
      <td><select name="NatCc" id="NatCc"  class="cajas">
        <option value="Debito">Debito</option>
        <option value="Credito">Credito</option>
            </select></td>
    </tr>
    <tr>
      <td><b>Saldo Anterior:</b> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="SaldoAnterior" type="text" id="SaldoAnterior" size="10" maxlength="10"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="SaldoAnterior"/></td>
    </tr>
    <tr>
      <td><b>Saldo Actual:</b></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="SaldoActual" type="text" id="SaldoActual" size="10" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="SaldoActual" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">
        <input type="button"  value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;&nbsp;
        <input type="reset" value="Limpiar" class="boton"/>
      </td>
    </tr>
  </table>
</form>
</body>
</html>
<?
}
else
{
       include ("../conexion.php");
        $consulta="select * from puc where Idcuenta='$IdCuenta'";
        $resultado=mysql_query($consulta) or die("consulta incorrecta");
        $registros=mysql_num_rows($resultado);
        if ($registros==0)
        {
                $Sw=0;
                include("validarpuc.php");
                if ($Sw==1)
                {
                        $Sw=0;
                        $Descripcion=ucfirst($Descripcion);
                        $n1=substr($IdCuenta,0,1);
                        $n2=substr($IdCuenta,0,2);
                        $n3=substr($IdCuenta,0,4);
                        $n4=substr($IdCuenta,0,6);
                        $n5=substr($IdCuenta,0,8);
                        $niv=strlen($IdCuenta);
                        $consulta="INSERT INTO puc (IdCuenta ,Descripcion ,Cartera ,Terceros ,Movimiento ,CentrodeCostos ,Base ,DocumentoRef ,PorcenRetencion ,CuentadeCierre ,CodCuentaAjuste ,CodContraPart ,NatCa ,NatCc ,Clase ,Grupo ,SubGrupo ,Cuenta ,SubCuenta ,SaldoAnterior ,VrDebito ,VrCredito ,SaldoActual ,Nivel ,CPyG )
                                VALUES ('$IdCuenta' ,'$Descripcion' ,'$Cartera' ,'$Terceros' ,'$Movimiento' ,'$CentrodeCostos' ,'$Base' ,'$DocumentoRef' ,'$PorcenRetencion' ,'$CuentadeCierre' ,'$CodCuentaAjuste' ,'$CodContraPart' ,'$NatCa' ,'$NatCc' ,'$n1' ,'$n2' ,'$n3' ,'$n5' ,'$n5' ,'$SaldoAnterior' ,'$VrDebito' ,'$VrCredito' ,'$SaldoActual' ,'$niv' ,'$CPyG' )";
                        $resultado=mysql_query($consulta) or die("Insercion Incorrecta $consulta");
                ?>
                        <script language="javascript">
                                alert("Registro Almacenado")
                                history.back()
                        </script>
                <?
                }
                else
                {
                        $Sw=0;
                        echo $consulta;
                ?>
                        <script language="javascript">
                                alert("Cuenta Incorrecta, Verifique su Origen")
                                history.back()
                        </script>
                <?
                }
        }
        else
        {
                $Sw=0;
        ?>
                <script language="javascript">
                        alert("Esta Cuenta ya Exite Registrada")
                        history.back()
                </script>
        <?
        }
}
?>
