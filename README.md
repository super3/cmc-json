cmc-json
========

This is a PHP script that uses simple HTML DOM parsing to get the top 100 coins from coinmarketcap.com. 
Then, the script converts Coinmarketcap.com into JSON data.

Possible usage: 
```
$ php coins.php > coins.json
$ php markets.php > markets.json
```

```json
[
    {
        "name": "Bitcoin",
        "market_cap_usd": "7103813615",
        "price_usd": "570.03",
        "supply_btc": "12462175",
        "volume_usd": "25466113",
        "change_24_hours": "0.18"
    },
    {
        "name": "Ripple",
        "market_cap_usd": "1372515592",
        "price_usd": "0.014",
        "supply_btc": "99999997890",
        "volume_usd": "84338",
        "change_24_hours": "2.02"
    }
    // and so on . . .
]
```
