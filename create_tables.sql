create table Product( maker char, model int, type varchar(20));
create table PC( model int, speed float, ram int, hd int, price int);
create table Laptop(model int, speed float, ram int, hd int, screen float, price int);
create table Printer(model int, color boolean, type varchar(20), price int);
load data local infile 'product' into table Product fields terminated by ',' lines terminated by '\n' (maker, model, type);