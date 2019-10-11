<?php
//http://tutsforweb.blogspot.co.uk/2012/02/creating-menu-from-database-data.html
//http://phpflow.com/php/dynamic-tree-with-jstree-php-and-mysql/
//http://php.net/manual/en/mysqli-stmt.get-result.php
//http://www.w3schools.com/php/func_mysqli_fetch_array.asp
class Database
{


    private $sqlAllCategoriesPanelItems = "SELECT
                                            v1.WID
                                            ,v1.PARENT_WID
                                            ,v1.EN
                                            ,v1.RU  
                                        FROM tbl_vocabulary v1
                                        WHERE v1.WID in (SELECT WID  FROM tbl_vocabulary WHERE )
                                        ORDER BY v1.EN  DESC;";

    private $sqlMultipleCategoryItems = "SELECT
                                            v1.WID
                                            ,v1.PARENT_WID
                                            ,v1.EN
                                            ,v1.RU  
                                            ,(SELECT count(*)  FROM tbl_vocabulary v2 where v2.PARENT_WID=v1.WID) as ITEMS_COUNT
                                        FROM tbl_vocabulary v1
                                        JOIN tbl_vocabulary v2 on v1.WID=v2.WID
                                        GROUP BY v1.EN
                                        ORDER BY v1.PARENT_WID, ITEMS_COUNT DESC;";


    function __construct()
    {
    }

    private static function connectAdvendsDb()
    {
        $servername = "advends.com";
        $username = "advends";
        $password = "VfifYfcnz!23";
        $database = "advends_wp1";
        $conn = mysqli_connect($servername, $username, $password, $database);
        mysqli_set_charset($conn, "utf8");

        /* check connection */
        if (!$conn) {
            $error = mysqli_connect_error();
            $errno = mysqli_connect_errno();
            print "$errno: $error\n";
            exit();
        };
        return $conn;
    }

    public function getAllCategoriesWids()
    {
        $dbConnection = $this->connectAdvendsDb();
        $sql = "SELECT
                distinct v1.WID
                FROM tbl_vocabulary v1 where PARENT_WID is NULL;";

        return $this->sqlToArrayWithConnectionClose($dbConnection, $sql);
    }

    public function getAllCategoriesWithCountOfItems()
    {
        $dbConnection = $this->connectAdvendsDb();
        $sql = "SELECT
                PARENT_WID AS WID
                ,(SELECT v0.EN from tbl_vocabulary v0 WHERE v0.WID=v1.PARENT_WID) as EN
                ,(SELECT v0.RU from tbl_vocabulary v0 WHERE v0.WID=v1.PARENT_WID) as RU
                ,count(v1.WID) as ITEMS_COUNT
                FROM tbl_vocabulary v1
                GROUP BY PARENT_WID
                HAVING ITEMS_COUNT > 20;";

        return $this->sqlToArrayWithConnectionClose($dbConnection, $sql);
    }

    public function getItemsByCategory($commaSeparatedParentWids)
    {
        $dbConnection = $this->connectAdvendsDb();
        $sql = "SELECT
                  v1.WID
                  ,v1.PARENT_WID
                  ,v1.EN
                  ,v1.RU
                FROM tbl_vocabulary v1 WHERE PARENT_WID in ('$commaSeparatedParentWids');";
//        echo $sql . ' < br />';
        return $this->sqlToArrayWithConnectionClose($dbConnection, $sql);
    }

    private function sqlToArrayWithConnectionClose($dbConnection, $sql)
    {
        $arrayOfSqlRows[] = [];
        if ($result = mysqli_query($dbConnection, $sql)) {
            //Create $arrayOfSqlRows
            while ($rowFromSqlResult = $result->fetch_array()) {
                $arrayOfSqlRows[] = $rowFromSqlResult;
            }
            mysqli_free_result($result);
        };
        mysqli_close($dbConnection);
//        echo ' < br /> arrayOfSqlRows' . '$arrayOfSqlRows';
        return $arrayOfSqlRows;
    }
}