<?php


class Contact extends Database
{

    public function getAll()
    {

        $query = "SELECT * FROM concat";
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
                    concat(id, 
                    phone,
                    email,
                    location, map_url)
                    VALUES(NULL,:title,:content,:path)";
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":phone", $input["phone"]);
            $stmt->bindParam(":location", $input["location"]);
            $stmt->bindParam(":email", $input["email"]);
            $stmt->bindParam(":map_url", $input["map_url"]);


            // execute query
            return $stmt->execute();
        }
    }


    public function update($input = [])
    {
        $query = "UPDATE concat 
        SET phone=:phone,
        location=:location,
        email=:email,
        map_url=:map_url
        ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":phone", $input["phone"]);
        $stmt->bindParam(":location", $input["location"]);
        $stmt->bindParam(":email", $input["email"]);
        $stmt->bindParam(":map_url", $input["map_url"]);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete()
    {
        $query = "delete FROM concat";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
