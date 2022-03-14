<?php


/**
 * paper controller to handle the papers endpoint 
 *
 * supports HTTP GET requests to return an array of papers with relevant information of each paper such as the paper id, title, 
 * abstract and awards it has recieved.
 * 
 * supports 3 additonal parameters that can be passed through to filter the data that is being returned. The first is 'id' which 
 * expects an interger value to be passed for it to return an array containing just the paper with the specified id or an error 
 * message if there is no paper with that id. For example: 'papers?id=60080'. The second parameter is 'authorid' which also expects an 
 * interger value to be passed for it to return all papers that have credited the author matching the specified paper id or an error 
 * message if there are no papers with that id. For example: 'papers?authorid=59562'. The third parameter supported by papers is 
 * 'award' which expects one of two possible words, either 'all' or 'none'. Based on the word given the endpoint will return an array 
 * of papers which either have at least one award accreddited to them or instead return the papers that have no awards accredited to 
 * them.
 * 
 * @author Jacob Clark w18003237
*/

class ApiPapersController extends Controller {
    
    protected function setGateway() {
        $this->gateway = new PaperGateway();
    }
    
    protected function processRequest() {

        $id = $this->getRequest()->getParameter("id"); 
        $arrayId = $this->getRequest()->getParameter("arrayId"); 
        $authorId = $this->getRequest()->getParameter("authorid");
        $award = $this->getRequest()->getParameter("award");
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        
       
        
        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($id)) {
                $this->getGateway()->findOne($id);
            }elseif (!is_null($arrayId)) {
                $this->getGateway()->findMultiple($arrayId);
            }elseif (!is_null($authorId)) {
                $this->getGateway()->findAuthor($authorId);
            }elseif ((!is_null($award)) && ($award == "all")) {
                $this->getGateway()->findAwarded();
            }elseif ((!is_null($award)) && ($award == "none")) {
                $this->getGateway()->findNotAwarded();
            } elseif($url === "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/papers" ) {
                $this->getGateway()->findAll();
        } else{
            $this->getResponse()->setMessage("Method not allowed");
            // Set a 405 code
            $this->getResponse()->setStatusCode(405);
            }
        }

        if ($this->getRequest()->getRequestMethod() === "POST") {
            $this->getResponse()->setMessage("Method not allowed");
            // Set a 405 code
            $this->getResponse()->setStatusCode(405);
        }

        if( (count($this->getGateway()->getResult()) <= 0) && ( (!is_null($id)) || (!is_null($arrayId)) || (!is_null($authorId)) || (!is_null($award)) ) ) {
            $this->getResponse()->setMessage("Given parameter value was not found");
            // Set a 404 code
            $this->getResponse()->setStatusCode(404);
        }


        return $this->getGateway()->getResult();
    }
}