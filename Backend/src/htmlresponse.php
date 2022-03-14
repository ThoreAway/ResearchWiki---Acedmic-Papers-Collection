<?php 

/**
 * Create an HTML response with appropriate headers
 * 
 * @author Jacob Clark
 */
class HTMLResponse extends Response
{
    protected function headers() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: text/html; charset=UTF-8");
    }
}