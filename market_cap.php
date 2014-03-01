<?php
include('simple_html_dom.php');
// snag front page of coinmarketcap.com
$html = file_get_html('http://coinmarketcap.com/');
$i = 1;
// create empty array that will contain all our data
$list = array();
// iterate through each table row from coinmarketcap
while ($i<=100) {
	$step = $html->find('tr', $i);	// locate html table row
	$name = $step->find('a', 0);	// get name from a tag 0
	$cap = $step->find('td', 2);	// get cap from column 2
	$price = $step->find('a', 1);	// get price from a tag 1
	$supply = $step->find('td', 4);	// get supply from column 4
	$volume = $step->find('td', 5);	// get volume from column 5
	$change = $step->find('td', 6);	// get change from column 6
	$name = $name->plaintext;	// style values as plaintext
	$cap = $cap->plaintext;
	$price = $price->plaintext;
	$supply = $supply->plaintext;
	$volume = $volume->plaintext;
	$change = $change->plaintext;
	// create an array that represents the row
	$arr = array('name' => $name, 'market_cap' => $cap, 'price' => $price, 'supply' => $supply, 'volume' => $volume, 'change' => $change);
	// push this array into our list
	array_push($list, $arr);
	// go to next row and restart while loop
	$i++;
}
// display json formatted data
echo json_encode($list);
?>
