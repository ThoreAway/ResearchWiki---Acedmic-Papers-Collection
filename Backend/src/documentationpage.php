<?php
/**
 * Build up the documentationPage with a construct function using the various defined functions from webage.php to create a header, navbar and footer
 * 
 * @author Jacob Clark
 */
class DocumentationPage extends Webpage
{

    public function __construct($title, $style, $links, $activePage) {
    $this->setHead($title, $style);
    $this->addMenu($links, $activePage);
    $this->setFoot();
} 

}