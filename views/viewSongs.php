<?php 

require_once("../controllers/songController.php");
session_start();
if(!isset($_SESSION["name"]))
{
  header("location:./login.php");
  die;
}


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
    <link rel="stylesheet" href="../css/style.css">



    <title>Songs</title>
</head>
<body style="background-color:#DDDDDD;">
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Lyrics</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav m-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="homeAdmin.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Darkmode</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="homeAdmin.php">Home</a></li>
            <li><a class="dropdown-item" href="#">Products</a></li>
            <li><a class="dropdown-item" href="viewArtists.php">Artistes</a></li>
            <li><a class="dropdown-item" href="viewSongs.php">Songs</a></li>

            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="login.php">Log out</a></li>
          </ul>
        </li>
        
      </ul>
      <form  action="../controllers/songController.php" method="POST" class="d-flex ms-auto">
        <input class="form-control me-2" type="search" name="titre" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success me-4" name="search" type="submit">Search</button>

      </form>
    </div>
  </div>
</nav> -->
<?php include_once "./dry/navbar.php" ; ?>

<header class="mt-4 container">
    <button style="background-color: #355764 !important;" class="btn d-block ms-auto text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" id="add">Add new Song</button>
</header>













<?php


echo " <section>
<div class='row  m-auto container mt-5 mb-3'>";
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


   <div class='col-sm-12 col-md-6  col-lg-4 mb-3' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick=showDataSong($id)>
   <div style='background-color:#B7B78A !important; height:600px' class='card m-2'>




       <div style='border-radius:50%; height:100px; background-color:#FCF8E8;'>
          <img style=' display:block;width:30%;height:100%;border-radius:50% ;margin:auto' src='{$song["artistimg"]}'  class=' card-img-top  ' alt='...'>
       </div>
      <div style='height:300px !important'>
       <img  style='height:100%' src='{$song["img"]}'  class='card-img-top w-100 ' alt='...' >
       </div>
       <div class='card-body'>
           <h5 class='card-title text-truncate text-white 'title=''>{$song["titre"]}</h5>
           <p class='card-text text-white text-truncate'>{$song["description"]}</p>
           <a href='./viewInfo.php?id=$id' class='btn d-block btn-outline-warning me-4 mt-2'>Check Details</a>

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
      <form action="../controllers/songController.php" method="POST" enctype="multipart/form-data" id="formSong">
  <div class="mb-3">
  <input type="text"  hidden class="form-control" id="id" name="id" >
    <label class="form-label">Title</label>
    <input type="text" class="form-control"   id="titre" name="titre">
    <p></p>
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
    <p></p>
  </div>
  <div class="mb-3">
    <label  class="form-label">Date</label>
    <input type="date" class="form-control" id="date" name="date"  >
    <p></p>

  </div>
  <div class="mb-3">
    <label  class="form-label">Lyrics</label>
    <textarea class="form-control" rows="4"  name="lyrics"  id="lyrics" ></textarea>
    <p></p>

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
    <textarea class="form-control" rows="4"  name="description"  id="description" ></textarea>
    <p></p>
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


<script>
let form=document.getElementById("formSong")
let titre=document.getElementById("titre")
let date=document.getElementById("date")
let image=document.getElementById("filesng")
let lyrics=document.getElementById("lyrics")
let description=document.getElementById("description")





form.addEventListener("submit",e =>
{
  if(!validateForm())
     e.preventDefault()
    
      console.log(validateForm())


})

function validateForm()
{
    let checkTitle
    let checkDate
    let checkImage
    let checkLyrics
    let checkDescription
    if(titre.value.trim()=='')
    {
        setError(titre,'title can not be empty')
        checkTitle=false 

    }
    else if(titre.value.trim().length<5 || titre.value.trim().length>15 )
    {
        setError(titre,'title must be between 5 and 15 characters')
        checkTitle=false 


    }
    else
          {setSuccess(titre)
            checkTitle=true
           }
    if(date.value.trim()=='' || date.value.trim()=='jj/mm/aaaa')
          {
            setError(date,'date can not be empty')
            checkDate=false 
          }
    else
    {
      setSuccess(date)
      checkDate=true

    }

    // if(image.value.trim()=='')
    //       {
    //         setError(image,'image can not be empty')
    //         checkImage=false 
    //       }
 
    // else
    // {
    //   setSuccess(image)
    //   checkImage=true 
    // }
    if(lyrics.value.trim()=='')
          {
            setError(lyrics,'lyrics can not be empty')
            checkLyrics=false
          }
 
    else
    {
      setSuccess(lyrics)
      checkLyrics=true
    }
    if(description.value.trim()=='')
          {
            setError(description,'description can not be empty')
            checkDescription=false
          }
 
    else
    {
      setSuccess(description)
      checkDescription=true
    }
    
    if(checkTitle && checkDate && checkLyrics && checkDate)
       return true
    else
       return false
       
    


}

function setError(element,errorMessage)
{

     const parent=element.parentElement
    if(parent.classList.contains('success'))
    parent.classList.remove('success')
    parent.classList.add('error')
    const para=parent.querySelector('p')
    para.innerText=errorMessage;
    para.style.visibility='visible'
    para.style.color="red"
    
}
function setSuccess(element)
{
    const parent=element.parentElement
    if(parent.classList.contains('error'))
    {
        parent.classList.remove('error')
        parent.querySelector('p').style.visibility='hidden'
    }
      
    parent.classList.add('success')
    
}

</script>

 <script>
  function showDataSong(id)
  {

    document.getElementById("save").style.display="none"
    document.getElementById("update").style.display="block";
    document.getElementById("delete").style.display="block";
    document.getElementById("id").value=document.getElementById("id"+id).getAttribute("data")
    document.getElementById("titre").value=document.getElementById("titre"+id).getAttribute("data");
    document.getElementById("type").value=document.getElementById("type"+id).getAttribute("data");
    document.getElementById("date").value=document.getElementById("date"+id).getAttribute("data");
    document.getElementById("lyrics").value=document.getElementById("lyrics"+id).getAttribute("data");
    document.getElementById("artist").value=document.getElementById("artist"+id).getAttribute("data");
    document.getElementById("admin").value=document.getElementById("admin"+id).getAttribute("data");
    document.getElementById("description").value=document.getElementById("description"+id).getAttribute("data");


  }

  
document.getElementById("add").onclick=function()
{
    document.getElementById("update").style.display="none";
    document.getElementById("delete").style.display="none";
    document.getElementById("formSong").reset()

}
</script>

</body>
</html>