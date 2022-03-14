<?php

/**
 * This webpage class is used to build up html webpages using a varitey of different fuctions 
 * 
 * @author Jacob Clark
 */

class WebpageComponents 
{
    public static function webpageHead($title, $style) {
        $css = "http://unn-w18003237.newnumyspace.co.uk/" . BASEPATH . $style;
        return <<<EOT
        <!DOCTYPE html>
        <html lang="en-gb">
        <head>
            <title>$title</title>
            <meta charset="utf-8">
            <link rel='stylesheet' href='$css'>
        </head>
        <body>
EOT;
    }

    public static function webpageFoot() {
        return <<<EOT
        </body>
        </html>
EOT;
    }

    /**
     * Create a navbar
     *
     * This method creates a navbar with a hardcoded classname and 
     *
     * @param array   $links      Associative array of name=>link pairs for menu
     * @param string  $activePage Name of active page (should match a name in $links)
     */
    public static function menu($links, $activePage) {
        $menu = "<div class='navbar'> <p> Jacob Clark W18003237 </p>";
        
        foreach($links as $name=>$link) {
            $active = ($name === $activePage) ? "active" : "";
            $menu .= "<a href='$link' class='$active'>$name</a>";
        }

        $menu .= "</div>";
        return $menu;
    }

    public static function sideMenu($links) {
        $menu = "<ul>";
        
        foreach($links as $name=>$link) {
            $menu .= "<li><a href='#$link'>$name</a></li>";
        }

        $menu .= "</ul>";
        return $menu;
    }
}

abstract class Webpage 
{
    private $head;
    private $foot;
    private $body;

    protected function setHead($title, $style) {
        $this->head = webpageComponents::webpageHead($title, $style);
    }

    private function getHead() {
    	return $this->head;
    }

    protected function setBody($text) {
    	$this->body .= $text;
    }

    private function getBody() {
        return $this->body;
    }

    protected function setFoot() {
        $this->foot = webpageComponents::webpageFoot();
    }

    private function getFoot() {
        return $this->foot;
    }

    protected function addMenu($links, $activePage) {
        $menu = webpageComponents::menu($links,$activePage);
    	$this->setBody($menu);
    }

    public function addSideMenu($links) {
        $menu = webpageComponents::sideMenu($links);
    	$this->setBody($menu);
    }
    

    public function addHeading1($text) {
        $this->setBody("<h1>$text</h1>");
    }

    public function addHeading2($text) {
        $this->setBody("<h2>$text</h2>");
    }

    public function addHeading3($text) {
        $this->setBody("<h3>$text</h3>");
    }

    public function addLink($link, $name) {
        $this->setBody("<p>Link: <a href='$link'>$name</a> </p>");
    }
    
    public function addSectionId($id) {
        $this->setBody("<section id='$id'>");
    }

    public function closeSectionId() {
        $this->setBody("</section>");
    }

    public function addDiv($value) {
        $this->setBody("<div class='$value'>");
    }

    public function closeDiv() {
        $this->setBody("</div>");
    }

    public function addParagraph($text) {
        $this->setBody("<p>$text</p>");
    }
    
    public function generateWebpage() {
        return $this->head . $this->body . $this->foot;
    }

}