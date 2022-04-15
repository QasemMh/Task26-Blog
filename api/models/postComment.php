<?php


class PostComment extends Database
{

    public function getAll()
    {
        $query = "
        SELECT
            id ,
            name ,
            content ,
            createAt ,
            email ,
            post_id
        FROM post_comment
        ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getCommentsCount()
    {
        $query = "
        SELECT COUNT(id) count,post_id FROM post_comment GROUP BY post_id
        ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getBy($id)
    {

        $query = "
        SELECT
        id ,
        name ,
        content ,
        createAt ,
        email ,
        post_id
    FROM post_comment WHERE id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function getByPost($postId, $limit = 30)
    {

        $query = "SELECT
                    id,
                    name,
                    content,
                    createAt,
                    email FROM post_comment 
                    WHERE post_id=:id LIMIT :lim";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $postId, PDO::PARAM_INT);
        $stmt->bindParam(":lim", $limit, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {

        $query = "
        INSERT INTO  post_comment (
             id ,
             content ,
             name ,
             email ,
             post_id ,
             createAt 
        )
        VALUES(NULL,:content,:name,:email,:post_id,current_timestamp())";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $input["name"]);
        $stmt->bindParam(":content", $input["content"]);
        $stmt->bindParam(":email", $input["email"]);
        $stmt->bindParam(":post_id", $input["post_id"]);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function delete($id)
    {
        $query = "delete FROM post_comment where id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
