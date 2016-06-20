
#alter table items drop index idx01;

drop table if exists items;

create table if not exists items(
    id int primary key auto_increment comment 'Primary Key',
	code varchar(20) unique comment 'JAN/EAN/UPC code',
	name varchar(1024) comment 'tem name', 
	price int comment 'price', 
	brand varchar(1024) default '' comment 'brand name', 
	maker varchar(1024) default '' comment 'maker name', 
	image_url varchar(1024) comment 'URL for item image',
	asin varchar(20) comment 'ASIN code'
) engine = InnoDB comment = 'item master table' default character set utf8;

#create index idx01 on items (name asc, brand asc, maker asc);

