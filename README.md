cmc-json
========

This is a PHP script that uses simple HTML DOM parsing to get the top 100 coins from coinmarketcap.com. 
Then, the script converts Coinmarketcap.com into JSON data.

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
            "mineable": "1",
            "market_cap_usd": "7129992389",
            "price_usd": "572.11",
            "supply_btc": "12462625",
            "volume_usd": "21364235",
            "change_24_hours": "2.85"
        },
        {
            "name": "Ripple",
            "shorthand_name": "XRP",
            "mineable": "0",
            "market_cap_usd": "1386676651",
            "price_usd": "0.014",
            "supply_btc": "99999997890",
            "volume_usd": "72288",
            "change_24_hours": "1.12"
        },
        // . . . and so on etc
    ],
    "timestamp": "2014-03-01 22:34:30"
}
```

markets.php output:
```json
{
    "coins": [
        {
            "name": "Bitcoin",
            "whole_market_volume": "67.10",
            "sources": [
                {
                    "url": "https:\/\/bitcoinaverage.com\/#USD",
                    "name": "BitcoinAverage",
                    "pair": "BTC\/USD",
                    "volume_usd": "21364235",
                    "price_usd": "572.11",
                    "volume_percent": "100.00"
                }
            ]
        },
    ],
    // . . . and so on etc
    "timestamp": "2014-03-01 22:31:36"
}
```
