<?php


class Category extends Database
{

    public function getAll()
    {

        $query = "SELECT id,name FROM category";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getBy($id)
    {

        $query = "SELECT id,name FROM category WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {

        $query = "INSERT INTO  category ( id ,  name ) VALUES(NULL,:name)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function update($input = [], $id)
    {
        $query = "UPDATE category 
        SET name= :name 
        WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete($id)
    {
        $query = "delete FROM category where id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
