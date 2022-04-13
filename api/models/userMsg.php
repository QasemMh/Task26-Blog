<?php


class UserMessage extends Database
{

    public function getAll()
    {

        $query = "SELECT * FROM user_message";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getBy($id)
    {

        $query = "SELECT * FROM user_message WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {

        $query = "INSERT INTO user_message
        (id, name, email, subject, message)
         VALUES (NULL,:name,:email,:subject,:message)";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":message", $input["message"]);
        $stmt->bindParam(":subject", $input["subject"]);
        $stmt->bindParam(":email", $input["email"]);


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function update($input = [], $id)
    {
        $query = "UPDATE user_message 
        SET name= :name,
        subject=:subject,
        message=:message,
        email=:email 
        WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":message", $input["message"]);
        $stmt->bindParam(":subject", $input["subject"]);
        $stmt->bindParam(":email", $input["email"]);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete($id)
    {
        $query = "delete FROM user_message where id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
