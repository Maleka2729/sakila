<?php

class users extends database {

    // function return all clients
    public function getClients() {
        $sql = "SELECT * FROM customer";
        $query = $this->connectDb()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
        
    }

    //function return all staff
    public function getStaffs() {
        $sql = "SELECT * FROM staff";
        $query = $this->connectDb()->prepare($sql);
        $query->execute();
        return $query->fetchAll();
        
    }
}

?>