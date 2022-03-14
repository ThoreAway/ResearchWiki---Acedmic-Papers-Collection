<?php

/**
 * docuumenation controller to display content within the documentation page using the fucntions defined in webpage 
 *
 * 
 * @author Jacob Clark w18003237
 */

class DocumentationController extends Controller {

    protected function processRequest() {

        $page = new DocumentationPage("Documenation", "assets/index.css", ["Documentation"=>"documentation", "Home"=>"home" ], "documentation");
        
        $page->addDiv("container");

        $page -> addDiv("header");
        $page->addHeading1("API Documentation");
        $page->addParagraph("This is the documentation page where you can find a list featuring each of the individual API endpoints along with detailed information including how they can be acessed.");
        $page -> closeDiv();
    

        $links = ["api"=>"api", "authors"=>"authors",  "papers"=>"papers",  "authenticate"=>"authenticate",  "readinglist"=>"readinglist"];
        $page->addDiv("sideMenu"); 
        $page->addSectionId("sideMenu");
        $page->addHeading3("Contents List");
        $page->addSideMenu($links);
        $page-> closeSectionId();
        $page->closeDiv();

        $page->addDiv("content");
        $page->addSectionId("api");
        $page->addDiv("api");
        $page->addHeading2("Endpoint 1: /api");
        $page->addLink("http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api", "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api");

        $page->addHeading3("Info:"); 
        $page->addParagraph("This is the base endpoint for the API that supports GET and POST requests to return a JSON response containing key information regarding the API and student details.");

        $page->addHeading3("Parameter Support:");   
        $page->addParagraph("It doesn't currently support any aditonal parameters.");

        $page->addHeading3("JSON Response: "); 
        $page->addParagraph("The response returned uses the appropriate key and value format to store the data about the API such as 'name' : 'Jacob Clark'.");

        $page->addHeading3("Expected HTTP Status Codes:"); 
        $page->addParagraph(" 200 with the message 'OK' when the JSON data is returned correctly. <br>
        404 with a message of 'endpoint not found' if the endpoint has been typed incorrectly beyond '/api' such as '/apii'.<br>
        500 with a message of 'Internal Server Error!' if there is uncuaght errors within the JSON response.
        ");

        $page->addHeading3("Example Request and Response");
        $page->addParagraph("Request: http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api");
        $page->addParagraph("Response:<br> {
            'status': 200, <br>
            'message': 'ok', <br>
            'count': 4, <br>
            'results': { <br>
            'name': 'Jacob Clark',<br>
            'id': 'w18003237',<br>
            'message': 'This is the base endpoint API for this web application. This web API features a varitey of endpoints for displaying data regarding academic papers and their relevant authors as well as authenitcation endpoint to provide JSON web token granting acess to a user-based reading list. For a full list of all avaliable endpoints along with detailed information about them, check out the documentation page linked below.', <br>
            'link': 'http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/documentation'} <br> 
            }"
        );
        $page -> closeDiv();
        $page->closeSectionId();

        $page->addSectionId("authors");
        $page->addDiv("authors");
        $page->addHeading2("Endpoint 2: /api/authors");
        $page->addLink("http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/authors", "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/authors");

        $page->addHeading3("Info:"); 
        $page->addParagraph("This endpoint is used to display information and data regarding relevant authors from the authors table of the database. It supports HTTP GET requests to return an array of authors with their full names and author ID's. ");

        $page->addHeading3("Parameter Support:");   
        $page->addParagraph(" The author API currently supports two additonal parameters that can be passed through to filter the data that is being returned. The first is 'id' which expects an interger value to be passed for it to return an array with just the author with the specified id or an error message if there is no author with that id. For example: 'authors?id=59911'. The other parameter is 'paperid' which also expects an interger value to be passed for it to return all authors that are credited for the paper matching the specified paper id or an error message if there are no papers with that id. For example: 'authors?paperid=60080'.");

        $page->addHeading3("JSON Response:"); 
        $page->addParagraph(" The response returned will be an array of authors following the standard JSON key and value format with information regarding each author returned such as: <br>
            'AuthorId' : '59562',<br>
            'FirstName' : 'Xuhai',<br>
            'MiddleName': '',<br>
            'LastName': 'Xu'"
        );

        $page->addHeading3("Expected HTTP Status Codes:"); 
        $page->addParagraph("200 with the message 'OK' when any of the author data is returned correctly.<br> 
        404 with a message of 'endpoint not found' if the endpoint has been typed incorrectly beyond '/api' such as '/api/authorsd'. <br> 404 with a message of 'Given parameter value was not found' if the endpoint parameter value that is given returns a result with a count equal or less than 0. <br>
        405 with a message of 'Method not allowed' if any request method other than 'GET' is used. <br>
        500 with a message of 'Internal Server Error!' if there is uncuaght errors within the JSON response.
        ");

        $page->addHeading3("Example Request and Response");
        $page->addParagraph("Request: GET = http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/authors?paperid=60074");
        $page->addParagraph("Response:<br> {
            'status': 200, <br>
            'message': 'ok', <br>
            'count': 3, <br>
            'results': [ <br>
            'AuthorId': '59829',<br>
            'FirstName': 'Inchan',<br>
            'MiddleName': '',<br>
            'LastName': 'Jung'
        },<br>
        <br>
        {'AuthorId': '59821',<br>
            'FirstName': 'Hankyung',<br>
            'MiddleName': '',<br>
            'LastName': 'Kim'
        },<br>
        <br>
        {'AuthorId': '59627',<br>
            'FirstName': 'Youn-kyung',<br>
            'MiddleName': '',<br>
            'LastName': 'Lim'}<br> 
            ]}"

        );
        $page -> closeDiv();
        $page->closeSectionId();

        $page->addSectionId("papers");
        $page->addDiv("papers");
        $page->addHeading2("Endpoint 3: /api/papers");
        $page->addLink("http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/papers", "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/papers");

        $page->addHeading3("Info:"); 
        $page->addParagraph("This endpoint is used to display information and data regarding relevant papers from the papers table of the database. It supports HTTP GET requests to return an array of papers with relevant information of each paper such as the paper id, title, abstract and awards it has recieved.");

        $page->addHeading3("Parameter Support:");   
        $page->addParagraph("The paper API currently supports 3 additonal parameters that can be passed through to filter the data that is being returned. The first is 'id' which expects an interger value to be passed for it to return an array containing just the paper with the specified id or an error message if there is no paper with that id. For example: 'papers?id=60080'. The second parameter is 'authorid' which also expects an interger value to be passed for it to return all papers that have credited the author matching the specified paper id  or an error message if there are no papers with that id. For example: 'papers?authorid=59562'. The third parameter supported by papers is 'award' which expects one of two possible words, either 'all' or 'none'. Based on the word given the endpoint will return an array of papers which either have at least one award accreddited to them or instead return the papers that have no awards accredited to them.");

        $page->addHeading3("JSON Response:"); 
        $page->addParagraph("The response returned will be an array of papers following the standard JSON key and value format with information regarding each paper returned such as: 
            'PaperId' : '60084',<br>
            'title' : 'Hybrid Embroidery Games: Playing with Materials, Machines, and People', <br>
            'abstract': 'Our work centers on aspects of crafting creativity that are often overlooked in digital fabrication: playfulness, and possibilities for social engagement. We draw from precedents in both crafting (e.g. quilting bees) and gameplay (e.g. “Exquisite Corpse”) to inform the design of a set of turn-based collaborative games which center a computer-controlled embroidery machine as a “player” in games for one or more crafters. We prototype these games using our own computational input/ output embroidery pipeline and observe how they can guide crafter-players to engage with physical, digital, and social affordances. We summarize our findings on how creative focus can shift over a playful experience of fabrication and how technology can mediate social crafting.' and 'award': 'Best Pictorial'"
        );

        $page->addHeading3("Expected HTTP Status Codes:"); 
        $page->addParagraph("200 with the message 'OK' when any of the papa data is returned correctly.<br> 
        404 with a message of 'endpoint not found' if the endpoint has been typed incorrectly beyond '/api' such as '/api/papperss'. <br> 
        404 with a message of 'Given parameter value was not found' if the endpoint parameter value that is given returns a result with a count equal or less than 0. <br> 
        405 with a message of 'Method not allowed' if any request method other than 'GET' is used.<br> 
        500 with a message of 'Internal Server Error!' if there is uncuaght errors within the JSON response.
        ");

        $page->addHeading3("Example Request and Response");
        $page->addParagraph("Request: GET = http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/papers?authorid=59556");
        $page->addParagraph("Response:<br> {
            'status': 200, <br>
            'message': 'ok', <br>
            'count': 2, <br>
            'results': [ <br> 
            {'PaperId': '60099', <br>
            'title': 'Do Integral Emotions Affect Trust? The Mediating Effect of Emotions on Trust in the Context of Human-Agent Interaction', <br>
            'abstract': 'Prior efforts have noted the effect of reliability, risk, and degree of anthropomorphism on trust in the context of human-agent interaction. However, the effects of these factors on resulting emotions while interacting with autonomous agents and their influence on trust are not clear. Towards that, we designed a 2 (partner: automation/human) × 2 (risk: low/high) × 2 (reliability: low/high) between-group study to identify relevant discrete emotions and their (emotions') influences on users' trustworthiness perceptions (ability, integrity, and benevolence). The results identified four emotion factors (positive emotions, hostility, anxiety, and loneliness) related to human-agent interaction. Although the reliability condition affected all four emotion factors, the mediating effects of the emotion factors on reliability and trustworthiness perceptions relationships differed for the varying emotion factors. The implications of our findings for trust calibration in the context of designing interactive systems are discussed in the paper.' , <br>
            'award': null},<br>
            <br>
            {'PaperId': '60143', <br>
            'title': 'Trust and Anthropomorphism in Tandem: The Interrelated Nature of Automated Agent Appearance and Reliability in Trustworthiness Perceptions', <br>
            'abstract': 'Anthropomorphism in the design of interface agents is implicitly linked to increasing user trust and acceptance. However, the role of perceived anthropomorphism and perceived trustworthiness in trust appropriateness given a system's capabilities and limitations is unclear. We designed a 2 (reliability: low, high) x 3 (agent appearance: computer, avatar, human) between-subject study to observe how agent appearance influenced user perceptions of and reliance on an automated teammate in a collaborative image classification task. Trust appropriateness was characterized as the degree to which reliance matched an optimal level given the system's reliability. Although agent appearance did not significantly influence trust appropriateness, it did affect perceptions of trustworthiness, particularly for low reliability agents. Our results suggest that trust and anthropomorphism involve highly related, dynamic perceptions aimed at anticipating system behavior. Based on our findings, recommendations for future research on trust and anthropomorphism are discussed along with some design implications.', <br>
            'award': null}<br>
            ]}"
        );
        $page -> closeDiv();
        $page->closeSectionId();
        

        $page->addSectionId("authenticate");
        $page->addDiv("authenticate");
        $page->addHeading2("Endpoint 4: /api/authenticate");
        $page->addLink("http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate", "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate");

        $page->addHeading3("Info:"); 
        $page->addParagraph("This endpoint is used to authenticate a login process to provide a valid JSON web token (jwt) that can be stored on the browser server to give user-based acess to other enpoints such as the readinglist. It supports HTTP POST requests to return an encoded jwt if valid user account information is provided as form data in the body of the get request. This encoded token can be decoded using the specifed algothim type that was used to encode it. The jwt <a href='https://jwt.io/'> website</a> can do this so that the payload(data) of the token can be viewed.");

        $page->addHeading3("Parameter Support:"); 
        $page->addParagraph("The authenticate endpoint accecpts two separate  parameters of 'username' and 'password' which are used to create a jwt for readinglist access. These are expected in the body of the request as standard form data. The username provided is used to see if there is a password associated to the specified account. If this returns a match then the hashed password for that user can  be retrieved before being compared to the password parameter given using a unique secret key. Finally, if the parameter password and hashed password match then a an encoded jwt token will be created containing several sets of 'claims', reserved and custom. These include 'user_id' to store user id, 'username' to store the user email used to login, 'exp' to store the time at which the token will expire at(default is 5 minutes from creation'), 'iat' to store the time of token creation and finally 'iss' to store the url of token 'issuer'."
        );

        $page->addHeading3("JSON Response:"); 
        $page->addParagraph(" The response returned will be a single encoded jwt if the authentication process was succesful. The token will follow the JSON key and value format for each token created such as: <br>
            'token': 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSIsIn' (note that the token encryption value has been shortened for convenience)."
        );

        $page->addHeading3("Expected HTTP Status Codes:"); 
        $page->addParagraph("200 with the message 'OK' when any of the author data is returned correctly.<br> 
        404 with a message of 'endpoint not found' if the endpoint has been typed incorrectly beyond '/api' such as '/api/authenticatee'.<br>
        401 with a message of 'Unauthorized' if the jwt can not be created due to a faliure in the authorization process using the expected parameters. This could be due them not being passed at all or not matching any user data in the database. <br>
        405 with a message of 'Method not allowed' if any request method other than 'POST' is used. <br>
        500 with a message of 'Internal Server Error!' if there is uncuaght errors within the JSON response.
        ");

        $page->addHeading3("Example Request and Response");
        $page->addParagraph("Request: POST = http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate <br>
                            form-data = username : john@example.com, password : johnpassword ");
        $page->addParagraph("Response:<br> {
            'status': 200, <br>
            'message': 'ok',<br>
            'count': 1, <br>
            'results':  { <br>
                'token': 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSIsIn' <br>
               }}"
        );
        $page -> closeDiv();
        $page->closeSectionId();

        $page->addSectionId("readinglist");
        $page->addDiv("readinglist");
        $page->addHeading2("Endpoint 5: /api/readinglist");
        $page->addLink("http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist", "http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist");

        $page->addHeading3("Info:"); 
        $page->addParagraph("This endpoint is used to display and edit data from a reading list table of the user database. The reading list is user-based and stores user id's matched to paper_id's to build up lists of papers a user may want to read in the future. It supports HTTP POST requests to return reading list data based on the data of a passed valid jwt along with ability to add and remove papers to and from the list.");

        $page->addHeading3("Parameter Support:"); 
        $page->addParagraph("The readinglist endpoint currently supports 3 seperate parameters to be passed in the body of the request; 'token', 'add' and 'remove'. The token parameter is always expected upon any request and is used to validate that the user has followed the authentication procedure. The parameter will be the encoded token that API can decode using the specified algorthim type. The user id stored on the token is used to display all records in the reading list that match it. The add and remove parameter are used to respectivley insert and delete records within the reading list table. Each are expected to be a relevant paper_id that can either be inserted  into the table alongside the associated users id or deleted from the table if it currently exists."
        );

        $page->addHeading3("JSON Response:"); 
        $page->addParagraph(" The response returned will be an array of user_id's and paper_id's  following the standard JSON key and value format with  information regarding each author returned such as: <br> 
        'paper_id': '60071'."
        );

        $page->addHeading3("Expected HTTP Status Codes:"); 
        $page->addParagraph("200 with the message 'OK' when the readinglist data is returned correctly.<br> 
        404 with a message of 'endpoint not found' if the endpoint has been typed incorrectly beyond '/api' such as '/api/readinglisttt'. <br> 
        401 with a message of 'Unauthorized' if a valid jwt is not pased as a parameter within POST request
        405 with a message of 'Method not allowed' if any request method other than 'POST' is used. <br>
        500 with a message of 'Internal Server Error!' if there is uncuaght errors within the JSON response.
        ");
        $page->addHeading3("Example Request and Response");
        $page->addParagraph("Request: POST = http://unn-w18003237.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist <br>
                            form-data = token : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSIsIn ");
        $page->addParagraph("Response:<br> {
            'status': 200, <br>
            'message': 'ok',<br>
            'count': 1, <br>
            'results':  [ <br>
                {'paper_id': '60071'}, <br>
                {'paper_id': '60072'}, <br>
                {'paper_id': '60085'}, <br>
                {'paper_id': '60083'}, <br>
                {'paper_id': '60084'}, <br>
               ]}"

        );
        $page -> closeDiv();
        $page->closeSectionId();
        $page->closeDiv();

        $page -> closeDiv();



        return $page->generateWebpage();
    }
}