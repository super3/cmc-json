<?php
include('simple_html_dom.php');

function market_cap_data () {
    // This is the source of our data below
    $html = file_get_html('http://coinmarketcap.com/');

    // This variable is where we will store all of the coins.
    $list_of_coins = array();

    for ($i = 1; $i <= 100; $i++) {
        // We are parsing the table rows from 1 to 100
        // Here we get the $i'th "tr" element in the table
        $step = $html->find('tr', $i);

        // We get the properties of the table row for this coin in plaintext
        $name = $step->find('a', 0)->plaintext;
        $cap = $step->find('td', 2)->plaintext;
        $price = $step->find('a', 1)->plaintext;
        $supply = $step->find('td', 4)->plaintext;
        $volume = $step->find('td', 5)->plaintext;
        $change = $step->find('td', 6)->plaintext;

        // The coin is not mineable if we find a * after the coin's shorthand name.
        $mineable = preg_match('/\*$/', $supply) ? 0 : 1;

        // Parse out the shorthand name of the coin from $supply
        $shorthand_matches = array();
            // Must include 0-9 because of 42 Coin shorthand being "42"
        preg_match('/([A-Z0-9]+)\*?$/', $supply, $shorthand_matches);

        // We build an array data structure using the parsed table row
        $arr = array(
            'name' => $name, 
            'shorthand_name' => $shorthand_matches[1],
            'mineable' => $mineable,
            'market_cap_usd' => $cap, 
            'price_usd' => $price, 
            'supply_btc' => $supply, 
            'volume_usd' => $volume, 
            'change_24_hours' => $change,
        );

        // We are cleaning the data, we only want decimal numbers
        foreach ($arr as $key => $value) {
            // We don't want to wipe out the name
            if ($key != 'name' && $key != 'shorthand_name') {
                // Remove everything that isn't a number or period
                $arr[$key] = preg_replace("/[^-e\.0-9]+/", "", $value);
            }
        }

        // We push this data structure onto a list of coins array
        array_push($list_of_coins, $arr);
    }
    
    return $list_of_coins;
}

// Displaying this with some pretty_print
echo json_encode(market_cap_data(), JSON_PRETTY_PRINT);
?>
