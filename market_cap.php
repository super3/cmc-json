<?php
include('simple_html_dom.php');
$html = file_get_html('http://coinmarketcap.com/');

$i = 1;
while ($i<=100) {
$step = $html->find('tr', $i);
$name = $step->find('a', 0);
$cap = $step->find('td', 2);
$price = $step->find('a', 1);
$supply = $step->find('a', 2);
$volume = $step->find('a', 3);
$change = $step->find('td', 6);
$name = $name->innertext;
$cap = $cap->innertext;
$price = $price->innertext;
$supply = $supply->innertext;
$volume = $volume->innertext;
$change = $change->innertext;
$arr = array('name'.$i => $name, 'market_cap'.$i => $cap, 'price'.$i => $price, 'supply'.$i => $supply, 'volume'.$i => $volume, 'change'.$i => $change);
echo json_encode($arr);
echo "/n";
$i++;
}
?>
