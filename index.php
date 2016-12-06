<?php

$d = new DateTime();
if($d->format('w')=='0')
{
	$d->modify('+1 day');
} elseif($d->format('w')=='6') {
	$d->modify('+2 day');
}
$d=$d->format('Y-m-d');

$myfile = fopen("visitors.txt", "r");

if(!$myfile) {
$myfile = fopen("visitors.txt", "w") or die('2');
fwrite($myfile, '0');
}
$counter=fgets($myfile);
$counter+=1;
echo $counter;
$myfile = fopen("visitors.txt", "w") or die('3');
fwrite($myfile, $counter);
header("Location: http://www.etfos.unios.hr/studenti/raspored-nastave-i-ispita/$d/2-21#anc");
