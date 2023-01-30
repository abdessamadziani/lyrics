
<?php
include_once("db.php");


class Artist
{
    static public function allArtists()
    {
        $stmt=db::connect()->prepare("select * from artiste");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function addArtist($data)
    {
        
            // $stmt=db::connect()->prepare("insert into artiste (name,date,img)values(:name,:date,:img)");
            // $stmt->execute(array(":name"=>$data["name"],":date"=>$data["date"],":img"=>$data["file"]));
            $stmt=db::connect()->prepare("insert into artiste (name,date,img)values(:name,:date,:img)");
            $stmt->execute(array(":name"=>$data["name"],":date"=>$data["date"],":img"=>$data["file"]));
        

        
    }

    static public function updateArtist($data,$exist)
    {
        if($exist=="yes")
        {
            $stmt=db::connect()->prepare("update artiste set name=:name,date=:date,img=:img where id=:id");
            $stmt->execute(array(":name"=>$data["name"],":date"=>$data["date"],":img"=>$data["file"],":id"=>$data["id"]));
        }
        else
        {
            $stmt=db::connect()->prepare("update artiste set name=:name,date=:date where id=:id");
            $stmt->execute(array(":name"=>$data["name"],":date"=>$data["date"],":id"=>$data["id"]));
        }

        
    }



    static public function deleteArtist($id)
    {
        $stmt=db::connect()->prepare("delete from artiste where id=:id");
        $stmt->execute(array(":id"=>$id));
        
    }

}




?>