<!-- http://www.w3schools.com/php/php_mysql_connect.asp -->
<?php
include 'config.php';
require $_SERVER['DOCUMENT_ROOT'] . "/php_include/standardFunctions.php";
require $_SERVER['DOCUMENT_ROOT'] . "/php_include/encodingFunctions.php";

function connectDbWithCredentials()
{

    $hostname = "advends.com";
    $username = "advends";
    $password = "VfifYfcnz!23";

    // Create connection
    $conn = mysqli_connect($hostname, $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";

    return $conn;
}

;

function getSqlresultsTojsonWithCredentials()
{
    $dbhandle = connectDbWithCredentials();
    $selected = mysql_select_db("advends_wp1", $dbhandle) or die("Could not select examples");
    $query = "SELECT * FROM wp_links where link_name like '%" . $_POST['selectBox'] . "%'";
    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        echo "<option value='" . $row{'link_name'} . "'  selected=\"selected\">" . $row{'link_name'} . "</option>";
    };
}

;

function getLastPathSegment($url)
{
    $path = parse_url($url, PHP_URL_PATH); // to get the path from a whole URL
    $pathTrimmed = trim($path, '/'); // normalise with no leading or trailing slash
    $pathTokens = explode('/', $pathTrimmed); // get segments delimited by a slash

    if (substr($path, -1) !== '/') {
        array_pop($pathTokens);
    }
    return end($pathTokens); // get the last segment
}

;

function parseUrlToQueryStringArray($url)
{
    //$url = 'http://username:password@hostname:9090/path?arg=777&arg=888&arg=999&l=ua&l=ru&c=cat0001&arg=555&#anchor';
    $queryString = parse_url($url, PHP_URL_QUERY);
    echo "queryString is: " . $queryString;
    echo "</br>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>></br>";
    $queryStringArray = http_parse_query($queryString, $argSeparator = '&', $decType = PHP_QUERY_RFC1738);

    if (!empty($queryStringArray)) {
        foreach ($queryStringArray as $key => $val) {
            if (isArray($val)) {
                foreach ($val as $equalsTo) {
                    echo "</br>" . $key . " = " . $equalsTo;
                };
            } else {
                print "</br>$key = $val\n";
            };
            echo "</br>";
        };
    };
}

;

function getJsonFromVacabularyDb()
{
    $url = getCurPageURL();
    $urlParts = explode('/', str_ireplace(array('http://', 'https://'), '', $url));
    $language = strtoupper(trim($urlParts[1]));
    $category = strtolower(trim(getLastPathSegment($url)));
    // echo "</br>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>></br>";
    // echo "urlParts is " .$urlParts[1];
    // echo $url;
    // echo "</br>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>></br>";
    // echo "language is " .$language;
    // echo "</br>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>></br>";
    // echo $category;
    // echo "</br>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>></br>";
    // echo detect_encoding($category);
    // echo "</br>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>></br>";
    // echo "utf8_encode". utf8_encode($category);
    // echo "</br>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>></br>";

    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM tbl_vocabulary td where PARENT_WID = (SELECT WID FROM tbl_vocabulary td where " . $language . " in ('" . $category . "') );");

    if (!empty($results)) {
        foreach ($results as $row) {
            $json[] = $row;
        };
        // echo json_encode($json);//Formats json from temp and shows/print on page
        // echo json_fix_cyr(json_encode(array("собака","кошка"))); // ["собака","кошка"]
        echo json_fix_cyr(json_encode($json)); // ["собака","кошка"]
    } else {
        die('Could not connect: ' . mysql_error());
    };
}

;

function getHomePageWithCategoris()
{
    $url = getCurPageURL();
    $urlParts = explode('/', str_ireplace(array('http://', 'https://'), '', $url));
    $language = strtoupper(trim($urlParts[1]));

    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM tbl_vocabulary td;");

    if (!empty($results)) {
        foreach ($results as $row) {
            $json[] = $row;
        };
        $result = json_fix_cyr(json_encode($json));
        echo $result;
        return $result;
    } else {
        die('Could not connect: ' . mysql_error());
    };
}

?>