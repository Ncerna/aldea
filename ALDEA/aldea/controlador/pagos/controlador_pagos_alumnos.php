<?php
   require '../../modelo/modelo_pagos.php';
    $MU = new Pagos();

    date_default_timezone_set('America/Lima');
    $idalum = htmlspecialchars($_POST['alumid'],ENT_QUOTES,'UTF-8');
    $yearid = htmlspecialchars($_POST['yearid'],ENT_QUOTES,'UTF-8');
    $fechas = htmlspecialchars($_POST['arrayF'],ENT_QUOTES,'UTF-8');
    $pagos = htmlspecialchars($_POST['arrayP'],ENT_QUOTES,'UTF-8');
     $fechmay = htmlspecialchars($_POST['fechmay'],ENT_QUOTES,'UTF-8');

       //vectores
       $vecFech= explode(",",$fechas );
       $pagovect = explode(",",$pagos );//separanso vector

       for ($i=0; $i <count($pagovect) ; $i++) { 
         if ($pagovect[$i] !='') {
            
            //SUMANDO FECHA UN DIA YA QUE EN PERU JS TOMA UN DIA MENOS
               $nuevafecha = strtotime ( '+1 day' , strtotime ($vecFech[$i]) ) ;
               $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
              //FIN DE SUMA

           $consulta = $MU->Pagos_mensuales_Alumnos($idalum,$pagovect[$i],$nuevafecha,$yearid);
         }
     }

      //SUMANDO FECHA UN DIA YA QUE EN PERU JS TOMA UN DIA MENOS
       $dateMayor = strtotime ( '+1 day' , strtotime ($fechmay) ) ;
       $dateMayor = date ( 'Y-m-j' ,  $dateMayor);
              //FIN DE SUMA

     //SUMANDO I MES MAS AL LAFECHA MAYOR O ULTIMO PRA EL PROXIMO PAGO
     $fechaProximoPago = date('Y-m-d H:i:s',strtotime($dateMayor."+ 1 month"));
     $FechaActual=date('Y-m-d');

      $consulta = $MU->Actualizar_Tabla_Estados($idalum,$dateMayor, $fechaProximoPago,$yearid,$FechaActual);
    echo $consulta;
    


?>