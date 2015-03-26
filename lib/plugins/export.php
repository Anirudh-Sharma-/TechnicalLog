<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo "export";
function createPdf(){
    echo "inside export";
require('../../fpdf17/fpdf.php');
echo "inside export1";
$pdf = new FPDF();
$pdf-> AddPage();
$pdf-> SetFont('Aerial', 'B',16);
$pdf-> Cell(40,10,'Hello World!', 1);
$pdf-> Output();
echo "hello world";
}
?>