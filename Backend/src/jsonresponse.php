<?php

/**
 * Create a JSON response with appropriate headers and json encoded data
 * 
 * Features several functions to check for null data before asigning messages, response codes, counting the rows of data recived and 
 * then displaying the data as a response.
 * 
 * @author Jacob Clark w18003237
 */



class JSONResponse extends Response
{
    private $message;
    private $statusCode;

    protected function headers()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setStatusCode($statusCode)
    {
        $this->status = $statusCode;
    }

    public function getData()
    {
        if (is_null($this->data)) {
            $this->data = [];
        }
        if (is_null($this->message)) {
            if (count($this->data) > 0) {
                $this->message = "ok";
                $this->setStatusCode(200);
            } else {
                $this->message = "no content";
                $this->setStatusCode(204);
            }
        }

        http_response_code($this->status);

        $response{
        'status'} = $this->status;
        $response['message'] = $this->message;
        $response['count'] = count($this->data);
        $response['results'] = $this->data;

        return json_encode($response);
    }
}
