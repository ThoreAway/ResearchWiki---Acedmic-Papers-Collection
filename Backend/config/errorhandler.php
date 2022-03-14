<?php
/**
 * handles errors thrown by the php
 *
 * 
 * @author Jacob Clark
 */
function errorHandler($errno, $errstr, $errfile, $errline) {
    if (($errno != 2 && $errno != 8) || DEVELOPMENT_MODE) {
        throw new Exception("Error Detected: [$errno] $errstr file: $errfile line: $errline", 1);
    }
}