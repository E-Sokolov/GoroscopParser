<?php
ini_set('error_reporting', '1');
error_reporting(E_ALL);

include_once './core/CURL.php';
include_once './core/DOM.php';
include_once './core/DBconnect.php';
$pages = include_once './core/pages.php';

$CURL = new CURL();
$DOM = new DOM();
$DB = new DB();

foreach ($pages as $zodiak => $page){
    $content = $CURL -> getContent($page);
    $i = 1;
    foreach(array('month','job','love','money') as $key => $type) {
        $elements = $DOM->getDOM($content, "//div[@id='tabs-" . $i . "']");

        $elementResult = array();
        if ($elements->length > 0) {
            foreach ($elements as $elements) {
                $elementResult[] = mb_convert_encoding($elements->nodeValue . "\n", 'iso-8859-1', 'utf-8');

            }
        }
        $PDO = DB::getConnect();
        print_r($elementResult);
        $q = "INSERT INTO global (name,zodiak,year,month,content) VALUES('".$type."','".$zodiak."','".date("Y", time())."','".date("m", time())."','" . $elementResult[0] . "')";
        $result = $PDO->prepare($q);
        $result->execute();
        $i++;
    }

}
?>
