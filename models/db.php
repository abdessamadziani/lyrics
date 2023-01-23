
<?php

class db
{

    protected $username="root";
    protected $password="";

    static public function connect()
    {
        try {
            $con = new PDO('mysql:host=localhost;dbname=lyrics',"root","");
           // echo "connextion succefuly";


        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        return $con;

    }
}
$tt=new db();
db::connect();