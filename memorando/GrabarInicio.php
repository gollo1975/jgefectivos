<?php
if(empty($Concepto)){
  ?>
  <script language="javascript">
      alert("Digite la descripción del Proceso!")
      history.back()
  </script>
  <?
}else{
   include("../conexion.php");
   $Concepto=strtoupper($Concepto);
   $cons="insert into tipoprocesomemo(concepto)
   values('$Concepto')";
   $resul=mysql_query($cons) or die("error al grabar");
    ?>
         <script language="javascript">
            alert("Datos grabados con exito en sistema!")
            open("MaestroMemo.php","_self");
         </script>
    <?
}
?>
