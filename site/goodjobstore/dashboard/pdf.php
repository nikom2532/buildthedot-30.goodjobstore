<?php
include("FPDF/fpdf.php");
$pdf = new FPDF();  //����ö��˹��������������������� ������С���Ƕ֧����


$pdf->AddPage();		//����ö��˹��������������������� ������С���Ƕ֧����
$pdf->SetFont("Arial", "", 20);   //���Ǹ�����("")��Ҵ 20 pt
$pdf->Write(10, "Hello, This is my first PDF with PHP"); //10 ��ͤ����٧��÷Ѵ
$pdf->Output();		
?>