cmc-json
========

This is a PHP script that uses simple HTML DOM parsing to get the top 100 coins from [CoinMarketCap](http://coinmarketcap.com/). Then, the script converts that into JSON data. If you get a zend heap error see [this link](https://stackoverflow.com/questions/2247977/what-does-zend-mm-heap-corrupted-mean).

Possible usage: 
```shell
$ php coins.php > coins.json
$ php markets.php > markets.json
```

coins.php output:
```json
{
    "coins": [
        {
            "name": "Bitcoin",
            "shorthand_name": "BTC",
            "mineable": 1,
            "market_cap_usd": 7056465670,
            "price_usd": 566.2,
            "supply_btc": 12462850,
            "volume_usd": 17226499,
            "change_24_hours": 5.02,
            "price_usd_expanded": "566.200000000"
        },
        {
            "name": "Ripple",
            "shorthand_name": "XRP",
            "mineable": 0,
            "market_cap_usd": 1367341981,
            "price_usd": 0.014,
            "supply_btc": 99999997890,
            "volume_usd": 105367,
            "change_24_hours": 1.41,
            "price_usd_expanded": "0.014000000"
        },
        // . . . and so on etc
    ],
    "timestamp": "2014-03-01 22:34:30"
}
```

markets.php output:
```json
{
    "coins_volume": [
        {
            "name": "Bitcoin",
            "whole_market_volume": "63.48",
            "sources": [
                {
                    "url": "https:\/\/bitcoinaverage.com\/#USD",
                    "name": "BitcoinAverage",
                    "pair": "BTC\/USD",
                    "volume_usd": 17226499,
                    "price_usd": 566.2,
                    "volume_percent": 100,
                    "price_usd_expanded": "566.200000000"
                }
            ]
        },
    // . . . and so on etc
    "timestamp": "2014-03-01 22:31:36"
}
```
