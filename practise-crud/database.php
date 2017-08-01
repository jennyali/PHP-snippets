

<?php
    class Database {

        private static $dbName = 'projectone';
        private static $dbHost = 'localhost';
        private static $dbUsername = 'root';
        private static $dbUserpassword = 'Jasper38';

        private static $cont = null;

        public function __construct() {
            die('Init function is not allowed');
        }

        public static function connect() {

            //One connect through whole application
            if ( null == self::$cont ) {
                try {

                    self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserpassword);
                
                } catch(PDOException $e) {
                    
                    die($e->getMessage());
                }
            }
            return self::$cont;
        }

        public static function disconnect()
        {
            self::$cont = null;
        }
    }

/* NOTES

'self::' is used to access the 'static' variable $cont thats inside the Database class.$_COOKIE

1/ variables that are private (no access from outside) and static (so variable is only in use at one time) with information are created. 
2/ the construct function i think denies making lots of instances of the database. 
3/ the __connect() function connects to DB, says if $cont is empty then try the following
- this includes the PDO string thing thats used to connect to the DB
- an error catcher in catch and then returns the $cont that is now filled with the DB connecting query
4/ disconnect() function gives DB class method to disconnect from DB when task done

*/


?>
