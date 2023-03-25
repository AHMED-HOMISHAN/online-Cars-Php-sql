<?php
session_start();
error_reporting(0);
require("../controller/connection.php");
if(!isset($_COOKIE['maxwheelsu']))

{	

header('location:https://localhost/online-Cars-Php-sql-main');
}
else{
// Code for change password	
if(isset($_POST['update']))
{
$vimage=$_FILES["img6"]["name"];
$id=intval($_GET['imgid']);
move_uploaded_file($_FILES["img6"]["tmp_name"],"../image/vehicleimages/".$_FILES["img6"]["name"]);
$sql="update vechiles set Vimage6=:vimage where id=:id";
$query = $connecting->prepare($sql);
$query->bindParam(':vimage',$vimage,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

$msg="Image updated successfully";



}
?>

<!doctype html>
<html lang="en" class="no-js">
	
<?php include("includes/head.php");?>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Vehicle Image 6 </h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Vehicle Image 6 Details</div>
									<div class="panel-body">
										<form method="post" class="form-horizontal" enctype="multipart/form-data">
												<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
												else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
												<div class="form-group">
													<label class="col-sm-4 control-label">Current Image6</label>
												<?php 
												$id=intval($_GET['imgid']);
												$sql ="SELECT Vimage6 from vechiles where vechiles.id=:id";
												$query = $connecting -> prepare($sql);
												$query-> bindParam(':id', $id, PDO::PARAM_STR);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query->rowCount() > 0)
												{
											foreach($results as $result)
											{	?>

											<div class="col-sm-8">
											<img src="../image/vehicleimages/<?php echo htmlentities($result->Vimage6);?>" width="300" height="200" style="border:solid 1px #000">
											</div>
											<?php }}?>
											</div>

											<div class="form-group">
												<label class="col-sm-4 control-label">Upload New Image 6<span style="color:red">*</span></label>
												<div class="col-sm-8">
											<input type="file" name="img6" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											
										
								
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="update" type="submit">Update</button>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
							
						</div>
						
					

					</div>
				</div>
				
			
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
<?php } ?>