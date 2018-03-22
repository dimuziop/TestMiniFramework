<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 18/3/2018
 * Time: 17:02
 */

namespace App\Controllers;


use App\Models\Product as ProductModel;
use Sb\Components\Helpers\JsonInputs;
use Sb\Components\JsonResponse;

class Product
{
    
    public function getAll()
    {
        $product  = new ProductModel();
        $response = new JsonResponse($product->getAll());
        $response->response();
    }
    
    public function get($id)
    {
        $product  = new ProductModel();
        $response = new JsonResponse($product->get($id));
        $response->response();
    }
    
    public function store()
    {
        session_start();
        if (isset($_SESSION['token']) && password_verify(json_encode($_SESSION['token']), $_POST['token'])) {
            $sanitizedPost = array_map(function ($var) {
                return filter_var($var, FILTER_SANITIZE_STRING);
            }, $_POST);
            $product       = new ProductModel();
            $product->setName($sanitizedPost['name'])
                    ->setDescription($sanitizedPost['description'])
                    ->setSize($sanitizedPost['size'])
                    ->setCost($sanitizedPost['cost'])
                    ->store($product);
            die();
        }else {
            $redirect = BASE_URL . 'login/';
            header("Location: {$redirect}");
        }
    }
    
    public function delete($id)
    {
        session_start();
        if (isset($_SESSION['token']) && password_verify(json_encode($_SESSION['token']), $_POST['token'])) {
        $product = new ProductModel();
        $product->delete($id);
        $redirect = BASE_URL . 'products/';
        header("Location: {$redirect}");
        }else {
            $redirect = BASE_URL . 'login/';
            header("Location: {$redirect}");
        }
    }
    
    public function updates($id)
    {
        session_start();
        $input   = JsonInputs::getArrayFromJson();
        if (isset($_SESSION['token']) && password_verify(json_encode($_SESSION['token']), $input['token'])) {
                $product = new ProductModel();
                $product->updates($id, $input);
        }else {
            $redirect = BASE_URL . 'login/';
            header("Location: {$redirect}");
        }
    }
}