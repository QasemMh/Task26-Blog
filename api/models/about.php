<?php


class About extends Database
{

    public function getAll()
    {

        $query = "SELECT * FROM aboutus";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }



    public function create($input = [])
    {

        if ($this->getAll()->rowCount() > 0) {
            $this->update($input);
        } else {

            $query = "INSERT INTO 
                    aboutus(id, 
                    title,
                    content,
                    path)
                    VALUES(NULL,:title,:content,:path)";
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":title", $input["title"]);
            $stmt->bindParam(":content", $input["content"]);
            $stmt->bindParam(":path", $input["path"]);


            // execute query
            return $stmt->execute();
        }
    }


    public function update($input = [])
    {
        $query = "UPDATE aboutus 
        SET title=:title,
        content=:content,
        path=:path";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $input["title"]);
        $stmt->bindParam(":content", $input["content"]);
        $stmt->bindParam(":path", $input["path"]);


        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete()
    {
        $query = "delete FROM aboutus";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
