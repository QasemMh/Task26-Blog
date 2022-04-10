<?php


class User extends Database
{

    public function getUsers($limit = 10)
    {

        $query = "
            SELECT
                u.id,
                u.name,
                u.username,
                u.email,
                u.createAt,
                r.name role
            FROM
                users u
                inner join role r
                on u.role_id=r.id
            LIMIT ?
        ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getUserBy($id)
    {
        $query = "
        SELECT
        u.id,
        u.name,
        u.username,
        u.email,
        u.createAt,
        r.name role
    FROM
        users u
        inner join role r
        on u.role_id=r.id
        WHERE u.id=? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
    public function getLoginData($username)
    {
        $query = "SELECT id,username,password FROM users where username = ? ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username, PDO::PARAM_STR);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function createUser($input = [])
    {
        //hash the password
        $hash_pass = password_hash($input["password"], PASSWORD_DEFAULT);


        $query = "INSERT INTO users(id, name, username, email,password, role_id,createAt) 
         VALUES(null,:name,:username,:email,:password,:role_id, current_timestamp())";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":email", $input["email"]);
        $stmt->bindParam(":role_id", $input["role_id"]);
        $stmt->bindParam(":username", $input["username"]);
        $stmt->bindParam(":password", $hash_pass);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    public function updateUser($input = [], $id)
    {
        $query = "UPDATE users SET name=:name, username=:username,
         email=:email, role_id=:role_id WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":email", $input["email"]);
        $stmt->bindParam(":role_id", $input["role_id"]);
        $stmt->bindParam(":username", $input["username"]);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



    public function deleteUser($id)
    {
        $query = "delete FROM users where id=?";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
