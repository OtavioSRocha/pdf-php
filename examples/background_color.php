<?php
error_reporting(E_ALL);
set_time_limit(1800);
set_include_path('../src/' . PATH_SEPARATOR . get_include_path());

include 'Cezpdf.php';

class Creport extends Cezpdf{
	function Creport($p,$o,$t,$op){
  		$this->__construct($p, $o, $t, $op);
	}
}

date_default_timezone_set('UTC');

$pdf = new Creport('a4','portrait','color',array(0.8,0.8,0.8));

if(strpos(PHP_OS, 'WIN') !== false){
    $pdf->tempPath = 'C:/temp';
}

$pdf -> ezSetMargins(20,20,20,20);

$mainFont = 'Courier';
// select a font
$pdf->selectFont($mainFont);
$size=12;

$height = $pdf->getFontHeight($size);
// modified to use the local file if it can
$pdf->openHere('Fit');

$result = "Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer";

$parts = preg_split('/\s/', $result);
$result = '';
foreach($parts as $v) {
	$r = rand(1,10);
	if($r == 1) {
		$result.= "<c:color:".rand(0,1).",".rand(0,1).",".rand(0,1).">" . $v . "</c:color> ";
	} else {
		$result.= $v.' ';
	}
}

$result = rtrim($result);

$result = "minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo <c:color:1,0,0>consequat.</c:color> Duis";
$result = "eirmod tempor invidunt ut <c:color:1,0,0>labore</c:color> et dolore magna aliquyam erat, sed diam <c:color:0,0,1>eirmod</c:color> tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At <c:color:1,0,0>vero</c:color> eos et accusam et justo duo dolores et";

$pdf->ezText($result, 12, array('justification'=>'full'));

if (isset($_GET['d']) && $_GET['d']){
	echo "<pre>";
	echo $pdf->ezOutput(TRUE);
	echo "</pre>";
} else {
  $pdf->ezStream(array('compress'=>0));
}

//error_log($pdf->messages);
?>