<?php
$head_ses = new Sessions();
$head_role = $_SESSION['role'];
$head_uid = $_SESSION['uid'];
$head_fullname = "";

//get user details
if ($head_role == "admin") {
    $head_fullname = "Administrator";
} else {
    $head_det = $head_ses->getSingleStaff($head_uid);
    $head_fullname = $head_det['fullname'];
}
?>
<header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo"><b><?php echo $head_ses->APP_SYMBOL ?></b></a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <span style="float: left; padding: 8px; font-size: 24px; color: #fff; font-weight: bold;">
            <?php echo $head_ses->APP_TITLE ?>
        </span>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../images/user.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo $head_uid ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="../images/user.jpg" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo ucwords($head_fullname) ?>
                                <small><?php echo ucfirst($head_role) ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <!--<div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>-->
                            <div class="pull-right">
                                <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>