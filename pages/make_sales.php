<?php
session_start();
include '../resources/sessions.php';
$ses = new Sessions();
if (!isset($_SESSION['uid']) || !isset($_SESSION['role'])) {
    header("location:../index.php");
}
$role = $_SESSION['role'];
$uid = $_SESSION['uid'];

//make sale
if (isset($_POST['reg'])) {

    /* $result = $ses->newCustomer($email, $mobile, $fullname);

      if ($result == TRUE) {
      echo "<script>alert('Operation successful!'); window.location.href='view_customers.php';</script>";
      } else {
      echo "<script>alert('Error: user email may already exist!');</script>";
      } */
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $ses->APP_TITLE ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
        <!-- Theme style -->
        <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="../plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="../plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <div class="wrapper">
            <!--Header-->
            <?php include '../resources/header.php'; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include '../resources/sidebar.php'; ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3>Make Sales</h3>
                                </div>
                                <form method="post" action="">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Customer:</label>
                                                <select id="customer" name="customer" class="form-control" required>
                                                    <option></option>
                                                    <?php
                                                    $customers = $ses->getAllCustomers();
                                                    foreach ($customers as $cust) {
                                                        ?>
                                                        <option value="<?php echo $cust['email'] ?>">
                                                            <?php echo $cust['fullname'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Price (NGN):</label>
                                                <input id="price" type="number" name="price" required class="form-control"/>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Products:</label>
                                                <textarea id="products" style="resize: none;" rows="8" name="products" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer text-right">
                                        <button type="submit" name="make" class="btn btn-primary">
                                            <i class="glyphicon glyphicon-check"></i> 
                                            Make Sale
                                        </button>
                                    </div>
                                </form>
                                <!--create reciept-->
                                <script type="text/javascript">
                                    function printRCP(email, price, products) {
                                        //var email = document.getElementById("customer").value;
                                        //var price = document.getElementById("price").value;
                                        //var products = document.getElementById("products").value;

                                        window.open("receipt.php?email=" + 
                                                email + "&price=" + price + 
                                                "&products=" + products, "Receipt", "width=500, height=500").print();
                                    }
                                </script>
                                <?php
                                //on make sale
                                if(isset($_POST['make'])){
                                    $form_email = $_POST['customer'];
                                    $form_products = $_POST['products'];
                                    $form_price = $_POST['price'];
                                    
                                    $result = $ses->makeSale($form_email, $form_price, $form_products, $uid);
                                    if($result){
                                        echo "<script>alert('Operation Successful!'); "
                                        . "printRCP('$form_email','$form_price','$form_products'); "
                                                . "window.location.href='make_sales.php';</script>";
                                    }else{
                                        echo $result;
                                        echo "<script>alert('Operation failed!');</script>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <!--Footer-->
            <?php include '../resources/footer.php'; ?>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.3 -->
        <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- jQuery UI 1.11.2 -->
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
                                    $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
        <!-- Morris.js charts -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="../plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="../plugins/knob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- Slimscroll -->
        <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='../plugins/fastclick/fastclick.min.js'></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/app.min.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../dist/js/pages/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js" type="text/javascript"></script>
    </body>
</html>