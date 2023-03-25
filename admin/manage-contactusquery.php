<?php
session_start();
error_reporting(0);
require("../controller/connection.php");
if(!isset($_COOKIE['maxwheelsu']))

{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
{
$eid=intval($_GET['eid']);
$status=1;
$sql = "UPDATE contentus SET status=:status  WHERE  id=:eid";
$query = $connecting->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Testimonial Successfully Inacrive";
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

<h2 class="page-title">Manage Contact Us</h2>

<!-- Zero Configuration Table -->
<div class="panel panel-default">
<div class="panel-heading">User queries</div>
<div class="panel-body">
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
		<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>Contact No</th>
			<th>Message</th>
			<th>Posting date</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

	<?php $sql = "SELECT * FROM  contentus ORDER BY id DESC;";
$query = $connecting -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
		<tr>
			<td><?php echo htmlentities($cnt);?></td>
			<td><?php echo htmlentities($result->username);?></td>
			<td><?php echo htmlentities($result->email);?></td>
			<td><?php echo htmlentities($result->subject);?></td>
			<td><?php echo htmlentities($result->message);?></td>
			<td><?php echo htmlentities($result->PostingDate);?></td>
			<?php if($result->status==1)
{
?><td>Read</td>
<?php } else {?>

<td><a href="mailto:<?php echo htmlentities($result->email);?>" onclick="return confirm('Do you really want to reply...?')" >reply</a>
</td>
<?php } ?>
		</tr>
		<?php $cnt=$cnt+1; }} ?>
		
	</tbody>
</table>



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
