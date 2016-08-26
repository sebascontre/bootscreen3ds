<?php

$REGION = isset($_GET['region']) ? strtolower($_GET['region']) : "usa";
$MODEL = isset($_GET['model']) ? strtolower($_GET['model']) : "3ds";
$SD = isset($_GET['sd']) ? strtolower($_GET['sd']) : "2g";
$ONBOOT = isset($_GET['onboot']) ? strtoupper($_GET['onboot']) : false;
$DOUBLE = isset($_GET['double']) ? strtolower($_GET['double']) : false;
$TYPE = isset($_GET['type']) ? strtolower($_GET['type']) : "luma_601";

switch ($TYPE) {
    case 'luma_61':
        $base = imagecreatefrompng('luma_61.png');
        break;
    case 'luma_601':
        $base = imagecreatefrompng('luma_601.png');
        break;
    case 'luma_60':
        $base = imagecreatefrompng('luma_60.png');
        break;
    case 'menuhax_31':
        $base = imagecreatefrompng('base_v3.1.png');
        $DOUBLE = true;
        break;
    case 'menuhax_30':
        $base = imagecreatefrompng('base_v3.0.png');
        $DOUBLE = true;
        break;
    case 'menuhax_22':
        $base = imagecreatefrompng('base_v2.2.png');
        $DOUBLE = true;
        break;
    default:
        $base = imagecreatefrompng('base.png');
        $DOUBLE = true;
        break;
}


$SECONDLINE = isset($_GET['secondLine']) ? strtolower($_GET['secondLine']) : false;
$SECONDBUTTON = isset($_GET['secondButton']) ? strtoupper($_GET['secondButton']) : false;
$SECONDTOOL = isset($_GET['secondTool']) ? strtolower($_GET['secondTool']) : false;



if ($REGION === "usa" || $REGION === "eur" || $REGION === "jpn") {
    if ($MODEL === "3ds" || $MODEL === "3dsxl" || $MODEL === "2ds") {
        $version = imagecreatefrompng("modules/".$REGION."_".$MODEL.".png");
        $data = imagecreatefrompng('modules/data_old.png');
    } else if ($MODEL === "new3ds" || $MODEL === "new3dsxl") {
        $version = imagecreatefrompng("modules/".$REGION."_".$MODEL.".png");
        $data = imagecreatefrompng('modules/data_new.png');
    }
}

if ($SD === "2g" || $SD === "4g" || $SD === "8g" || $SD === "16g" || $SD === "32g" || $SD === "64g" || $SD === "128g") {
    $space = imagecreatefrompng("modules/sd_".$SD.".png");
}


if ($ONBOOT === "L" || $ONBOOT === "R" || $ONBOOT === "A" || $ONBOOT === "B" || $ONBOOT === "X" || $ONBOOT === "Y" || $ONBOOT === "UP" || $ONBOOT === "DOWN" || $ONBOOT === "LEFT" || $ONBOOT === "RIGHT" || $ONBOOT === "SELECT" || $ONBOOT === "START") {
    $holdBOOT = imagecreatefrompng("modules/sysnand_".$ONBOOT.".png");
    imagecopymerge($base, $holdBOOT, 0, 195, 0, 195, 400, 14, 100);
}

if ($SECONDLINE && $SECONDBUTTON & $SECONDTOOL) {
    $rxt = imagecreatefrompng("modules/".$SECONDTOOL."/".$SECONDTOOL."_".$SECONDBUTTON.".png");
    imagecopymerge($base, $rxt, 0, 211, 0, 211, 400, 14, 100);
}

imagecopymerge($base, $version, 0, 83, 0, 83, 260, 10, 100);
imagecopymerge($base, $data, 175, 115, 175, 115, 180, 26, 100);
imagecopymerge($base, $space, 231, 163, 231, 163, 100, 10, 100);

if ($DOUBLE) {
    $final = imagecreatefrompng('base_doble.png');
    imagecopymerge($final, $base, 0, 0, 0, 0, 400, 240, 100);
    imagecopymerge($final, $base, 400, 0, 0, 0, 400, 240, 100);
    $base = $final;
}

header('Content-Type: image/png');
header('Content-Disposition: filename="imagedisplay.png"');
imagepng($base);

?>