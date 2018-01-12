<?php
include("GlobalVars.php");
class ConnectionFactory
{
    public static $factory;
    public static function getFactory()
    {
        if (!self::$factory)
            self::$factory = new ConnectionFactory();
        return self::$factory;
    }
    
    public static $conn = NULL;
    
    public function getConnection()
    {
        $serverName   = $GLOBALS["serverName"];
        $databaseName = $GLOBALS["databaseName"];
        $dbuser       = $GLOBALS["dbuser"];
        $dbpassword   = $GLOBALS["dbpassword"];
        if (!isset($conn)) {
            try {
                $conn = new PDO("mysql:host=$serverName; dbname=$databaseName", $dbuser, $dbpassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->exec("set names utf8");
            }
            catch (Exception $e) {
                echo $e->getMessage();
                error_log($e->getMessage(), 0);
                //die( print_r( $e->getMessage() ) ); 
            }
        }
        return $conn;
    }
}

?>
