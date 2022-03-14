<?php

/**
 * base controller to handle the home endpoint 
 *
 * supports GET and POST requests to return a JSON response containing key information regarding the API and student details.
 * 
 * @author Jacob Clark w18003237
*/

class ApiBaseController extends Controller {
    
    
    protected function processRequest() {

        $data['name'] = "Jacob Clark";
        $data['id'] = "w18003237";
        $data['message']= "This is the base endpoint API for this web application. This web API features a varitey of endpoints for displaying data regarding academic papers and their relevant authors as well as authenitcation endpoint to provide JSON web token granting acess to a user-based reading list. For a full list of all avaliable endpoints along with detailed information about them, check out the documentation page linked below.";
        $data['link'] = "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/documentation";
        
        
        return $data;
         
    }
}