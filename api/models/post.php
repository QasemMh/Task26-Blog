<?php


class Post extends Database
{

    public function getAll($limit)
    {

        $query = "
        SELECT
    p.id ,
    p.title ,
    p.content ,
    p.createAt ,
    p.author_id ,
    u.name,
    p.category_id ,
    p.path ,
    c.name category
FROM
     post p
INNER JOIN users u
 ON  p.author_id = u.id
 Inner Join category c On c.id=p.category_id
  ORDER BY p.createAt DESC limit :limit";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }


    public function getBy($id)
    {

        $query = "  SELECT
        p.id ,
        p.title ,
        p.content ,
        p.createAt ,
        p.author_id ,
        u.name,
        p.category_id ,
        p.path ,
        c.name category
    FROM
         post p
    INNER JOIN users u
     ON  p.author_id = u.id
     Inner Join category c On c.id=p.category_id
      WHERE p.id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    public function create($input = [])
    {

        //$content = htmlentities($input["content"]);
        $content = $input["content"];

        $query = "
        INSERT INTO post(
        id,
        title,
        content,
         author_id,
        category_id, path)  
         VALUES(NULL,:title,:content,:author_id,:category_id,:path)
        ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":author_id", $input["author_id"]);
        $stmt->bindParam(":category_id", $input["category_id"]);
        $stmt->bindParam(":path", $input["path"]);


        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function update($input = [], $id)
    {
        //  $content = htmlentities($input["content"]);
        $content = $input["content"];

        $query = "UPDATE POST 
        SET title= :title ,
        content=:content,
        author_id=:author_id,
        category_id=:category_id,
        path=:path
        WHERE id=:id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":author_id", $input["author_id"]);
        $stmt->bindParam(":category_id", $input["category_id"]);
        $stmt->bindParam(":path", $input["path"]);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete($id)
    {
        $query = "delete FROM POST where id=:id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
