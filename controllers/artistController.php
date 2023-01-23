<?php


 require_once( __DIR__. "./../models/artist.php");
 require_once( __DIR__. "./../views/viewArtists.php");
//  require_once( __DIR__. "./../views/dry/uploadimages.php");




class ArtistController
{
    public function getAllArtists()
    {
        $artists=Artist::allArtists();
        return $artists;
    }


     public function add()
    {
        if(isset($_POST["save"]))
        {
            // echo "<pre>";
            // print_r($_FILES['file']['name']);
            // echo"</pre>";


            
            // $file=$_FILES['file'];
            // $file_name=$_FILES['file']['name'];
            // $file_tmp_name=$_FILES['file']['tmp_name'];
            // $file_type=$_FILES['file']['type'];
            // $file_error=$_FILES['file']['error'];
            // $file_size=$_FILES['file']['size'];
            
            // $file_ext=explode('.',$file_name);
            // $file_act_ext=strtolower(end($file_ext));
            // $allowed=array('jpg','png','jpeg','pdf');
            
            // if(in_array($file_act_ext,$allowed))
            // {
            //         $file_new_name=uniqid('',true).".".$file_act_ext;
            //         $file_destination="../uploads/".$file_new_name;
            //         move_uploaded_file($file_tmp_name,$file_destination);
            //         $img=$file_destination;  
            //     }
            // else
            // {
            //     echo "you can not upload files of this type !!";
            // }


            
            
            for($i=0;$i<count($_POST['name']);$i++){

                $file=$_FILES['file'];
                $file_name=$_FILES['file']['name'][$i];
                $file_tmp_name=$_FILES['file']['tmp_name'][$i];
                $file_type=$_FILES['file']['type'][$i];
                $file_error=$_FILES['file']['error'][$i];
                $file_size=$_FILES['file']['size'][$i];
                
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
                    'name'=>$_POST['name'][$i],
                    'date'=>$_POST['date'][$i],
                    'file'=>$img
                );
               Artist::addArtist($data);
            }
            
           header("location:../views/viewArtists.php");
   
        }
       
    }


    public function update()
    {
        if(isset($_POST["update"]))
        {



           $file=$_FILES['file'];
          $file_name=$_FILES['file']['name'][0];
          $file_tmp_name=$_FILES['file']['tmp_name'][0];
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
                'name'=>$_POST['name'][0],
                'date'=>$_POST['date'][0],
                'file'=>$img
            );
           Artist::updateArtist($data);
           header("location:../views/viewArtists.php");
   
        }
       
    }

    public function delete()
    {
        if(isset($_POST["id"]) && isset($_POST["delete"]))
        {
           $id=$_POST["id"];
           Artist::deleteArtist($id);
           header("location:../views/viewArtists.php");
   
        }
       
    }


}