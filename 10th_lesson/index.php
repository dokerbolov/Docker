<?php
    $html = file_get_contents("https://qazaqstan.tv/");

    $dom = new DOMDocument;
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);

    $classname = "font-bold relative";

    // XPath query for class
    $nodes = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

    foreach ($nodes as $node) {
        echo $node->nodeValue . "\n";
    }
?>
