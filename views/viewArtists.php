
<?php

session_start();
require_once("../controllers/artistController.php");
require_once("dry/uploadimages.php");

if(!isset($_SESSION["name"]))
{
  header("location:./login.php");
  die;
}

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
<body style="background-color:#DDDDDD;">

<?php include_once "./dry/navbar.php" ; ?>

<header class="mt-4 container ">
    <button style="background-color: #355764 !important;" class="btn  d-block ms-auto text-white" data-bs-toggle="modal" data-bs-target="#exampleModal2" id="addNewArtist">Add new Artiste</button>
</header>

<section >
    <div class="container mt-5 table-responsive">
        <table  class="table thead-light table-dark table-striped-columns ">
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
                <td  style='height:70px' class="table-pic"><img style='height:100%' src="<?php echo $ar['img'];?>" alt="image"></td>
                <td class="d-flex gap-3 justify-content-center" scope="col">
                
                   <button class="btn btn-warning p-3" name="edit" data-bs-toggle="modal" data-bs-target="#exampleModal2" onclick=showData(<?php echo $id ;?>)>Edit</button> 
                   <form action="../controllers/artistController.php" method="POST" >
                        <input type="hidden" name="id" value="<?php echo $ar['id'];  ?>">
                        <button class="btn btn-danger p-3" name="delete">delete</button>
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
    <p></p>
  </div>
  <div class="mb-3">
    <label  class="form-label">Date</label>
    <input type="date" class="form-control" id="date" name="date[]" >
    <p></p>
  </div>
  <div class="mb-3">
    <label  class="form-label">Image</label>
    <input type="file"  class="form-control"  id="file" name="file[]" >
    <p></p>
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
    
      console.log(validateForm())


})

function validateForm()
{
    let checkName
    let checkDate
    let checkImage
    if(name.value.trim()=='')
    {
        setError(name,'name can not be empty')
        checkName=false 

    }
    else if(name.value.trim().length<5 || name.value.trim().length>15 )
    {
        setError(name,'name must be between 5 and 15 characters')
        checkName=false 


    }
    else
          {setSuccess(name)
            checkName=true
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

    if(image.value.trim()=='')
          {
            setError(image,'image can not be empty')
            checkImage=false 
          }
 
    else
    {
      setSuccess(image)
      checkImage=true
    }

    if(checkName && checkDate)
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
<script src="../js/main.js"></script>
</body>
</html>