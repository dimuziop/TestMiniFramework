<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 18/3/2018
 * Time: 16:52
 */

namespace App\Models;


use Sb\Components\Model;

class Product extends Model
{
    protected $tableName = 'products';
    
    protected $prefix = 'item';
    
    protected $name;
    
    protected $description;
    
    protected $size;
    
    protected $cost;
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }
    
    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getCost()
    {
        return $this->cost;
    }
    
    /**
     * @param mixed $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }
}