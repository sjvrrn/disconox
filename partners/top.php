<?php 
session_start();
?>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><img src="assets/images/disco-logo.png"/> </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto mt-md-0">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
               <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                </li>
                
            </ul>
            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php if($_SESSION['image']){ echo $_SESSION['image']; }else{ echo 'assets/images/profile-pick.png'; } ?>" alt="user" class="profile-pic" /></a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="<?php if($_SESSION['image']){ echo $_SESSION['image']; }else{ echo 'assets/images/profile-pick.png'; } ?>" alt="user"></div>
                                    <div class="u-text">
                                        <h4><?php echo $_SESSION['name'];?></h4>
                                        <p class="text-muted"><?php echo $_SESSION['email'];?></p><a href="my-profile.php" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="my-profile.php"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="my-balance.php"><i class="ti-wallet"></i> My Balance</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>
                
            </ul>
        </div>
    </nav>
</header>