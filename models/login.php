<?php



include_once("db.php");


class Login
{
    static public function checklogin($data)
    {
        $stmt=db::connect()->prepare("select * from admin where email= :email and password= :password");
        $stmt->execute(array(":email"=>$data["email"] ,":password"=>$data["password"]));
        $nblignes=$stmt->rowCount();
        if($nblignes>0)
        return "ok";
        else
        return "error";
    }



}

