<?php

/**
 * authors controller to handle the authors endpoint 
 *
 * supports HTTP GET requests to return an array of authors with their full names and author ID's
 * 
 * supports two additonal parameters that can be passed through to filter the data that is being returned. The first is 'id' which 
 * expects an interger value to be passed for it to return an array with just the author with the specified id or an error message if 
 * there is no author with that id. For example: 'authors?id=59911'. The other parameter is 'paperid' which also expects an interger 
 * value to be passed for it to return all authors that are credited for the paper matching the specified paper id or an error message 
 * if there are no papers with that id. For example: 'authors?paperid=60080'.
 * 
 * @author Jacob Clark w18003237
*/

class ApiAuthorsController extends Controller {
    
    protected function setGateway() {
        $this->gateway = new AuthorGateway();
    }
    
    protected function processRequest() {

        $id = $this->getRequest()->getParameter("id");
        $paperid = $this->getRequest()->getParameter("paperid");
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        if ($this->getRequest()->getRequestMethod() === "GET") {   
            if (!is_null($id)) {
            $this->getGateway()->findOne($id);
            }elseif($paperid){
                $this->getGateway()->findAllByPaper($paperid);
            }elseif($url === "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/authors" ) {
            $this->getGateway()->findAll();
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            // Set a 405 code 
            $this->getResponse()->setStatusCode(405);
        }

        if ($this->getRequest()->getRequestMethod() === "POST") {
            $this->getResponse()->setMessage("Method not allowed");
            // Set a 405 code
            $this->getResponse()->setStatusCode(405);
        }

        if( (count($this->getGateway()->getResult()) <= 0) && ( (!is_null($id)) || (!is_null($paperid)) ) ) {
            $this->getResponse()->setMessage("Given parameter value was not found");
            // Set a 404 code
            $this->getResponse()->setStatusCode(404);
        }

        return $this->getGateway()->getResult();
    }
}