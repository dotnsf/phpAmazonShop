# phpAmazonShop

## Overview

* Sample codes for Amazon API crawler & webapp in PHP & MySQL

## 0. Install

* Get Amazon Associate account and get AWS Key, Secret. If you get Amazon Associate tag, that would be better, but that is not mandatory.

* Edit credentials.php with correct information of MySQL.

* (Optional: If you don't want to use sample data and want to gather your data[1-B], )You need edit Amazon IDs too. If you don't get Amazon Associate tag, just leave it as brank('').

* (Optional: If you don't want to use sample data and want to gather your data[1-B], )Edit crawler/amazonapi.php with node IDs what you need(https://affiliate.amazon.co.jp/gp/associates/help/t100).

* Run cosme_db_items_ddl.sql to create items table in MySQL DB(> source cosme_db_items_ddl.sql).


## 1-A. Load sample data(When you want to use sample data)

* Log in to mysql DB, and load sample data(> source sampledata.sql).


## 1-B. Crawler(When you don't want to use sample data)

* Change directory crawler/, and Run amazonapi.php to collect item information(> php -f amazonapi.php  Result would be saved as ../mysampledata.sql).

* Change parent directory .., log in to mysql DB, and load created data(> source mysampledata.sql)


## 2. Web

* Access to index.php with web browser.

## License

This code is licensed under MIT.

## Copyright

* 2016-2017 dotnsf@gmail.com(C) all rights reserved.


