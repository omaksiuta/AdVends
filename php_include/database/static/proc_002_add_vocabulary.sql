DROP PROCEDURE IF EXISTS proc_002_add_vocabulary;

CREATE PROCEDURE proc_002_add_vocabulary()
BEGIN 

insert into tbl_vocabulary (wid, en, ru) values ('w0000102',  'food', '???');
/**/
END ;
call proc_002_add_vocabulary();