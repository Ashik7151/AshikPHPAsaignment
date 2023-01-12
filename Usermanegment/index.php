<!-- php connection code -->
<?php
   $db = mysqli_connect('localhost','root','','user_manegment');
   if($db){
   	// echo 'data connection established,';
   }else{
   	echo 'data connection error,';
   }
?>
<!-- inset code -->
<?php 

	$error_msg = '';

	if(isset($_POST['saveinfo'])){
		$name 		= $_POST['username'];
		$email 		= $_POST['email'];
		$pass 		= $_POST['password'];

		$upass = sha1($pass);

		$sql2 = "INSERT INTO users(name,email,pass) VALUES ('$name', '$email', '$upass')";
		$res2 = mysqli_query($db,$sql2);

		if($res2){
			header('Location: index.php');
		}else{
			//echo 'value insert error!';
		}		
	}
?>

<!-- delete code -->
<?php 

	if(isset($_GET['id'])){
		$del_id = $_GET['id'];

		$sql3 = "DELETE FROM users WHERE id='$del_id'";
		$res3 = mysqli_query($db,$sql3);

		if($res3){
			header('Location: index.php');
		}else{
			echo 'delete error!';
		}
	}
?>

<!-- update code -->
<?php 

	if(isset($_POST['updateinfo'])){
		$name = $_POST['username'];
		$email = $_POST['email'];
		$pass = $_POST['password'];
		$role = $_POST['role'];
		$status = $_POST['status'];
		$id = $_POST['editid'];

		if(!empty($pass)){
			$pass = sha1($pass);
			$sql4 = "UPDATE users SET name='$name', email='$email', pass='$pass', role='$role', status='$status' WHERE id='$id'";
		}
		if(empty($pass)){
			$sql4 = "UPDATE users SET name='$name', email='$email', role='$role', status='$status' WHERE id='$id'";
		}
		$res4 = mysqli_query($db,$sql4);

		if($res4){
			header('Location: index.php');
		}else{
			echo 'edit error!';
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Manegement</title>
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="overflow-hidden">

	<div class="users m-4">
		<div class="row g-0">
			<div class="col-md-4">
				<h3>Add A New User</h3>
				<form class="my-5" method="POST">
			    <div class="mb-3">
                <label for="Username" class="form-label">User Name</label>
                <input type="text" name="username" class="form-control" id="Username" placeholder="Name@">
                <?php 
				   echo '<small class="text-danger">'.$error_msg.'</small>';
				?>
                </div>
				<div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Name@gmail.com">
                </div>
                <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="Password" name="password" class="form-control" id="Password" placeholder="Password@example">
                <small class="text-danger">Password should be 8 charecter</small>
                </div>
                <input type="Submit" name="saveinfo" class="btn btn-md btn-info" value="Add New User" name="">
				</form>

			</div>
			<div class="col-md-8">
				<h3 class="ms-5">All User Information</h3>
			<table class="table m-5 table-striped">
                   <thead>
                     <tr>
                       <th scope="col">#</th>
                       <th scope="col">Name</th>
                       <th scope="col">Email</th>
                       <th scope="col">UserRole</th>
                       <th scope="col">Status</th>
                       <th scope="col">Action</th>
                     </tr>
                   </thead>
                   <tbody>
                     

                     <?php 
                          
                       $sql = "select * from users";
                       $res = mysqli_query($db,$sql);

                       $serial = 0;

                      while($row = mysqli_fetch_assoc($res)){
                                $ID     = $row['ID'];
                                $name   = $row['name'];
                                $email  = $row['email'];
                                $pass   = $row['pass'];
                                $role   = $row['role'];
                                $status = $row['status'];
                                $serial++;     
     
                       ?>
                       <tr>
                       <th scope="row"><?php echo $serial;?></th>
                       <td><?php echo $name;?></td>
                       <td><?php echo $email;?></td>
                       <td><?php echo $role;?></td>
                       <td><?php echo $status;?></td>
                       <td>
                       	<a href="" class="badge bg-success">Eidt</a>
                       	<a href="" class="badge bg-danger">Delate</a>
                       </td>
                     </tr>
                     <?php
                      }
                     ?>
                     
                       
                  </tbody>
                </table>
				
			</div>
		</div>
	</div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jj Xkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>