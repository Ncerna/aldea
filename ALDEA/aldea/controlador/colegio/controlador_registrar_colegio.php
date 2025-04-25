<?php 
header("Cache-Control: no-cache, must-revalidate");
require '../../modelo/modelo_colegio.php'; 
$cole = new Colegio(); 
$idcolegio = htmlspecialchars($_POST['idcolegio'], ENT_QUOTES, 'UTF-8'); 
$colegioNombre = htmlspecialchars($_POST['colegioNombre'], ENT_QUOTES, 'UTF-8'); 
$colegioUbic = htmlspecialchars($_POST['colegioUbic'], ENT_QUOTES, 'UTF-8'); 
$colegioEmail = htmlspecialchars($_POST['colegioEmail'], ENT_QUOTES, 'UTF-8'); 
$ColegioTelefono = htmlspecialchars($_POST['ColegioTelefono'], ENT_QUOTES, 'UTF-8'); 
$ugel = htmlspecialchars($_POST['ugel'], ENT_QUOTES, 'UTF-8'); 
$municipio = htmlspecialchars($_POST['txt_municipio'], ENT_QUOTES, 'UTF-8'); 
$txt_ep = htmlspecialchars($_POST['txt_ep'], ENT_QUOTES, 'UTF-8'); 
$código_txt = htmlspecialchars($_POST['txt_code'], ENT_QUOTES, 'UTF-8'); 
$federal = htmlspecialchars($_POST['txt_federal'], ENT_QUOTES, 'UTF-8'); 
$txt_cdcee = htmlspecialchars($_POST['txt_cdcee'], ENT_QUOTES, 'UTF-8'); 
$denominación = htmlspecialchars($_POST['txt_denomination'], ENT_QUOTES, 'UTF-8'); 
$identidad = htmlspecialchars($_POST['txt_identity'], ENT_QUOTES, 'UTF-8'); 
$directores = htmlspecialchars($_POST['txt_directors'], ENT_QUOTES, 'UTF-8'); 
$upload_dir="../../imagenes/"; 
if (!file_exists($upload_dir)) { mkdir($upload_dir, 0777, true); } 
$datosColegio = $cole->obtenerDatosColegio($idcolegio); 
$NamelogoImgActual = $datosColegio['logoColegio']; 
$NamepaisImgActual = $datosColegio['escudoPais']; 
$NamebannImgActual = $datosColegio['bannerColegio']; 
if (isset($_FILES['logoImg']) && $_FILES['logoImg']['error'] == UPLOAD_ERR_OK) { 
    if (!empty($NamelogoImgActual) && file_exists($upload_dir . $NamelogoImgActual)) { unlink($upload_dir . $NamelogoImgActual); } 
    $logoImgTemp = $_FILES['logoImg']['tmp_name']; 
    $NamelogoImg = "logotipo" . date('dmyHis') . ".jpg"; 
    move_uploaded_file($logoImgTemp, $upload_dir . $NamelogoImg); 
} else { $NamelogoImg = $NamelogoImgActual; } 

if (isset($_FILES['paisImg']) && $_FILES['paisImg']['error'] == UPLOAD_ERR_OK) { 
    if (!empty($NamepaisImgActual) && file_exists($upload_dir . $NamepaisImgActual)) { unlink($upload_dir . $NamepaisImgActual); } 
    $paisImgTemp = $_FILES['paisImg']['tmp_name']; 
    $NamepaisImg = "pais" . date('dmyHis') . ".jpg"; 
    move_uploaded_file($paisImgTemp, $upload_dir . $NamepaisImg); 
} else { $NamepaisImg = $NamepaisImgActual; } 

if (isset($_FILES['bannerImg']) && $_FILES['bannerImg']['error'] == UPLOAD_ERR_OK) { 
    if (!empty($NamebannImgActual) && file_exists($upload_dir . $NamebannImgActual)) { unlink($upload_dir . $NamebannImgActual); } 
    $bannerImgTemp = $_FILES['bannerImg']['tmp_name']; 
    $NamebannImg = "banner.png"; 
    move_uploaded_file($bannerImgTemp, $upload_dir . $NamebannImg); 
} else { $NamebannImg = $NamebannImgActual; } 

$consulta = $cole->ActualizarDatosColegio($NamelogoImg,$NamepaisImg,$NamebannImg,$colegioNombre,$colegioUbic,$colegioEmail,$ColegioTelefono,$idcolegio,$ugel,$municipio,$txt_ep,$código_txt,$federal,$txt_cdcee,$denominación,$identidad,$directores); 
echo $consulta; 
?>