<?php
/**
 * Created by PhpStorm.
 * User: Recording
 * Date: 02/Mar/2018
 * Time: 8:01 AM
 */
?>
<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile" style="background: url(assets/images/background/user-info.jpg) no-repeat;">
            <div class="profile-img"> <img src="assets/images/users/profile.png" alt="user" /> </div>
            <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Markarn Doe</a>
                <div class="dropdown-menu animated flipInY"> <a href="my-profile.php" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="my-balance.php" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>

                    <div class="dropdown-divider"></div> <a href="logout.php" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a> </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">Admin Features</li>
                <li> <a class="has-arrow waves-effect waves-dark" href="index.php" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="partners.php" aria-expanded="false">	                          <span style="color:#c3c3c3; float:left;">
                                          <i class="fas fa-handshake fa-2x"></i>
                                     </span> <span class="hide-menu flt-left p-t2 p-l5">Partners</span></a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="users.php" aria-expanded="false"><span style="color:#c3c3c3; float:left;">
                                          <i class="fas fa-users fa-2x"></i>
                                     </span><span class="hide-menu flt-left p-t2 p-l5">Users</span></a>

                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="artists.php" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                                          <i class="fas fa-chart-pie fa-2x"></i>
                                     </span> <span class="hide-menu flt-left p-t2 p-l5">Artists</span></a>

                </li>

                <li class="nav-devider"></li>

                <li> <a class="waves-effect waves-dark" href="all-posts.php" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                           <i class="fas fa-envelope fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t2 p-l5">Posts</span></a>
                </li>

                <li> <a class="waves-effect waves-dark" href="notifications.php" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                           <i class="fas fa-exclamation-circle fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t2 p-l5">Notifications</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="logout.php" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                           <i class="fas fa-exclamation-circle fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t2 p-l5">LogOut</span></a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
