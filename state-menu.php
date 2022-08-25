
<div class="header">
			
            <!-- Logo -->
            <div class="header-left">
                <a href="super-admin-dashboard.php" class="logo">
                    <img src="assets/img/logo.png" alt="Logo">
                </a>
                <a href="super-admin-dashboard.php" class="logo logo-small">
                    <img src="assets/img/logo-small.png" alt="Logo" width="30" height="30">
                </a>
</div>
            
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-align-left"></i>
            </a>
            
            
            <!-- Mobile Menu Toggle -->
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <!-- /Mobile Menu Toggle -->
            
            <!-- Header Right Menu -->
            <ul class="nav user-menu">
                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31" alt="Ryan Taylor"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="assets/img/profiles/avatar-01.jpg" alt="User Image" class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>Ryan Taylor</h6>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
                <!-- /User Menu -->
                
            </ul>
            <!-- /Header Right Menu -->
            
        </div>
        <!-- /Header -->
        
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title"> 
                            <span>Main Menu</span>
                        </li>
                        <li class="submenu active">
                            <a href="#"><i class="fas fa-graduate"></i><span> Dashboard</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="state-dashboard.php" class="active">Admin Dashboard</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"> <i class="fas fa-building"></i><span> Districts</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="state-district-list.php">Districts List</a></li>
                                <!-- <li><a href="super-admin-add-school.php">Schools Add</a></li> -->
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"> <i class="fas fa-building"></i><span> Blocks</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="state-school-list.php">Blocks List</a></li>
                                <!-- <li><a href="super-admin-add-school.php">Schools Add</a></li> -->
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"> <i class="fas fa-building"></i><span> Schools</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="state-school-list.php">Schools List</a></li>
                                <!-- <li><a href="super-admin-add-school.php">Schools Add</a></li> -->
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="state-school-teacher-list.php">Teachers List</a></li>
                            </ul>
                        </li>
                         <li class="submenu">
                            <a href="#"><i class="fas fa-user-graduate"></i> <span> Students</span> <span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="state-school-student-list.php">Students List</a></li>
                            </ul>
                        </li>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->
        