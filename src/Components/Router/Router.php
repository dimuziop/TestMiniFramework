<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 17/3/2018
 * Time: 01:59
 */

namespace Sb\Components\Router;


use Sb\Components\Cleaners\UriMaker;
use Sb\Components\Helpers\ArrayHelpers;
use Sb\Components\JsonResponse;

class Router
{
    
    protected $requesturi;
    
    protected $uriParams = [];
    
    protected $verb;
    
    protected $loader;
    
    protected $routeCollection = [];
    
    protected $matchedRoute;
    
    
    public function __construct($loader)
    {
        $this->setRequesturi(filter_var($_SERVER['REQUEST_URI'],
            \FILTER_SANITIZE_URL));
        $this->setVerb($_SERVER['REQUEST_METHOD']);
        $this->loader = $loader;
    }
    
    public function load()
    {
        $this->loader->load($this);
        $this->filterVerbAndRouteOrFail();
    }
    
    public function getParams()
    {
        UriMaker::detector($this);
    }
    
    public function check($resourse)
    {
        //var_dump($this->routeCollection);
        return true;
    }
    
    /*
     * Stores the routes when the requested verb is right to the request resourse
     */
    public function store($route)
    {
        $collection[]            = $route;
        $map                     = array_column($collection, $this->getVerb());
        $this->routeCollection[] = isset($map[0]) ? $map[0] : null;
        return $this;
    }
    
    /*
     * This method match the request route with declared routes
     */
    protected function filterVerbAndRouteOrFail()
    {
        $this->filterRoutes();
        $this->routesCutterAndActions();
        $this->validOrFail($this->requestMatches());
        
    }
    
    protected function execute($param = null){
        if($param === null){
            $this->matchedRoute['function']();
        }else{
            $this->matchedRoute['function']($param);
        }
    }
    
    protected function validOrFail($route){
        if ($route !== null) {
            $this->matchedRoute = $route;
            if(!$this->requieresParameters()){
                $this->execute();
            }else{
                $this->execute($this->getItems());
            }
        } else {
            $response = new JsonResponse(
                [
                    'Error' => 'Sorry, resource you try to access does not exists',
                ],
                $_SERVER['SERVER_PROTOCOL'] . ' 404 Not found',
                true,
                404);
            $response->response();
        }
    }
    
    protected function requieresParameters()
    {
        $reflection = new \ReflectionFunction($this->matchedRoute['function']);
        return $reflection->getNumberOfRequiredParameters() >= 1;
    }
    
    /*
     * It needs refactoring to bind all the parameters of the uri
     */
    protected function getItems(){
        $params = ArrayHelpers::getParamsOfClosure($this->matchedRoute['exploited_uri']);
        return $this->uriParams[0];
    }
    
    /*
     * Filters emptys in array of routes declaration
     */
    protected function filterRoutes()
    {
        $this->routeCollection = ArrayHelpers::removeEmptys($this->routeCollection);
    }
    
    /*
     * Filters emptys in array and makes an array from the request uri and let the params
     */
    protected function requestMatches()
    {
        $uri            = str_replace(API_NAME, '', $this->getRequesturi());
        $requestedRoute = ArrayHelpers::removeEmptys(explode('/', $uri));
        $this->uriParams = $requestedRoute;
        array_shift($this->uriParams);
        return ArrayHelpers::searchMeInRoutesArray($this->routeCollection,
            $requestedRoute);
    }
    
    /*
     * Explodes the routes ans store it in array and compares with te request
     */
    protected function routesCutterAndActions()
    {
        foreach ($this->routeCollection as $key => $route) {
            $this->routeCollection[$key]['exploited_uri'] = ArrayHelpers::filtersRootTreatment($route['uri']);
        }
    }
    
    /**
     * @return mixed
     */
    public function getRequesturi()
    {
        return $this->requesturi;
    }
    
    /**
     * @param mixed $requesturi
     */
    protected function setRequesturi($requesturi)
    {
        $this->requesturi = $requesturi;
    }
    
    /**
     * @return mixed
     */
    public function getVerb()
    {
        return $this->verb;
    }
    
    /**
     * @param mixed $verb
     */
    protected function setVerb($verb)
    {
        $this->verb = $verb;
    }
}