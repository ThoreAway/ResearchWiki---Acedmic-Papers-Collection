<?php

/**
 * error controller to build up an errorpage in the case an error is throw
 * 
 * uses homepage and functions defined in webpage
 *
 * @author Jacob Clark w18003237
 */

class ErrorController extends Controller 
{
    protected function processRequest() {
        $page = new HomePage("Error", "assets/index.css", ["Home"=>"home", "Documentation"=>"documentation"], "error");
        
        $page->addHeading1("Error Page");
        $page->addParagraph("We have encouctered an error, please ensure you have typed the destination url correctly or alternativley use the navbar links above to go to our home page.");

        return $page->generateWebpage();
    }
}