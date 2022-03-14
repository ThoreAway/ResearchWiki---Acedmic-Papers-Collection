<?php
/**
 * autoloader to load in the different files so they dont have to be called repeatedly
 *
 * 
 * @author Jacob Clark
 */
function autoloader($className) {
    $filename = "src\\" . strtolower($className) . ".php";
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $filename);
    if (is_readable($filename)) {
        include_once $filename;
    } else {
        throw new Exception("File not found: " . $className . "( " . $filename . ")");
        throw new exception("Autoloader failed");
    }
}