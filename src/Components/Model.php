<?php
/**
 * Created by PhpStorm.
 * User: Patricio
 * Date: 18/3/2018
 * Time: 15:41
 */

namespace Sb\Components;


use App\Models\Product;

class Model
{
    
    protected $tableName;
    
    protected $prefix;
    
    protected $pdo;
    
    protected $id;
    
    
    public function get($id)
    {
        $sql  = "SELECT * FROM {$this->tableName} WHERE {$this->prefix}_id = {$id}";
        $stmt = $this->getPdo()->query($sql);
        /*$stmt->bindValue(':table', $this->tableName);
        $stmt->execute();*/
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function getAll()
    {
        $sql  = "SELECT * FROM $this->tableName";
        $stmt = $this->getPdo()->query($sql);
        /*$stmt->bindValue(':table', $this->tableName);
        $stmt->execute();*/
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function store($child)
    {
        $sql = "INSERT INTO {$this->tableName} ({$this->prefix}_name, {$this->prefix}_description, {$this->prefix}_size, {$this->prefix}_cost)
                  VALUES ('{$child->getName()}', '{$child->getDescription()}', '{$child->getSize()}', '{$child->getCost()}')";
        $this->getPdo()->query($sql);
        $id       = $this->getPdo()->lastInsertId();
        $redirect = BASE_URL . 'product/' . $id;
        header("Location: {$redirect}");
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->tableName} WHERE {$this->prefix}_id = {$id}";
        $this->getPdo()->query($sql);
    }
    
    public function updates($id, $data)
    {
        array_pop($data);
        $sql           = "SELECT * FROM {$this->tableName} WHERE {$this->prefix}_id = {$id}";
        $stmt          = $this->getPdo()->query($sql);
        $productFromDb = $stmt->fetch();
        $product       = new Product();
        foreach ($data as $key => $item) {
            $dbfield = $this->prefix . '_' . $key;
            $method  = 'set' . ucwords($key);
            if (($item !== '') && ($productFromDb[$dbfield] !== $item)) {
                $product->$method($item);
            } else {
                $product->$method($productFromDb[$dbfield]);
            }
        }
        $sql = "UPDATE {$this->tableName}
                SET {$this->prefix}_name='{$product->getName()}',
                {$this->prefix}_description='{$product->getDescription()}',
                {$this->prefix}_size='{$product->getSize()}',
                {$this->prefix}_cost='{$product->getCost()}'
                WHERE {$this->prefix}_id='{$id}'";
        $this->getPdo()->query($sql);
        $redirect = BASE_URL . 'product/' . $id;
        header("Location: {$redirect}");
    }
    
    protected function getPdo()
    {
        if (!isset($this->pdo)) {
            $this->pdo = DataBase::connect();
        }
        return $this->pdo;
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}