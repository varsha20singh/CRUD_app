<?php
  $update=false;
  $insert=false;
  $delete=false;

  $servername="localhost";
  $username="root";
  $password="";
  $database="notes";

  $conn=mysqli_connect($servername,$username,$password,$database);
  if(!$conn){
    die("Sorry! failed to connect due to this-->".mysqli_connect_error());
  }

  if(isset($_GET['delete'])){
    $sno=$_GET['delete'];
    
    $sql="DELETE FROM `note` WHERE `sno`='$sno'";
    mysqli_query($conn,$sql);
    $delete=true;
  }
  if($_SERVER['REQUEST_METHOD']=="POST"){

    if(isset($_POST['snoEdit'])){
      //update
      $sno=$_POST['snoEdit'];
      $title=$_POST['titleEdit'];
      $description=$_POST['descriptionEdit'];

      $sql="UPDATE `note` SET `title`='$title' , `description`='$description' WHERE `note`.`sno`=$sno";
      $result=mysqli_query($conn,$sql);
      if($result){
        $update=true;
      }else{
        echo "Failed to update";
      }
    }
    else{
      $title=$_POST['title'];
      $description=$_POST['description'];

      $sql="INSERT INTO `note` (`title`,`description`) VALUES ('$title','$description')";
      $result=mysqli_query($conn,$sql);
      if($result){
        echo "Record added successfully";
      }else{
        echo "Sorry ! failed to add your notes";
      }
   }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js" 
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <title>Project-1 php_crud</title>
  </head>
  <body>

  <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action="/crudapp/index.php" method="post">
        <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="form-group">
            <label for="title">Note Title</label>
            <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
        </div>
        <div class="modal-footer d-block mr-auto">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>

      </div>
      
    </div>
  </div>
</div>

<?php
  if($update){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulations!</strong> Record updated successfuly.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> ';
  }

  if($delete){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulations!</strong> Record deleted successfuly.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> ';
  }

  if($insert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulations!</strong> Record inserted successfuly.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> ';
  }
?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="/crudapp/logo.png" height="25px" alt="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
      </li>
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<div class="container my-4">
    <form action="/crudapp/index.php" method="post">
        <h2>Add a Note</h2>
        <div class="form-group">
            <label for="title">Note Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
</div>

<div class="container my-4" >
  
<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

  <?php 
    $sql="SELECT * FROM `note`";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num>0){
      $sno=0;
      while($row=mysqli_fetch_assoc($result)){
        $sno=$sno+1;
        echo 
        "<tr>
        <th scope='row'>".$sno."</th>
        <td>".$row['title']."</td>
        <td>".$row['description']."</td>
        <td>  <button type='button' class=' edit btn btn-primary btn-sm' id=".$row['sno'].">Edit</button> 
        <button type='button' class=' delete btn btn-primary btn-sm' id=d".$row['sno'].">Delete</button>  </td>
       </tr>" ;
        
      }
      
    }
   
  ?>
    
  </tbody>
</table>
</div>
<hr>
<script>
  let table = new DataTable('#myTable');
</script>
<script>
  edits=document.getElementsByClassName('edit');
  Array.from(edits).forEach(element => {
    element.addEventListener("click",(e)=>{
      console.log('edit');
      tr=e.target.parentNode.parentNode;
      title=tr.getElementsByTagName("td")[0].innerText;
      description=tr.getElementsByTagName("td")[1].innerText;
      console.log(title,description);
      titleEdit.value=title;
      descriptionEdit.value=description;
      snoEdit.value=e.target.id;
      console.log(e.target.id);
      $('#editModal').modal('toggle');
    })
  });


  deletes=document.getElementsByClassName('delete');
  Array.from(deletes).forEach(element => {
    element.addEventListener("click",(e)=>{
      if(confirm("Are you sure to delete this note!")){
        sno=e.target.id.substr(1,);
        window.location=`/crudapp/index.php?delete=${sno}`;
      }else{
        console.log("No");
      }
    })
  });
</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>