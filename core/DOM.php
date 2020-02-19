<?php
class DOM
{
    function getDOM($content,$pattern)
    {
        $domDocument = new DOMDocument('1.0','utf-8');
        @$domDocument->loadHTML($content);
        $xPath = new DOMXPath($domDocument);
        $Elements = $xPath->query($pattern);
        return $Elements;
    }
}
