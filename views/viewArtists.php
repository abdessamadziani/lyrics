
<?php

require_once("../controllers/artistController.php");
require_once("dry/uploadimages.php");



$data=new ArtistController();
$newartiste=new ArtistController();
$rr=new ArtistController();
$xx=new ArtistController();
$artists=$data->getAllArtists();



$newartiste->add();
$rr->delete();
$xx->update();

// print_r($artists);


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <title>Artists</title>
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
      <form class="d-flex ms-auto">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success me-4" type="submit">Search</button>

      </form>
    </div>
  </div>
</nav>

<header class="mt-4 container ">
    <button class="btn btn-info d-block ms-auto text-white" data-bs-toggle="modal" data-bs-target="#exampleModal2" id="addNewArtist">Add new Artiste</button>
</header>

<section >
    <div class="container mt-5 table-responsive">
        <table class="table table-dark table-striped-columns">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Date Of Creation</th>
                <th scope="col">Picture</th>
                <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($artists as $ar){?>

                <?php $id=$ar["id"];?>

       

                <tr>
                <td><?php echo $ar['name'];?></td>
                <td><?php echo $ar['date'];?></td>
                <td class="table-pic"><img src="<?php echo $ar['img'];?>" alt="image"></td>
                <td class="d-flex gap-3 justify-content-center" scope="col">
                
                   <button class="btn btn-warning" name="edit" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick=showData(<?php echo $id ;?>)>Edit</button> 
                   <form action="../controllers/artistController.php" method="POST" >
                        <input type="hidden" name="id" value="<?php echo $ar['id'];  ?>">
                        <button class="btn btn-danger" name="delete">delete</button>
                    </form>
                 </td>
                </tr>
                <div class='d-none'>
                    <h6 id='id<?php echo $id;?>'   data="<?php echo $ar["id"] ;?>" ></h6>
                    <h6 id='name<?php echo $id;?>'   data= "<?php echo $ar["name"];?>" ></h6>
                    <h6 id='date<?php echo $id;?>'   data="<?php echo $ar["date"] ;?>"></h6>
                    <h6 id='img<?php echo $id;?>'    data="<?php echo $ar["img"] ;?> "></h6>
                </div>
                <?php }?>
            </tbody>
        </table>
    </div>




</section>







<!-- Button trigger modal -->


<!-- Modal -->

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../controllers/artistController.php" method="POST" id="formArtist" enctype="multipart/form-data"  >

      <div class="modal-body" id="body-modal">
  <div class="mb-3">
  <input type="text" hidden  class="form-control" id="id" name="id" >
    <label class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name[]"  >
  </div>
  <div class="mb-3">
    <label  class="form-label">Date</label>
    <input type="date" class="form-control" id="date" name="date[]" >
  </div>
  <div class="mb-3">
    <label  class="form-label">Image</label>
    <input type="file"  class="form-control"  id="file" name="file[]" >
  </div>
    
    </div>
    <div class="newdiv">

    </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success px-4 " name="save" id="save">Save</button>
        <button type="submit" class="btn btn-success px-4 " name="update" id="update">Update</button>

        <span class=" bg-info text-white fw-bolder fs-4 rounded px-3 py-2  " name="plus" id="plus">+</span>

        </div>
              </form>

  </div>
</div>
<div>
</div>
    
<script src="../js/bootstrap.bundle.js"></script>
<script>
const form=document.getElementById("formArtist")
const name=document.getElementById("name")
const date=document.getElementById("date")
const image=document.getElementById("file")




form.addEventListener("submit",e =>
{
  if(!validateForm())
     e.preventDefault()
    
    //  console.log(validateForm())


})

function validateForm()
{
    let check=true
    if(name.value.trim()=='')
    {
        setError(name,'name can not be empty')
        check=false 

    }
    else if(name.value.trim().length<5 || name.value.trim().length>15 )
    {
        setError(name,'name must be between 5 and 15 characters')
        check=false 


    }
    else
          {setSuccess(name)
          check= true
           }
    if(date.value.trim()=='' || date.value.trim()=='jj/mm/aaaa')
          {
            setError(date,'date can not be empty')
            check=false 
          }

    if(image.value.trim()=='')
          {
            setError(image,'image can not be empty')
            check=false 
          }
 
    else
    {
      setSuccess(date)
      setSuccess(image)
      check=true 
    }
    return check
       
    


}

function setError(element,errorMessage)
{

     const parent=element.parentElement
    if(parent.classList.contains('success'))
    parent.classList.remove('success')
    parent.classList.add('error')
    // const para=parent.querySelector('p')
    // para.innerText=errorMessage;
    // para.style.visibility='visible'
    
}
function setSuccess(element)
{
    const parent=element.parentElement
    if(parent.classList.contains('error'))
    {
        parent.classList.remove('error')
        // parent.querySelector('p').style.visibility='hidden'
    }
      
    parent.classList.add('success')
    
}

</script>
<script src="../js/main.js"></script>
</body>
</html>