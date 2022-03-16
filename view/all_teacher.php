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
					<h1 class="m-0 text-dark">Teacher</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Teacher</li>
                        <li class="breadcrumb-item active">All Teacher</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
    <!-- /.content-header -->
    
    <!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row" id="table1">
				<div class="col-8">
					<div class="card card-outline card-primary">
						<div class="card-header">
							<h3 class="card-title">All Teacher</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="dTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width: 10%">ID</th>
										<th>Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include_once('../controller/config.php');

									$sql = "SELECT * FROM teacher";
									$result = mysqli_query($conn, $sql);
									$count = 0;
									if (mysqli_num_rows($result) > 0) {
										while ($row = mysqli_fetch_assoc($result)) {
											$count++;

									?>
											<tr>
												<td><?php echo $count; ?></td>
												<td>
													<a href="#teacherDetails" data-toggle="modal" onclick="teacherDetails(this);" data-id="<?php echo $row['id']; ?>">
														<?php echo $row['name']; ?>
													</a>
												
												</td>
												<td>
													<a href="edit_teacher.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-xs " >Edit</a>
													<a href="#" onClick="deleteRecord(this);" class="btn btn-danger btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">Delete</a>
													<a href="#" onClick="addSalary(this);" class="btn btn-success btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">Add Salary</a>
													<a href="#" onClick="viewPayment(this);" class="btn btn-info btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">View Payment</a>
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

	 <!-- Main content -->
	 <section class="content">
		<div class="container-fluid">
			<div class="row" id="table2">

			</div>
		</div>
	 </section>
	
	<div class="modal fade" id="teacherDetails" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header bg-green">
					<h5 class="modal-title" id="tName"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-3">
							<img id="tImage" class="img-circle" style="width: 120px; height: 120px;">	
						</div>
						<div class="col-sm-9">
							<table class="table">
								<tbody>
									<tr>
										<td>Index Number</td>
										<td id="tIndex"></td>
									</tr>
									<tr>
										<td>Name</td>
										<td id="tName1"></td>
									</tr>
									<tr>
										<td>Address</td>
										<td id="tAddress"></td>
									</tr>
									<tr>
										<td>Gender</td>
										<td id="tGender"></td>
									</tr>
									<tr>
										<td>Phone</td>
										<td id="tPhone"></td>
									</tr>
									<tr>
										<td>Email</td>
										<td id="tEmail"></td>
									</tr>
									<tr>
										<td>Register Date</td>
										<td id="tRegDate"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
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

	<div id="divAddSalary">
		
	</div>

	<div id="divShowInvoice">
		
	</div>
    
	<?php include_once('footer.php'); ?>
	<script src="../js/all_teacher.js"></script>

	<?php
	if (isset($_GET["do"]) && ($_GET["do"] == "alert_from_update")) {

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
  
				toastr["success"]("Your information has been successfully updated in our database.", "Success!");
				
				
			
  
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

				toastr["info"]("Check your internet connection and try again.", "Something is wrong!");
  
				
  
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
  
				toastr["error"]("Sorry, there was an error uploading your file.", "Something is wrong!");

				
  
			  });
			
			</script>
		';
        }

		if ($msg == 4) {

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
  
				toastr["warning"]("This email address already has in our Database.", "Warning!");
  
			  });
			
			</script>
		';
		}

		if ($msg == 5) {
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
  
				toastr["warning"]("This index number already has in our Database.", "Warning!");
  
			  });
			
			</script>
		';
        }
        
       
	}
	?>

</body>
</html>