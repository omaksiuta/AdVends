DROP PROCEDURE IF EXISTS proc_001_setup_tables;

CREATE PROCEDURE proc_001_setup_tables()
BEGIN 
      DROP TABLE IF EXISTS tbl_vocabulary;
      
      CREATE TABLE tbl_vocabulary (
        `WID` varchar(8) NOT NULL UNIQUE,
        `PARENT_WID` varchar(8),
        `EN` varchar(64),
        `RU` varchar(64),
        `FR` varchar(64),
        `SP` varchar(64),
        `PT` varchar(64),
        `AR` varchar(64),
        `UA` varchar(64),
        `DE` varchar(64),
        `IT` varchar(64),
		PRIMARY KEY (WID)
      ) DEFAULT CHARSET=utf8;

	  ALTER TABLE tbl_vocabulary CHANGE COLUMN RU RU TEXT CHARACTER SET utf8 COLLATE utf8_general_ci;


insert into tbl_vocabulary (wid, en, ru) values ('w0000102',  'food', 'еда');
insert into tbl_vocabulary (wid, en, ru) values ('w0000103',  'fruit', 'фрукт');
insert into tbl_vocabulary (wid, en, ru) values ('w0000104',  'vegetable', 'овощ');
insert into tbl_vocabulary (wid, en, ru) values ('w0000105',  'green', 'зелень');
insert into tbl_vocabulary (wid, en, ru) values ('w0000106',  'grain', 'крупа');
insert into tbl_vocabulary (wid, en, ru) values ('w0000107',  'berrie', 'ягода');
insert into tbl_vocabulary (wid, en, ru) values ('w0000108',  'flower', 'цветок');
insert into tbl_vocabulary (wid, en, ru) values ('w0000110',  'sport', 'спорт');
insert into tbl_vocabulary (wid, en, ru) values ('w0000111',  'nature', 'природа');
insert into tbl_vocabulary (wid, en, ru) values ('w0000112',  'human', 'человек');
insert into tbl_vocabulary (wid, en, ru) values ('w0000113',  'family', 'семья');
insert into tbl_vocabulary (wid, en, ru) values ('w0000114',  'shape', 'фигура');
insert into tbl_vocabulary (wid, en, ru) values ('w0000115',  'animal', 'животное');
insert into tbl_vocabulary (wid, en, ru) values ('w0000116',  'transport', 'транспорт');
insert into tbl_vocabulary (wid, en, ru) values ('w0000117',  'color', 'цвет');
insert into tbl_vocabulary (wid, en, ru) values ('w0000118',  'number', 'цыфра');





insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000124', 'w0000103', 'apricot', 'абрикос');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000125', 'w0000103', 'avocado', 'авокадо');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000126', 'w0000103', 'quince', 'айва');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000127', 'w0000103', 'ackee', 'аки');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000128', 'w0000103', 'cherry-plum', 'алыча');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000129', 'w0000103', 'jew plum, ambarella', 'амбарелла');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000130', 'w0000103', 'pineapple', 'ананас');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000131', 'w0000103', 'guanabana', 'аннона');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000132', 'w0000103', 'orange', 'апельсин');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000133', 'w0000103', 'astrocaryum', 'астрокариум');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000134', 'w0000103', 'banana', 'банан');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000135', 'w0000103', 'baobab', 'баобаб');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000136', 'w0000103', 'bergamot', 'бергамот');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000137', 'w0000103', 'bilimbi, cucumber tree', 'билимби');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000138', 'w0000103', 'pomegranate', 'гранат');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000139', 'w0000103', 'grapefruit', 'грейпфрут');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000140', 'w0000103', 'pear', 'груша');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000141', 'w0000103', 'guava', 'гуава');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000142', 'w0000103', 'jackfruit', 'джекфрут');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000143', 'w0000103', 'durian', 'дуриан');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000144', 'w0000103', 'jojoba', 'жожоба');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000145', 'w0000103', 'fig', 'инжир');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000146', 'w0000103', 'calabash', 'калабаш');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000147', 'w0000103', 'calamondin', 'каламондин');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000148', 'w0000103', 'carambola', 'карамбола');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000149', 'w0000103', 'kaffir lime', 'кафир-лайм');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000150', 'w0000103', 'kiwi', 'киви');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000151', 'w0000103', 'clementine', 'клементин');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000152', 'w0000103', 'kumquat', 'кумкват');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000153', 'w0000103', 'lime', 'лайм');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000154', 'w0000103', 'lemon', 'лимон');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000155', 'w0000103', 'lychee', 'личи');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000156', 'w0000103', 'loquat', 'локва, мушмула японская');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000157', 'w0000103', 'longan', 'лонган');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000158', 'w0000103', 'mamoncillо', 'мамончилло');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000159', 'w0000103', 'mango', 'манго');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000160', 'w0000103', 'purple mangosteen', 'мангостан');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000161', 'w0000103', 'tangerine, mandarin', 'мандарин');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000162', 'w0000103', 'passion fruit', 'маракуйя');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000163', 'w0000103', 'tangerine', 'минеола');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000164', 'w0000103', 'medlar', 'мушмула германская');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000165', 'w0000103', 'nance', ' нансе');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000166', 'w0000103', 'nectarine', 'нектарин');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000167', 'w0000103', 'papaya', 'папайя');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000168', 'w0000103', 'peach', 'персик');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000169', 'w0000103', 'pomelo', 'помело');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000170', 'w0000103', 'bitter, wild orange', 'померанец');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000171', 'w0000103', 'rambutan', 'рамбутан');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000172', 'w0000103', 'snake fruit', 'салак');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000173', 'w0000103', 'sapodilla', 'саподилла');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000174', 'w0000103', 'sapote', 'сапота');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000175', 'w0000103', 'oroblanko, sweetie', 'свити');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000176', 'w0000103', 'plum', 'слива');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000177', 'w0000103', 'wood apple', 'слоновое яблоко');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000178', 'w0000103', 'tamarillo', 'тамарилло');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000179', 'w0000103', 'tangelo', 'танжело');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000180', 'w0000103', 'tangerine', 'танжерин');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000181', 'w0000103', 'feijoa', 'фейхоа');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000182', 'w0000103', 'date', 'финик');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000183', 'w0000103', 'persimmon', 'хурма');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000184', 'w0000103', 'citron', 'цитрон');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000185', 'w0000103', 'jujube', 'ююба');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000186', 'w0000103', 'apple', 'яблоко');



insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000190', 'w0000106', 'amaranth', 'амарант');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000193', 'w0000106', 'buckwheat', 'гречка');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000195', 'w0000106', 'quinoa', 'киноа');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000196', 'w0000106', 'corn', 'кукуруза');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000198', 'w0000106', 'semolina', 'манка');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000199', 'w0000106', 'oats', 'овёс');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000200', 'w0000106', 'pearl-barley', 'pearl-barley');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000201', 'w0000106', 'wheat', 'пшеница');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000202', 'w0000106', 'millet', 'пшено');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000203', 'w0000106', 'rice ', 'рис');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000204', 'w0000106', 'rice basmati', 'рис басмати');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000205', 'w0000106', 'wild rice', 'рис дикий (цицания)');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000208', 'w0000106', 'lentil', 'чечевица');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000209', 'w0000106', 'barleycorn', 'ячмень');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000210', 'w0000106', 'barley grits', 'ячневая крупа');



insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000215', 'w0000107', 'watermelon', 'арбуз');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000216', 'w0000107', 'chokeberry', 'арония');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000217', 'w0000107', 'acai berry', 'асаи');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000218', 'w0000107', 'barber(r)y', 'барбарис');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000219', 'w0000107', 'boysenberry', 'бойзенова ягода');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000220', 'w0000107', 'haw', 'боярышник');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000221', 'w0000107', 'cowberry, lingonberry', 'брусника');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000222', 'w0000107', 'ɡrapes', 'виноград');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000223', 'w0000107', 'cherry', 'вишня');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000224', 'w0000107', 'crowberry', 'водяника');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000225', 'w0000107', 'goji berry', ' годжи');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000226', 'w0000107', 'whortleberry', 'голубика');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000227', 'w0000107', 'wintergreen', 'грушанка');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000228', 'w0000107', 'bunchberry', 'дёрен канадский');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000229', 'w0000107', 'blackberry, dewberry', 'ежевика');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000230', 'w0000107', 'honeysuckle', 'жимолость голубая');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000231', 'w0000107', 'wild strawberry', 'земляника');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000232', 'w0000107', 'shadberry', 'ирга');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000233', 'w0000107', 'viburnum', 'калина');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000234', 'w0000107', 'cornelian cherry', 'кизил');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000235', 'w0000107', 'shadberry', 'клубника');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000236', 'w0000107', 'cranberry', 'клюква');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000237', 'w0000107', 'gooseberry', 'крыжовник');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000238', 'w0000107', 'emblic', 'крыжовник индийский');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000239', 'w0000107', 'loganberry', 'логанова ягода');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000240', 'w0000107', 'raspberry', 'малина');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000241', 'w0000107', 'juniper berries', 'можжевельник');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000242', 'w0000107', 'cloudberry', 'морошка');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000243', 'w0000107', 'sea-buckthorn', 'облепиха');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000245', 'w0000107', 'oregon grape', 'магония');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000246', 'w0000107', 'mayapple', 'подофилл');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000247', 'w0000107', 'rowan berry', 'рябина');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000248', 'w0000107', 'black rowanberry', 'рябина черноплодная');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000249', 'w0000107', 'white currant', 'смородина белая');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000250', 'w0000107', 'black currant', 'смородина чёрная');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000251', 'w0000107', 'red currant', 'смородина красная');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000252', 'w0000107', 'bearberry', 'толокнянка');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000254', 'w0000107', 'sweet cherry', 'черешня');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000255', 'w0000107', 'chokecherry', 'черёмуха виргинская');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000256', 'w0000107', 'bilberry, whortleberry', 'черника');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000257', 'w0000107', 'mulberry', 'шелковица');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000258', 'w0000107', 'buffalo berry', 'шефердия');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000259', 'w0000107', 'canker-berry', 'шиповник');
insert into tbl_vocabulary (wid, parent_wid, en, ru) values ('w0000260', 'w0000107', 'indian plum', 'эмлерия');




show variables like '%char%';



	  /*Change encoding*/
	  /* http://stackoverflow.com/questions/8906813/how-to-change-the-default-charset-of-a-mysql-table
	  http://sqlinfo.ru/forum/viewtopic.php?id=3029 */
	  /*
		SHOW FULL COLUMNS FROM tbl_vocabulary;
		ALTER TABLE tbl_vocabulary CHARACTER SET utf8,
		COLLATE utf8_general_ci;
		ALTER TABLE tbl_vocabulary CHANGE COLUMN RU RU TEXT CHARACTER SET utf8 COLLATE utf8_general_ci;
	*/

END ;
call proc_001_setup_tables();