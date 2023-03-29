<?php
include("database.php");
if(isset($_GET['id']))
     $id = $_GET['id'];
     $sql = " SELECT * FROM article Where id = $id";
     $result = $con->query($sql);
     $data = mysqli_fetch_assoc($result);


    $category_id =  $data['category_id'];
    $username = $_SESSION['user_name'];
    $useremail = $_SESSION['user_email'];
    $sql = "INSERT INTO `user_cache_data`( `user_name`, `user_email`, `category_id`) VALUES ('$username','$useremail','$category_id')";
    $res = $con->query($sql);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Page</title>
     <!-- bootsrap css cdn -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   
   <!-- fontawesome icon cdn -->
   <link rel='stylesheet' id='font-awesome-css' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=4.7.0' type='text/css' media='all' />

   <!-- custom css file -->
   <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container p-2">
        <h1 class="text-center py-3 mb-5 text-uppercase border border-bottom">Automatic Recommendation Using Php cookies</h1>
        <div class="row">
            <div class="col-md-9 mb-5 py-3">
                <h3 class="text-center py-3 text-uppercase">Articles</h3>
                <div class="row">
                    <div class = "col-md-12 mb-5">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                <img src="https://images.unsplash.com/photo-1679517946600-fe5ec65b5f96?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $data['title'];?></h5>
                                        <p class="card-text"><small class="btn-group btn-group-xs btn-success"><?php echo $data['category_id'];?></small></p>
                                        <p class="card-text"><?php echo $data['description'];?></p>
                                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                            
            <div class="col-md-3 mb-5 shadow p-2">
                <h3 class="text-center py-3 text-uppercase">Recommendation</h3>
                <div class="row">
                <?php 

                 $sql = " SELECT * FROM article INNER JOIN user_cache_data ON article.category_id = user_cache_data.category_id";
                 $result = $con->query($sql);

                 while($data = mysqli_fetch_assoc($result)){ 
                    if($data['user_email'] === $_SESSION['user_email'] ){
                    ?>
                    <div class="col-md-12 mb-4">
                        <div class="card border p-2">
                        <h5 class="card-title"><?php echo $data['title'];?></h5>
                        <p class="card-text"><?php echo $data['description'];?></p>
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                    <?php }  }?>    
                </div>
            </div>                            
        </div>
    </div>
</body>
</html>