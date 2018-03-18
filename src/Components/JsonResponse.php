<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 17/3/2018
 * Time: 00:35
 */

namespace Sb\Components;


class JsonResponse
{
    protected $response;
    protected $header;
    public function __construct($response, String $header)
    {
        $this->setResponse($response);
        $this->setHeader($header);
    }
    
    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
    
    /**
     * @param mixed $response
     *
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = json_encode($response);
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }
    
    /**
     * @param string $header
     *
     * @return $this
     */
    public function setHeader(String $header)
    {
        $this->header = $header;
        return $this;
    }
    
    public function response(){
        header($this->getHeader());
        echo $this->getResponse();
        die();
    }
}