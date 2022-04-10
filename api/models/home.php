<?php


class Home extends Database
{

    public function getAll()
    {

        $query = "SELECT * FROM home";
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
                    home(id, 
                    tap_title,
                    logo_name,
                    facebook_url,
                    insta_url,
                    twitter_url) 
                    VALUES(NULL,:tap,:logo,:facebook,:insta,:twitter)";
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":tap", $input["tap"]);
            $stmt->bindParam(":logo", $input["logo"]);
            $stmt->bindParam(":facebook", $input["facebook"]);
            $stmt->bindParam(":insta", $input["insta"]);
            $stmt->bindParam(":twitter", $input["twitter"]);


            // execute query
            return $stmt->execute();
        }
    }


    public function update($input = [])
    {
        $query = "UPDATE home 
        SET tap_title=:tap,
        logo_name=:logo,
        facebook_url=:facebook,
        insta_url=:insta,
        twitter_url=:twitter";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tap", $input["tap"]);
        $stmt->bindParam(":logo", $input["logo"]);
        $stmt->bindParam(":facebook", $input["facebook"]);
        $stmt->bindParam(":insta", $input["insta"]);
        $stmt->bindParam(":twitter", $input["twitter"]);


        // execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete()
    {
        $query = "delete FROM home";
        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        return $stmt;
    }
}
