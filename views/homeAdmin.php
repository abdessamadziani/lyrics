

<?php 

require_once "../models/db.php";

session_start();
if(!isset($_SESSION["name"]))
{
  header("location:./login.php");
  die;
}
$stmt=db::connect()->prepare("select count(*) as nbsongs from song ");
        $stmt->execute();
        $nbsongs=$stmt->fetchAll(PDO::FETCH_ASSOC);

        
$stmt=db::connect()->prepare("select count(*) as nbadmins from admin ");
$stmt->execute();
$nbadmins=$stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt=db::connect()->prepare("select count(*) as nbtypes from category ");
        $stmt->execute();
        $nbtypes=$stmt->fetchAll(PDO::FETCH_ASSOC);

        
$stmt=db::connect()->prepare("select count(*) as nbartists from artiste ");
$stmt->execute();
$nbartists=$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt=db::connect()->prepare("select * from artiste");
$stmt->execute();
$artists=$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt=db::connect()->prepare("select s.id,s.titre,s.parol,s.date,s.description,s.img,s.typeid,s.adminid,s.artisteid,ar.name as artistname,ar.img as artistimg,ad.name as adminname,cat.name as catname from song s,artiste ar,admin ad,category cat where s.artisteid=ar.id and s.typeid=cat.id and s.adminid=ad.id;  ");

$stmt->execute();
$songs=$stmt->fetchAll(PDO::FETCH_ASSOC);


     


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/style.css">





</head>
<body style="background-color:#DDDDDD;">

<?php include_once "./dry/navbar.php" ; ?>





<header   class=" header d-flex justify-content-center">
      
      <div class="card-items row container  ">
            <div class="card-item card-1 col-12 col-md-6  col-lg-2 px-3  ">
            <i class=" icon fas fa-music mt-0  fs-3 text-info"></i>
                <h2 class="text-capitalize   pt-1">Song</h2>
                <span class="text-Secondary fw-bold fs-3 "><?php echo $nbsongs[0]["nbsongs"] ?></span>
            </div>
            <div class="card-item card-2 col-12 col-md-6  col-lg-2 ">
            <i class=" icon fas fa-money-check-alt fs-3 text-info"></i>
                <h2 class="text-capitalize   pt-1">Artist</h2>
                <span class=" fw-bold text-Secondary fs-3"><?php echo $nbartists[0]["nbartists"] ?></span>
            </div>

            <div class="card-item card-3 col-12 col-md-6  col-lg-2 ">
            <i class=" icon fas fa-chart-line text-info fs-3"></i>
                <h2 class="text-capitalize  pt-1">Category</h2>
                <span class="text-Secondary fw-bold fs-3"><?php echo $nbtypes[0]["nbtypes"] ?></span>
            </div>

            <div class="card-item card-4 col-12 col-md-6  col-lg-2 ">
                <i class=" icon fas fa-user-alt text-info fs-3"></i>
                <h2 class="text-capitalize   pt-1">admin</h2>
                <span class=" fw-bold fs-3 text-Secondary text-uppercase"><?php echo $nbadmins[0]["nbadmins"] ?></span>
            </div>
        </div>
</header>


<div class=" w-100 m-3 ">
    <h1 class="text-center text-white">Artists</h1>
    <span class="line"></span>
</div>



<div class="container mt-5 table-responsive " >
        <table id="myTable" class="table table-dark table-striped-columns">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Date Of Creation</th>
                <th scope="col">Picture</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($artists as $ar){?>

                <?php $id=$ar["id"];?>

       

                <tr>
                <td><?php echo $ar['name'];?></td>
                <td><?php echo $ar['date'];?></td>
                <td class="table-pic"><img src="<?php echo $ar['img'];?>" alt="image"></td>
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

<div class=" w-100 m-3 ">
    <h1 class="text-center text-white">Songs</h1>
    <span class="line"></span>
</div>

<div class="container mt-5 table-responsive " >
        <table id="myTableSong" class="table table-dark table-striped-columns">
            <thead>
                <tr>
                <th scope="col">Song Title</th>
                <th scope="col">Date</th>
                <th scope="col">Category</th>
                <th scope="col">Picture</th>
                <th scope="col">Description</th>
                <th scope="col">Admin Name</th>
                <th scope="col">Artist Name</th>
                <th scope="col">Artist Picture</th>


                </tr>
            </thead>
            <tbody>
              <?php foreach($songs as $song){?>

                <?php $id=$song["id"];?>

       

                <tr>
                <td><?php echo $song['titre'];?></td>
                <td><?php echo $song['date'];?></td>
                <td><?php echo $song['catname'];?></td>
                <td class="table-pic"><img src="<?php echo $song['img'];?>" alt="images"></td>
                <td><?php echo $song['description'];?></td>
                <td><?php echo $song['adminname'];?></td>
                <td><?php echo $song['artistname'];?></td>
                <td class="table-pic"><img src="<?php echo $song['artistimg'];?>" alt="image"></td>

                </tr>
           
                <?php }?>
            </tbody>
        </table>
</div>




<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
$(document).ready( function () {
    $('#myTableSong').DataTable();
} );
</script>

<script src="https://kit.fontawesome.com/24dbd9ce21.js" crossorigin="anonymous"></script>

<script src="../js/bootstrap.bundle.js"></script>

</body>
</html>