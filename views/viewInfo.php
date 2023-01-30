 
 

 <?php
 require_once "../models/db.php";
 session_start();
 if(!isset($_SESSION["name"]))
{
  header("location:./login.php");
  die;
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<title>Details Information</title>
</head>
<body>

<section class="mt-5">
 <?php



    if(isset($_GET["id"]))
    {
        $stmt=db::connect()->prepare("select s.id,s.titre,s.parol,s.date,s.description,s.img,s.typeid,s.adminid,s.artisteid,ar.name as artistname,ar.img as artistimg,ad.name as adminname,cat.name as catname from song s,artiste ar,admin ad,category cat where s.artisteid=ar.id and s.id=:id; ");
        $stmt->execute(array(":id"=>$_GET["id"]));
        $infos=$stmt->fetchAll(PDO::FETCH_ASSOC);
       
      
    }

echo " 
<div class='card text-center'>
<div class='card-header text-info fs-4 bg-warning'>
Details Information
</div>
<div class='card-body'>
<h4 class='card-text'><span class='text-danger'>Song Title </span> :   {$infos[0]["titre"]}</h4>
<hr>
<h4 class='card-text'><span class='text-danger'>Category </span>:  {$infos[0]["catname"]}</h4>
<hr>
<h4 class='card-text'><span class='text-danger'>Date </span>:  {$infos[0]["date"]}</h4>
<hr>
<h4 class='card-text'><span class='text-danger'>Lyrics </span>:  {$infos[0]["parol"]}</h4>
<hr>
<h4 class='card-text'><span class='text-danger'>Description</span> :  {$infos[0]["description"]} </h4>
<hr>
<h4 class='card-text'><span class='text-danger'>Admin</span> :  {$infos[0]["adminname"]} </h4>
<hr>
<h4 class='card-text'><span class='text-danger'>Artist</span> :  {$infos[0]["artistname"]}</h4>
<hr>
<h4 class='card-text'><span class='text-danger'> Song Image</span> :   <img class='rounded-circle' src='{$infos[0]["img"]}' width=100px />  </h4> 
<hr>
<h4 class='card-text'><span class='text-danger'> Artist Picture</span> :   <img class='rounded-circle' src='{$infos[0]["artistimg"]}' width=150px />  </h4> 
<hr>
</div>
<div class='card-footer  bg-dark text-white' >
we are happy to give you your details 
</div>
</div>


";










 ?>

       
    

</table>

</section>






<script src="https://kit.fontawesome.com/24dbd9ce21.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.js"></script> 

</body>
</html>