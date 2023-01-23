
<?php
  
 require_once( __DIR__. "./../models/song.php");
 require_once( __DIR__. "./../views/viewSongs.php");

class SongController
{


    public function getAllAdmins()
    {
        $admins=Song::allAdmins();
        return $admins;
    }

    public function getAllTypes()
    {
        $types=Song::allTypes();
        return $types;
    }

    public function getAllArtists()
    {
        $artists=Song::allArtists();
        return $artists;
    }

    public  function getAllSongs()
    {
        $songs=Song::allSongs();
        return $songs;

    }

    public  function searchSongs()
    {

        if(isset($_POST["search"]))
        {
            $titre=$_POST["titre"];
            $songs=Song::allSearchSongs($titre);
            return $songs;
        }
    

    }

   
    public function add()
    {
        if(isset($_POST["save"]))
        {

            $file=$_FILES['file'];
            $file_name=$_FILES['file']['name'];
            $file_tmp_name=$_FILES['file']['tmp_name'];
            $file_type=$_FILES['file']['type'];
            $file_error=$_FILES['file']['error'];
            $file_size=$_FILES['file']['size'];
            
            $file_ext=explode('.',$file_name);
            $file_act_ext=strtolower(end($file_ext));
            $allowed=array('jpg','png','jpeg','pdf');
            
            if(in_array($file_act_ext,$allowed))
            {
                    $file_new_name=uniqid('',true).".".$file_act_ext;
                    $file_destination="../uploads/".$file_new_name;
                    move_uploaded_file($file_tmp_name,$file_destination);
                    $img=$file_destination;  
                }
            else
            {
                echo "you can not upload files of this type !!";
            }

            $data=array(
                'titre'=>$_POST['titre'],
                'parol'=>$_POST['lyrics'],
                'date'=>$_POST['date'],
                'file'=>$img,
                'description'=>$_POST['description'],
                'admin'=>$_POST['admin'],
                'type'=>$_POST['type'],
                'artist'=>$_POST['artist'],

            );
            Song::addSong($data);
            header("location:../views/viewSongs.php");

        }
        

    }



    public function update()
    {
        if(isset($_POST["update"]))
        {



           $file=$_FILES['file'];
          $file_name=$_FILES['file']['name'];
          $file_tmp_name=$_FILES['file']['tmp_name'];
          $file_type=$_FILES['file']['type'];
          $file_error=$_FILES['file']['error'];
          $file_size=$_FILES['file']['size'];
          
          $file_ext=explode('.',$file_name);
          $file_act_ext=strtolower(end($file_ext));
          $allowed=array('jpg','png','jpeg','pdf');
          
          if(in_array($file_act_ext,$allowed))
          {
                  $file_new_name=uniqid('',true).".".$file_act_ext;
                  $file_destination="../uploads/".$file_new_name;
                  move_uploaded_file($file_tmp_name,$file_destination);
                  $img=$file_destination;  
              }
          else
          {
              echo "you can not upload files of this type !!";
          }
          


            $data=array(

                'id'=>$_POST['id'],
                'titre'=>$_POST['titre'],
                'parol'=>$_POST['lyrics'],
                'date'=>$_POST['date'],
                'description'=>$_POST['description'],
                'file'=>$img,
                'type'=>$_POST['type'],
                'admin'=>$_POST['admin'],
                'artist'=>$_POST['artist']


        
                
            );
           Song::updateSong($data);
           header("location:../views/viewSongs.php");
   
        }
       
    }


    public  function delete()
    {
      if(isset ($_POST["delete"]))
      {
        $id=$_POST["id"];
      
        $songs=Song::deleteSong($id);
        header("location:../views/viewSongs.php");
      }

    }



   

}





?>