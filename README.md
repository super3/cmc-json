cmc-json
========

Coverts Coinmarketcap.com data into JSON data.

This script scrapes the HTML on the front page of http://coinmarketcap.com and returns the live data in JSON format, e.g.

```
[
{"name":"Bitcoin","market_cap":"$ 7,120,498,646","price":"$ 571.37","supply":"12,462,150 BTC","volume":" $ 25,600,953","change":"-0.02 %"},
{"name":"Ripple","market_cap":"$ 1,374,891,631","price":"$ 0.014","supply":"99,999,997,890 XRP*","volume":" $ 84,478","change":"-1.91 %"},
{"name":"Litecoin","market_cap":"$ 357,765,667","price":"$ 13.68","supply":"26,150,154 LTC","volume":" $ 4,104,985","change":"-0.49 %"}
]
```
