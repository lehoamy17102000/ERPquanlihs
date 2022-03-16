<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="modal fade" id="modalInvoice" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="div-logo">
                            <img class="logo" src="../uploads/logo.png">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h2>MT</h2>

                        <div class="school-address">
                            455 Foggy Heights,<br>
                            AZ 85004, US
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="school-email text-right">
                            Email: test@gmail.com<br>
                            Phone: 444-888-1111
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4>INVOICE TO:</h4>
                        <div>

                            <?php
                            include_once("../controller/config.php");

                           
                            $teacher_id = $_GET['teacher_id'];
                            $monthly_salary = $_GET['monthly_salary'];
                            $monthly_salary  = number_format($monthly_salary , 2, '.', '');

                            $sql = "SELECT * FROM teacher WHERE id='$teacher_id'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);


                            ?>
                            <span class="student-name"><?php echo $row['name']; ?></span>

                        </div>

                    </div>
                    <div class="col-md-6 current-date text-right">

                        <?php

                        $sql1 = "SELECT * FROM teacher_salary ORDER BY id DESC LIMIT 1";
                        $result1 = mysqli_query($conn, $sql1);
                        $row1 = mysqli_fetch_assoc($result1);

                        $id1 = $row1["id"];

                        $inv_number = $id1 + 1;

                        $current_year = date("Y");
                        $current_month = date("Y");
                        $current_date = date("Y-m-d");


                        ?>

                        <h3>INVOICE - #<?php echo $inv_number; ?></h3>
                        <div>
                            Year: <?php echo $current_year; ?><br>
                            Month:<?php echo $current_month; ?><br>
                            Date: <?php echo $current_date; ?>
                        </div>

                    </div>
                </div>

                <table class="table table-bordered ">
                    <thead>
                        <tr class="t-head">
                            <th>#</th>
                            <th>Description</th>
                            <th class="text-right">Fee</th>
                            <th class="text-right">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Monthly Salary</td>
                            <td class="text-right"><?php echo $monthly_salary; ?></td>
                            <td class="text-right"><?php echo $monthly_salary; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        
                        <div class="float-right text-right">

                            <strong>
                                <span id=""><?php echo $monthly_salary; ?>$</span> <br>
                                <span id=""><?php echo $monthly_salary; ?>$</span> <br>
                                <span id=""><?php echo $monthly_salary; ?>$</span> <br>
                            </strong>

                        </div>
                        
                        <div class="float-right text-right">

                            <strong>
                                Monthly Salary :<br>
                                Total :<br>
                                Paid :<br>
                            </strong>

                        </div>  

                    </div>

                </div>
                <center><h1 class="thanks">Thank You!</h1></center>
            </div>

           
           
        </div>
    </div>
</div>