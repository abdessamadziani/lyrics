<?php


  require_once( __DIR__. "./../models/login.php");
   require_once( __DIR__. "./../views/login.php");


   //validation sign in
// if(isset($_POST['signin']))
// {
//     if (empty($_POST['email']) && empty($_POST['password']))
//     {
//         header('Location:../views/login.php?error=Email and Password both are empty !!');
//         exit();
//     }
//     else if(empty($_POST['email']))
//     {
//         header('Location:../views/login.php?error=Email is empty !!');
//         exit();
//     }
//     else if(empty($_POST['password']))
//     {
//         header('Location:../views/login.php?error=Password is empty !!');
//         exit();
//     }
// }

class LoginController
{

    public function check()
    {
      if (isset($_POST["signin"]))
      {

      

        if (empty($_POST['email']) && empty($_POST['password']))
        {
            header('Location:../views/login.php?error=Email and Password both are empty !!');
            exit();
        }
        else if(empty($_POST['email']))
        {
            header('Location:../views/login.php?error=Email is empty !!');
            exit();
        }
        else if(empty($_POST['password']))
        {
            header('Location:../views/login.php?error=Password is empty !!');
            exit();
        }

        echo "checking";
        $data=array(
          'email'=>$_POST["email"],
          'password'=>$_POST["password"]
        );
          $res=Login::checklogin($data);

          // if(isset($_POST['check']))
          // {
          //   setcookie('email_cookie',$_POST['email'],time()+60*60,'/');
          //   setcookie('password_cookie',$_POST['password'],time()+60*60,'/');
          // }
          if($res=="ok")
        header("location:../views/viewArtists.php");
        else
        echo "error";

    
      }
    }





}