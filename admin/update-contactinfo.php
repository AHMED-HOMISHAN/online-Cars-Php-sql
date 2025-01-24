<?php
	session_start();
	error_reporting(0);
	require("../controller/connection.php");
	if(!isset($_COOKIE['maxwheelsu']))
	{
		header('location:http://localhost:1234/cars/');
	}
	else{
	// Code for change password	
		if(isset($_POST['submit']))
		{
			$address=$_POST['address'];
			$email=$_POST['email'];	
			$numberPhone=$_POST['numberPhone'];
			$sql="update tblcontactusinfo set Address=:address,Email=:email,numberPhone=:numberPhone";
			$query = $connecting->prepare($sql);
			$query->bindParam(':address',$address,PDO::PARAM_STR);
			$query->bindParam(':email',$email,PDO::PARAM_STR);
			$query->bindParam(':numberPhone',$numberPhone,PDO::PARAM_STR);
			$query->execute();
			$msg="Info Updateed successfully";
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
							<h2 class="page-title">Update Contact Info</h2>
							<div class="row">
								<div class="col-md-10">
									<div class="panel panel-default">
										<div class="panel-heading">Form fields</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
											<?php if($error){?>
												<div class="errorWrap">
													<strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
												else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
												<?php $sql = "SELECT * from  tblcontactusinfo ";
													$query = $connecting -> prepare($sql);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$cnt=1;
													if($query->rowCount() > 0)
													{
														foreach($results as $result)
														{				
											?>	
											<div class="form-group">
												<label class="col-sm-4 control-label"> Address</label>
													<div class="col-sm-8">
														<textarea class="form-control" name="address" id="address" required><?php echo htmlentities($result->Address);?></textarea>
													</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Email id</label>
												<div class="col-sm-8">
													<input type="email" class="form-control" name="email" id="email" value="<?php echo htmlentities($result->Email);?>" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-4 control-label"> Contact Number </label>
												<div class="col-sm-8">
													<input type="text" class="form-control" value="<?php echo htmlentities($result->numberPhone);?>" name="numberPhone" id="numberPhone" required>
												</div>
											</div>
											<?php }} ?>
												<div class="hr-dashed"></div>
												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-4">
														<button class="btn btn-primary" name="submit" type="submit">Update</button>
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