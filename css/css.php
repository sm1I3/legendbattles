<?php
$files = explode("|", $_GET["f"]);

$contents = "";
foreach ($files as $file) {
    $file = varcheck($file);
    $contents .= file_get_contents($file . ".css");
}

preg_match_all('/_[a-zA-Z\-]+:\s.+;|[a-zA-Z\-]+:\s_[a-zA-Z].+;/',
    $contents, $matches, PREG_PATTERN_ORDER);

$prefixes = array("-o-", "-moz-", "-webkit-", "");
foreach ($matches[0] as $property) {
    $result = "";
    foreach ($prefixes as $prefix) {
        $result .= str_replace("_", $prefix, $property);
    }
    $contents = str_replace($property, $result, $contents);
}

$contents = preg_replace('/(\/\*).*?(\*\/)/s', '', $contents);
$contents = preg_replace(array('/\s+([^\w\'\"]+)\s+/', '/([^\w\'\"])\s+/'), '\\1', $contents);

header("Content-Type: text/css");
header("Expires: " . gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));
echo $contents;
