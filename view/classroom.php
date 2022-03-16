<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<?php include_once('head.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('sidebar.php'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Classroom</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Classroom</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<!-- left column -->
				<div class="col-md-6">
					<!-- general form elements -->
					<div class="card card-outline card-primary">
						<div class="card-header">
							<h3 class="card-title">Add Classroom</h3>
						</div>
						<!-- /.card-header -->
						<!-- form start -->
						<form role="form" action="../index.php" method="POST" autocomplete="off">
							<div class="card-body">
								<div class="form-group" id="divName">
									<label for="name">Name</label>
									<input type="text" class="form-control" placeholder="Enter classroom name" name="name" id="name">
								</div>
								<div class="form-group" id="divStudentCount">
									<label for="student_count">Student Count</label>
									<input type="text" class="form-control" placeholder="Enter student count" name="student_count" id="student_count">
								</div>
							</div>
							<!-- /.card-body -->

							<div class="card-footer">
								<input type="hidden" name="do" value="add_classroom">
								<button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row" id="table1">
				<div class="col-8">
					<div class="card card-outline card-primary">
						<div class="card-header">
							<h3 class="card-title">All Classroom</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="dTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width: 10%">ID</th>
										<th style="width: 30%">Name</th>
										<th style="width: 30%">Student Count</th>
										<th style="width: 30%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include_once('../controller/config.php');

									$sql = "SELECT * FROM classroom";
									$result = mysqli_query($conn, $sql);
									$count = 0;
									if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_assoc($result)) {
											$count++;

									?>
											<tr>
												<td><?php echo $count; ?></td>
												<td id="td1_<?php echo $row['id']; ?>"><?php echo $row['name']; ?></td>
												<td id="td2_<?php echo $row['id']; ?>"><?php echo $row['student_count']; ?></td>
												<td>
													<a href="#modalUpdateForm" onClick="updateRecord(this);" class="btn btn-primary btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">Edit</a>
													<a href="#" onClick="deleteRecord(this);" class="btn btn-danger btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">Delete</a>
												</td>
											</tr>
									<?php }
									} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<div class="modal fade" id="modalUpdateForm" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title">Edit Classroom</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group" id="divNameUpdate">
						<label for="name1">Name</label>
						<input type="text" class="form-control" placeholder="Enter classroom name" id="name1">
					</div>
					<div class="form-group" id="divSCountUpdate">
						<label for="student_count1">Student Count</label>
						<input type="text" class="form-control" placeholder="Enter student count" id="student_count1">
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id1">
					<button type="button" class="btn bg-primary" id="btnUpdate" style="width:100%;" onClick="updateRecord1();">Update</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h5 class="modal-title">Delete</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<strong style="color:red;">Are you sure?</strong> Do you want to Delete this Post
				</div>
				<div class="modal-footer">
					<button type="button" style='margin-left:10px;' id="btnYes" class="btn btn-danger col-sm-2 pull-right" data-dismiss="modal">Yes</button>
					<button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>

	<?php include_once('footer.php'); ?>

	<?php
	if (isset($_GET["do"]) && ($_GET["do"] == "alert_from_insert")) {

		$msg = $_GET['msg'];

		if ($msg == 1) {

			echo '
			<script>
			
			$(function() {
				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "show",
				  "hideMethod": "fadeOut"
				}
  
				toastr["warning"]("This classroom already has in our Database.", "Warning!");
  
			  });
			
			</script>
		';
		}

		if ($msg == 2) {

			echo '
			<script>
			
			$(function() {
				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "show",
				  "hideMethod": "fadeOut"
				}
  
				toastr["success"]("Your information has been successfully inserted in our database.", "Success!");
  
			  });
			
			</script>
		';
		}

		if ($msg == 3) {
			echo '
			<script>
			
			$(function() {
				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "show",
				  "hideMethod": "fadeOut"
				}
  
				toastr["info"]("Check your internet connection and try again.", "Something is wrong!");
  
			  });
			
			</script>
		';
		}
	}
	?>

	
	<script src="../js/classroom.js"></script>

</body>

</html>