DROP PROCEDURE IF EXISTS proc_010_get_vacabulary;

CREATE PROCEDURE proc_010_get_vacabulary(IN categoryName VARCHAR(64))
BEGIN

   IF categoryName IS NULL THEN 
          SELECT (select EN from tbl_vocabulary tv where tv.WID=v.PARENT_WID) as Category, v.EN, v.RU 
          FROM tbl_vocabulary v
          where v.PARENT_WID is not null
          ORDER BY v.PARENT_WID, v.EN;
   ELSE
          SELECT (select EN from tbl_vocabulary tv where tv.WID=v.PARENT_WID) as Category, v.EN, v.RU 
          FROM tbl_vocabulary v
          where v.PARENT_WID is not null
          and v.WID in (select tv1.wid from tbl_vocabulary tv1 where tv1.EN=LOWER('fruit') )
          GROUP BY v.WID
          ORDER BY v.PARENT_WID, EN;
   END IF;
END ;
call proc_010_get_vacabulary('fruit');