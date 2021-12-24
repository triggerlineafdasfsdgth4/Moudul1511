<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class DatabaseManager
{
    private static $database;


    static function initialize()
    {

        // auslagern in json datei
        $username = "root";
        $password = "";

        try {
            self::$database = new PDO("mysql:host=localhost;dbname=shop", $username, $password);
        } catch
        (Exception $exception) {
            echo "Cannot connect to the database. This is the error: " . $exception->getMessage();
            die();
        }
    }

    public static function getConnection()
    {
        if (!self::$database) {
            self::initialize();
        }

        return self::$database;

    }
    /*
    function transaction()
    {
        try {
            self::$database->beginTransaction();

            $statement = self::$database->prepare("INSERT INTO user(email, name, password) VALUES(?, ?, ?)");

            $statement->bindParam(1, $email, PDO::PARAM_STR);
            $statement->bindParam(2, $name, PDO::PARAM_STR);
            $statement->bindParam(3, $password, PDO::PARAM_STR);

            $email = "horst@wuppmann.de";
            $name = "Horst Wuppmann";
            $password = password_hash("1234", PASSWORD_DEFAULT);
            $statement->execute();

            $email = "klaus@dieter.de";
            $name = "Klaus Dieter";
            $password = null;
            $statement->execute();

            self::$database->commit();
        } catch (Exception $exception) {
            self::$database->rollBack();
            echo "<p>Database error: " . $exception->getMessage() . "</p>";

        }
    }

    */

}

?>


}