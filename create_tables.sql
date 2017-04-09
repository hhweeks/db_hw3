/*
create table Product( maker char, model int, type varchar(20));
create table PC( model int, speed float, ram int, hd int, price int);
create table Laptop(model int, speed float, ram int, hd int, screen float, price int);
create table Printer(model int, color boolean, type varchar(20), price int);
load data local infile 'product' into table Product fields terminated by ',' lines terminated by '\n' (maker, model, type);
*/

/* 6.3.1 */
/*a*/select maker from Product natural join PC where speed >= 3;
/*b*/select model from Printer where price = (select max(price) from Printer);/*this solution is kind of weak*/
/*c*/select model from Laptop where speed < all(select speed from PC);/*returns empty set*/
/*d*/select model from (select model, max(price) from (select * from (select model, price from PC union select model, price from Laptop) as t1 union select model, price from Printer as t2) as t3) as t4;
	    /*create table method*/
	    /*
	    create table Items(model int, price int);
	     insert into Items select model, price from PC;
	     insert into Items select model, price from Laptop;
	     insert into Items select model, price from Printer;
	     select model from Items where price = (select max(price) from Items);
	     */
	     
/*e*/select maker from Product join Printer on Printer.model = Product.model where color like '%true' and price = (select min(price) from Printer);
/*f*/select model from (select model, max(speed) from (select * from (select * from (PC natural join Product)) as t1 where ram=(select min(ram) from PC)) as t2) as t3;
	    /*
     	    select model from (select model, max(speed) from (select model, speed from (select * from PC natural join Product as t1) as t2 where ram=(select min(ram) from PC)) as t3) as t4;
	    select model,max(speed) from PC natural join Product as t1 where ram = (select min(ram) from PC);
	    */

/*6.5.1*/
/*a*/
	insert into Product values('C', 1100, 'pc');
	insert into PC values(1100, 3.2, 1024, 180, 2499);
	select * from Product;
	select * from PC;
/*b*/
	insert into Laptop (select PC.model, PC.speed, PC.ram, PC.hd, 17, PC.price from PC);
	update Laptop set model=model+1100, price=price+500 where model = any(select model from PC);
	insert into Product (select t1.maker, t1.model+1100, 'laptop' from (select * from Product where type='pc') as t1);
	select * from Laptop;
	select * from Product;
	

/*c*/
	delete from PC where(hd<100);
	select * from PC;

/*d*/
	/*first find the models of laptops to be deleted, delete them from Laptop table*/
	delete from Laptop where model = any(select model from Product where maker != (select maker from (select maker, type as type1 from Product where type = "printer" group by maker) as t2 natural join (select maker, type as type2 from Product where type = "Laptop" group by maker) as t1) and type = 'laptop');

	/*then delete them from Product table. long natural join finds makers who make printers and laptops. For all other makers if type = laptop, delete that row */
	delete from Product where maker != (select maker from (select maker, type as type1 from Product where type = "printer" group by maker) as t2 natural join (select maker, type as type2 from Product where type = "Laptop" group by maker) as t1) and type = 'laptop';
	select * from Laptop;
	select * from Product;


/*e*/
	update Product set maker = 'A' where maker = 'B';
	select * from Product;

/*f*/
	update PC set ram=2*ram, hd=60+hd;
	select * from PC;

/*g*/
	update Laptop set screen=1+screen, price=price-100 where model = any(select model from Product where maker = 'B');
	select * from Laptop;
