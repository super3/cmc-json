<?php
include('simple_html_dom.php');

class coin_market_cap_data {
    public $coin_market_cap_url = 'http://coinmarketcap.com/';
    public $number_cleanup_regex = "/[^-e\.0-9]+/";

    public function market_volume_data () {
        // This is the source of our data below
        $html = file_get_html($this->coin_market_cap_url . 'volume.html');

        // This variable is where we will store all of the coins.
        $list_of_coins = array();

        // This selects only the rows that are of the form "###. Coin name (###.## %)"
        $coin_rows = $html->find('table tbody',0)->find('tr[id]');

        foreach ($coin_rows as $coin_row) {
            $name_unparsed = $coin_row->find('h3',0)->plaintext;
            // get the name and market volume % from this using an ugly regex
            preg_match("/\d+\.\s*([\sA-Za-z0-9]+)\s+\((\d+.\d+)\s*%\)/", $name_unparsed, $matches);
            
            $name = $matches[1];
            $market_volume = $matches[2];

            // skip the row that gives us the headings
            $coin_data_row = $coin_row->next_sibling()->next_sibling();
            
            // we'll store this coin's sources in this data structure
            $sources = array();

            // if we find a link in that first element, keep going
            while ($coin_data_row->first_child()->find('a',0)) {
                // parse the source line
                $source = array(
                    "url" => $coin_data_row->first_child()->find('a',0)->href,
                    "name" => $coin_data_row->first_child()->plaintext,
                    "pair" => $coin_data_row->children(1)->plaintext,
                    "volume_usd" => $coin_data_row->children(2)->plaintext,
                    "price_usd" => $coin_data_row->children(3)->plaintext,
                    "volume_percent" => $coin_data_row->children(4)->plaintext
                );

                // and clean up the source elements
                foreach ($source as $key => $elem) {
                    if ($key != 'name' && $key != 'url' && $key != 'pair') {
                        $source[$key] = (double) preg_replace($this->number_cleanup_regex, "", $elem);
                    }
                }
    
                $source['price_usd_expanded'] = number_format($source['price_usd'], 9, '.', '');

                // add the source to our sources array
                array_push($sources, $source);

                // go to the next row
                $coin_data_row = $coin_data_row->next_sibling();
            
                // if the row is invalid (we're at the end), then quit
                if (!$coin_data_row) {
                    break;
                }
            }

            $parsed_coins = array(
                "name" => $name,
                "whole_market_volume" => $market_volume,
                "sources" => $sources
            );
            // add this coin to our list of coins
            array_push($list_of_coins, $parsed_coins);
        }

        $json_root = array(
            'coins_volume' => $list_of_coins,
            'timestamp' => gmdate("Y-m-d H:i:s")
        );

        return $json_root;
    }

    public function market_cap_data ($top = 100) {
        // This is the source of our data below
        $html = file_get_html($this->coin_market_cap_url);

        // This variable is where we will store all of the coins.
        $list_of_coins = array();

        for ($i = 1; $i <= $top; $i++) {
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
                    $arr[$key] = (double) preg_replace($this->number_cleanup_regex, "", $value);
                }
            }
            
            $arr['price_usd_expanded'] = number_format($arr['price_usd'], 9, '.', '');

            // We push this data structure onto a list of coins array
            array_push($list_of_coins, $arr);
        }

        // DateTime object needed for timestamp

        // TimeZones supported can be found here: http://www.php.net/manual/en/timezones.php
        
        // This represents the root JSON object
        $json_root = array(
            'coins' => $list_of_coins,
            'timestamp' => gmdate("Y-m-d H:i:s")
        );
        
        return $json_root;
    }
}

?>
