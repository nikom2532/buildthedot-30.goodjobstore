<?php
// Including all required classes
require('class/BCGFont.php');
require('class/BCGColor.php');
require('class/BCGDrawing.php'); 

// Including the barcode technology
include('class/BCGcode128.barcode.php'); 

// Loading Font
function ImageBarcode($line1,$line2,$line3)
{
		$font =& new BCGFont('./class/font/Arial.ttf', 8);
		
		// The arguments are R, G, B for color.
		$color_black =& new BCGColor(0, 0, 0);
		$color_white =& new BCGColor(255, 255, 255); 
		
		$code = new BCGcode128();
		$code->setScale(1); // Resolution
		$code->setThickness(30); // Thickness
		$code->setForegroundColor($color_black); // Color of bars
		$code->setBackgroundColor($color_white); // Color of spaces
		$code->setFont($font); // Font (or 0)
		$code->setStart("A");  //Start With Barcode 128A
		$code->setTilde(true);
		$crString = chr(13);  /// New Line CR  **************************************
		$bacodeText = $line1 .$crString . $line2.$crString.''.$crString.$line3;  //  Input Value here  ***********
		//echo $bacodeText;
		$code->setLabel($line1.'   '.$line2.'  '.$line3) ;
		$code->parse($bacodeText); // Text
		
		
		/* Here is the list of the arguments
		1 - Filename (empty : display on screen)
		2 - Background color */
		$barcodeImageName ='barcodeimage/'. time().rand(1,6).".png";  // Path
		$drawing = new BCGDrawing($barcodeImageName, $color_white);
		$drawing->setBarcode($code);
		$drawing->draw();
		
		// Header that says it is an image (remove it if you save the barcode to a file)
		//header('Content-Type: image/png');
		
		// Draw (or save) the image into PNG format.
		$drawing->finish($drawing->IMG_FORMAT_PNG);
		return $barcodeImageName;
}
//the input values are as follows

//use the ImageBarcode function for create image and return image path
//echo $barcodeImageName; // use this image path for pdf 

?>