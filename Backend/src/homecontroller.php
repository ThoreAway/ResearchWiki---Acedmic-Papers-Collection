<?php

/**
 * home controller to build up the homepage using the fucntions defined in webpage 
 *
 * 
 * @author Jacob Clark w18003237
 */

class HomeController extends Controller
{

    protected function processRequest()
    {
        $page = new HomePage("Homepage", "assets/index.css", ["Documentation" => "documentation", "Home" => "home"], "home");

        $page->addDiv("homeWrapper");

        $page->addDiv("main");
        $page->addHeading1("Home page");
        $page->addParagraph("This web application is university coursework and is not at all asociated with or endorsed by the DIS conference.");
        $page->closeDiv();

        $page->closeDiv();

        return $page->generateWebpage();
    }
}
