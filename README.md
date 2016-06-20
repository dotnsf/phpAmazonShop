# phpAmazonShop

## Overview

* Sample codes for Amazon API crawler & webapp in PHP & MySQL

## 0. Install

* Get Amazon Associate account and get AWS Key, Secret, and Tag.

* Edit credentials.php with correct information of MySQL and Amazon IDs.

* Edit crawler/amazonapi.php with node IDs what you need(https://affiliate.amazon.co.jp/gp/associates/help/t100).

* Run crawler/cosme_db_items_ddl.sql to create items table in MySQL DB.

## 1. Crawler

* Run crawler/amazonapi.php to collect item information(Result would be saved under tmp/ folder).

* Run crawler/db_updatemaster.php to insert result item information to DB.

## 2. Web

* Access to items.php with web browser.

## Copyright

* 2016 dotnsf@gmail.com(C) all rights reserved.


