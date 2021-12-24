<?php
//endpunkt
class EntityTable
{
    protected function getProductName()
    {
        die("you must override getProductName()!");
    }

    protected function getProductCathegory(){
        die("you must override getProductCathegory()!");
    }

    protected function getProducts(){
        die("you must override getProducts");
    }

    protected function getPrimaryKey()
    {
        die("you must override getPrimaryKey()!");
    }

    protected function getActive(){
        die("you must override getActive()!");
    }
    /*
    protected function getTableName()
    {
        die("You must override getTableName()!");
    }

    protected function getFieldNames()
    {
        die("You must override getFieldNames()!");
    }

    protected function getPrimaryKey()
    {
        return $this->getTableName() . "_id";
    }

    */

    public function getactiveproduct($primaryKey, $active){
        $query = "SELECT * FROM " . $this->getTableProduct() . " Where " . $this->getPrimaryKey() . " = ? and" . $this->getActive() . " = true";

        $statement = DatabaseManager::getConnection()->prepare($query);

        $statement->bindValue(1, $primaryKey, PDO::PARAM_STR);


        if (!$statement->execute()){
            return null;
        }

        $returnactiveproduct = $statement->fetchall(PDO::FETCH_ASSOC);

        if (count($returnactiveproduct) == 0){
            return null;
        }
        return $returnactiveproduct;
    }

    public function get($primaryKey){


        $query = "SELECT * FROM " . $this->getTableProduct() . " WHERE " . $this->getPrimaryKey() . " = ? LIMIT 1";

        $statement = DatabaseManager::getConnection()->prepare($query);

        $statement->bindValue(1, $primaryKey, PDO::PARAM_STR);

        if (!$statement->execute()){
            return null;
        }

        $returnedproduct = $statement->fetchall(PDO::FETCH_ASSOC);

        if (count($returnedproduct) == 0){
            return null;
        }

        return $returnedproduct[0];

    }


    public function list()
    {
        $query = "SELECT * FROM " . $this->getTableProduct();

        $statement = DatabaseManager::getConnection()->prepare($query);

        if (!$statement->execute()) {
            return null;
        }

        $returnedproducts = $statement->fetchall(PDO::FETCH_ASSOC);

        if (count($returnedproducts) == 0){
            return null;
        }

        return $returnedproducts;

    }

    public function update($data, $primaryKey){


    }

    public function create($data){}









/*
    public function create($data)
    {
        $fieldNames = array();
        $values = array();
        $types = array();
        $placeholders = array();
        foreach ($data as $key => $value) {
            //Skip invalid fields.
            if (!in_array($key, $this->getFieldNames())) {
                continue;
            }

            $fieldNames[] = $key;
            $values[] = $value;
            $types[] = (is_integer($value) ? "i" : is_numeric($value)) ? "d" : "s";
            $placeholders[] = "?";
        }
        $query = "INSERT INTO " . $this->getTableName() . "(" . implode(", ", $fieldNames) . ") VALUES(" . implode(", ", $placeholders) . ")";

        //TODO: Prepare the statement with query and pass the values and types.
        //TODO: Return the complete inserted data with the primary key.
    }
*/
/*
    public function gets($primaryKey)
    {
        $query = "SELECT * FROM " . $this->getTableName() . " WHERE " . $this->getPrimaryKey() . " = ? LIMIT 1";

        $statement = DatabaseManager::getConnection()->prepare($query);

        $statement->bindValue(1, $primaryKey, PDO::PARAM_STR);

        if (!$statement->execute()) {
            return null;
        }

        $returnedPersons = $statement->fetchall(PDO::FETCH_ASSOC);

        if (count($returnedPersons) == 0) {
            return null;
        }
        return $returnedPersons[0];
    }
*/
    public function updates($primaryKey, $data)
    {
        $updates = array();
        $values = array();
        $types = array();
        foreach ($data as $key => $value) {
            //Skip invalid fields.
            if (!in_array($key, $this->getFieldNames())) {
                continue;
            }

            $updates[] = $key . " = ?";
            $values[] = $value;
            $types[] = (is_integer($value) ? "i" : is_numeric($value)) ? "d" : "s";
        }
        $query = "UPDATE " . $this->getTableName() . " SET " . implode(", ", $updates) . " WHERE " . $this->getPrimaryKey() . " = ? LIMIT 1";

        $values[] = $primaryKey;
        $types[] = (is_integer($primaryKey) ? "i" : is_numeric($primaryKey)) ? "d" : "s";

        //TODO: Prepare the statement with query and pass the values and types.
        //TODO: Return the complete uodated data.
    }

    public function delete($primaryKey)
    {
        $query = "DELETE FROM " . $this->getTableName() . " WHERE " . $this->getPrimaryKey() . " = ? LIMIT 1";
        //$statement = self::$database->prepare("INSERT INTO user(email, name, password) VALUES(?, ?, ?)");
        //TODO: Prepare the statement with query and pass the primary key and type.
    }
}

?>