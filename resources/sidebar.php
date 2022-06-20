<?php
$side_ses = new Sessions();
$side_role = $_SESSION['role'];
$side_uid = $_SESSION['uid'];
$side_fullname = "";

//get user details
if ($side_role == "admin") {
    $side_fullname = "Administrator";
} else {
    $user_det = $side_ses->getSingleStaff($side_uid);
    $side_fullname = $user_det['fullname'];
}
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../images/user.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $side_fullname ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <?php
            if ($side_role == "admin") {
                ?>
                <li><a href="reg_staff.php"><i class="fa fa-circle-o"></i> Register Staff</a></li>
                <li><a href="view_staff.php"><i class="fa fa-circle-o"></i> All Staff</a></li>
                <li><a href="admin_customers.php"><i class="fa fa-circle-o"></i> All Customers</a></li>
                <li><a href="view_promotions.php"><i class="fa fa-circle-o"></i> Promotions</a></li>
                <li><a href="admin_sales.php"><i class="fa fa-circle-o"></i> Sales</a></li>
                <?php
            } elseif ($side_role == "marketing") {
                ?>
                <li><a href="view_customers.php"><i class="fa fa-circle-o"></i> All Customers</a></li>
                <li><a href="new_promotions.php"><i class="fa fa-circle-o"></i> New Promotions</a></li>
                <li><a href="view_promotions.php"><i class="fa fa-circle-o"></i> All Promotions</a></li>
                <?php
            } elseif ($side_role == "sales") {
                ?>
                <li><a href="reg_customer.php"><i class="fa fa-circle-o"></i> Register Customer</a></li>
                <li><a href="view_customers.php"><i class="fa fa-circle-o"></i> All Customers</a></li>
                <li><a href="make_sales.php"><i class="fa fa-circle-o"></i> Make Sales</a></li>
                <?php
            }
            ?>
            <li><a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>