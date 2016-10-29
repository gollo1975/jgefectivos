<html>

<head>
  <title></title>
</head>
<body>
<?
if(empty($rl)):
     ?>
       <script language="javascript">
         alert("Debe de digitar el nombre del representante legal")
         history.back()
       </script>
    <?
     elseif(empty($contacto)):
     ?>
       <script language="javascript">
         alert("Debe de digitar el nombre de la personal ercargada de nómina")
         history.back()
       </script>
    <?
     elseif(empty($pagos)):
     ?>
       <script language="javascript">
         alert("Debe de digitar el nombre de la persona de pagos")
         history.back()
       </script>
     <?
          elseif(empty($pago)):
     ?>
       <script language="javascript">
         alert("Seleccione la periocidad de pagos para esta empresa")
         history.back()
       </script>
     <?
          elseif(empty($nota)):
     ?>
       <script language="javascript">
         alert("Faltan las observaciones al contrato")
         history.back()
       </script>
     <?
        else:
          include("../conexion.php");
          $rl=strtoupper($rl);
          $contacto=strtoupper($contacto);
          $cargo=strtoupper($cargo);
          $pagos=strtoupper($pagos);
          $nota=strtoupper($nota);
           $consulta="insert into detalladozona(codzona,zona,rl,celular,contacto,cargo,telefono,ext,pagos,telefono1,ext1,pnomina,periocidad,nota)
           values('$codzona','$zona','$rl','$celular','$contacto','$cargo','$telefonoN','$ext','$pagos','$telefono','$extension','$pagonomina','$pago','$nota')";
          $resultad=mysql_query($consulta)or die("Inserccion incorrecta");
          $registro=mysql_affected_rows();
          // echo "<script language=\"javascript\">";
                  //  echo "open (\"../pie.php?msg=Se actualizaron $registro registros para la Zona: $zona\",\"pie\");";
                   // echo "open (\"../menu.php?op=zona\",\"contenido\");";
                //echo "</script>";
          ?>
          <script language="javascript">
             alert("Registro grabado exitosamente en sistemas")
             open("listadodetallado.php","_self")
          </script>
          <?
       endif;
       ?>
</body>
</html>
