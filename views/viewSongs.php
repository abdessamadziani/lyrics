<?php 

require_once("../controllers/songController.php");

$sng=new SongController();
$songs=$sng->getAllSongs();





$ad=new SongController();
$admins=$ad->getAllAdmins();

$tp=new SongController();
$types=$ad->getAllTypes();

$art=new SongController();
$artists=$ad->getAllArtists();

$newsong=new SongController();
$newsong->add();
$newsong->delete();
$newsong->update();
// $tt=$newsong->searchSongs();
// print_r($tt);




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Songs</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Lyrics</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav m-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Darkmode</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Home</a></li>
            <li><a class="dropdown-item" href="#">Products</a></li>
            <li><a class="dropdown-item" href="#">Artistes</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Log out</a></li>
          </ul>
        </li>
        
      </ul>
      <form  action="../controllers/songController.php" method="POST" class="d-flex ms-auto">
        <input class="form-control me-2" type="search" name="titre" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success me-4" name="search" type="submit">Search</button>

      </form>
    </div>
  </div>
</nav>

<header class="mt-4 container ">

    <button class="btn btn-info d-block ms-auto text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Add new Song</button>
</header>













<?php


echo " <section>
<div class='row  m-auto container mt-3'>";
foreach($songs as $song)
{
 


  
  $id=$song['id'];
  // $titre=$song['titre'];
  //  $type=$song['typeid'];
  //  $price=$song['description'];
  //  $quantite=$song['adminid'];
  //  $description=$song['artistid'];
  //  $lyrics=$song['lyrics'];
  //  $img=$song['img'];


   echo"


   <div class='col-sm-12 col-md-6  col-lg-4 mb-3 ' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick=showDataSong($id)>
   <div class='card'>




       <div style='border-radius:50%; background-color:gold;'>
          <img style=' display:block;width:30%;order-radius:50% ;margin:auto' src='{$song["artistimg"]}'  class=' card-img-top  ' alt='...'>
       </div>
  
       <img   src='{$song["img"]}'  class='card-img-top ' alt='...'>
       <div class='card-body'>
           <h5 class='card-title text-truncate'title=''>{$song["titre"]}</h5>
           <p class='card-text'>{$song["description"]}</p>
           <a href='./viewInfo.php?id=$id' class='btn d-block btn-outline-warning me-4'>Check Details</a>

           </div>
       </div>
   </div>


   <div class='d-none'>
   <h6 id='id$id' data='{$song["id"]}' ></h6>
   <h6 id='titre$id'  data='{$song["titre"]}'></h6>
   <h6 id='admin$id' data='{$song["adminid"]}'></h6>
   <h6 id='artist$id' data='{$song["artisteid"]}'></h6>
   <h6 id='type$id' data='{$song["typeid"]}'></h6>
   <h6 id='lyrics$id' data='{$song["parol"]}'></h6>
   <h6 id='img$id' data='{$song["img"]}'></h6>
   <h6 id='date$id' data='{$song["date"]}'></h6>
   <h6 id='description$id'   data='{$song["description"]}'></h6>



   </div>


    ";



}
echo "</div>     </section> ";

?>




<!-- Button trigger modal -->



<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="../controllers/songController.php" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
  <input type="text"   class="form-control" id="id" name="id" >
    <label class="form-label">Title</label>
    <input type="text" class="form-control"   id="titre" name="titre">
  </div>
  <div class="mb-3">
    <label class="form-label">Category</label>
    <select id="type"  name="type" class="form-select" aria-label="Default select example">
    <?php 
        foreach($types as $type)
        {
            echo "<option value='{$type["id"]}'>{$type['name']}</option>";
        }

 ?>
</select>
  </div>
  <div class="mb-3">
    <label  class="form-label">Image</label>
    <input type="file"  class="form-control"  id="file" name="file" >
  </div>
  <div class="mb-3">
    <label  class="form-label">Date</label>
    <input type="date" class="form-control" id="date" name="date" required >

  </div>
  <div class="mb-3">
    <label  class="form-label">Lyrics</label>
    <textarea class="form-control" rows="4"  name="lyrics"  id="lyrics" required ></textarea>

  </div>

  <div class="mb-3">
    <label  class="form-label">Artiste</label>
    <select class="form-select" id="artist" name="artist" aria-label="Default select example">;
    <?php 
        foreach($artists as $artist)
        {
          
            echo "<option value='{$artist["id"]}'>{$artist['name']}</option>";
        }

 ?>
    </select>
  </div>
  <div class="mb-3">
    <label  class="form-label">Admin</label>
    <select class="form-select" id="admin" name="admin" aria-label="Default select example">;
 <?php 
        foreach($admins as $admin)
        {
          
            echo "<option value='{$admin["id"]}'>{$admin['name']}</option>";
        }

 ?>


    </select>
  </div>
  <div class="mb-3">
    <label  class="form-label">Description</label>
    <textarea class="form-control" rows="4"  name="description"  id="description" required ></textarea>
  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-success " name="save" id="save">Save</button>
        <button type="submit" class="btn btn-primary " name="update" id="update">Update</button>
        <button type="submit" class="btn btn-danger " name="delete" id="delete">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div>
</div>







    
<script src="../js/bootstrap.bundle.js"></script>
 <!-- <script src="../js/main.js"></script> -->

 <script>
  function showDataSong(id)
  {

    document.getElementById("id").value=document.getElementById("id"+id).getAttribute("data")
    document.getElementById("titre").value=document.getElementById("titre"+id).getAttribute("data");
    document.getElementById("type").value=document.getElementById("type"+id).getAttribute("data");
    // document.getElementById("file").value=document.getElementById("img"+id).getAttribute("data");
    document.getElementById("date").value=document.getElementById("date"+id).getAttribute("data");
    document.getElementById("lyrics").value=document.getElementById("lyrics"+id).getAttribute("data");
    document.getElementById("artist").value=document.getElementById("artist"+id).getAttribute("data");
    document.getElementById("admin").value=document.getElementById("admin"+id).getAttribute("data");
    document.getElementById("description").value=document.getElementById("description"+id).getAttribute("data");


  }
</script>
</body>
</html>