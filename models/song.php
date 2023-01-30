<?php
require_once "db.php";

class Song 
{


static public function allAdmins()
{
        $stmt=db::connect()->prepare("select id,name from admin");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
}

static public function allTypes()
{
        $stmt=db::connect()->prepare("select id,name from category");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
}

static public function allArtists()
{
        $stmt=db::connect()->prepare("select id,name from artiste");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
}

 static public function allSongs()
 {
    $stmt=db::connect()->prepare("select s.id,s.titre,s.parol,s.date,s.description,s.img,s.typeid,s.adminid,s.artisteid,ar.name as artistname,ar.img as artistimg from song s,artiste ar where s.artisteid=ar.id; ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
 }




 static public function addSong($data)
 {
     
         $stmt=db::connect()->prepare("insert into song (titre,parol,date,description,img,typeid,adminid,artisteid)values(:titre,:parol,:date,:description,:img,:typeid,:adminid,:artisteid)");
         $stmt->execute(array(":titre"=>$data["titre"],":parol"=>$data["parol"],":date"=>$data["date"],":description"=>$data["description"],":img"=>$data["file"],":typeid"=>$data["type"],":adminid"=>$data["admin"],":artisteid"=>$data["artist"]));
 }


 static public function updateSong($data,$exist)
 {
        if($exist=="yes")
        {
                $stmt=db::connect()->prepare("update song set titre=:titre,parol=:parol,date=:date,description=:description,img=:img,typeid=:typeid,adminid=:adminid,artisteid=:artisteid where id=:id");
                $stmt->execute(array(":titre"=>$data["titre"],":parol"=>$data["parol"],":date"=>$data["date"],":description"=>$data["description"],":img"=>$data["file"],":typeid"=>$data["type"],":adminid"=>$data["admin"],":artisteid"=>$data["artist"],":id"=>$data["id"]));
        }
        else
        {
                $stmt=db::connect()->prepare("update song set titre=:titre,parol=:parol,date=:date,description=:description,typeid=:typeid,adminid=:adminid,artisteid=:artisteid where id=:id");
                $stmt->execute(array(":titre"=>$data["titre"],":parol"=>$data["parol"],":date"=>$data["date"],":description"=>$data["description"],":typeid"=>$data["type"],":adminid"=>$data["admin"],":artisteid"=>$data["artist"],":id"=>$data["id"]));
        }
 }
 
 static public function deleteSong($id)
 {
     $stmt=db::connect()->prepare("delete from song where id=:id");
     $stmt->execute(array(":id"=>$id));
     
 }


}