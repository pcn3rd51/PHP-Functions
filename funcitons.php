<?php
/**
*
* Takes in $_POST variables and cleans the data to be inserted into a database
* Can be used with arrays and non-arrays
* htmlspecialchars — Convert special characters to HTML entities
* stripslashes - Un-quotes a quoted string
* trim - Strip whitespace (or other characters) from the beginning and end of a string
*
**/
function cleanPOST(): void
{
    global $_POST;
    
    foreach ($_POST as $key => $val) {
        if (!is_array($val)) {
            $val = htmlspecialchars($val);
            $val = stripslashes($val);
            $_POST[$key] = trim($val);
        } else {
            foreach ($val as $k => $v) {
                $v = htmlspecialchars($v);
                $v = stripslashes($v);
                $_POST[$key][$k] = trim($v);
            }
        }
    }
}


/**
*
* Takes in data and displays clean string
* htmlspecialchars — Convert special characters to HTML entities
*
**/
function returnCleanVar($dirtyVar): string
{
    return htmlspecialchars($dirtyVar ?? '');
}


/**
*
* Formats a number (normally used for file sizes) and makes it readable in bytes
* htmlspecialchars — Convert special characters to HTML entities
*
**/
function formatBytes($bytes, $precision = 2): string
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= 1024 ** $pow;

    return round($bytes, $precision) . ' ' . $units[$pow];
}
