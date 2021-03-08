<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <!--dashboard -->
            <li id="dashboardMainMenu">
                <a href="dashboard.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!--users -->
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li id="createUserNav"><a href="member_view.php"><i class="fa fa-circle-o"></i> Organization
                            Members</a></li>
                    <li id="manageUserNav"><a href="customer_view.php"><i class="fa fa-circle-o"></i> Customers</a></li>

                </ul>
            </li>

            <!--orders -->
            <li><a href="order_view.php"><i class="fa fa-dollar"></i>
                    <span>Orders</span>
                </a>
            </li>

            <!--Feedback/Issues -->
            <li><a href="contact_view.php"><i class="fa fa-inbox"></i>
                    <span>Feedback/Issues</span>
                </a>
            </li>

            <!--book -->
            <li><a href="book_view.php"><i class="fa fa-book"></i>
                    <span>Products</span>
                </a>
            </li>

            <!--rating -->
            <li><a href="rating_view.php"><i class="fa fa-star"></i>
                    <span>Rating</span>
                </a>
            </li>

            <!--stock purchase -->
            <li><a href="purchase_view.php"> <i class="fa fa-file-text"></i>
                    <span>Stock Purchase</span>
                </a>
            </li>

            <!--supplier -->
            <li><a href="supplier_view.php"><i class="fa fa-industry"></i>
                    <span>Supplier</span>
                </a>
            </li>

            <!-- logout -->
            <li>
            <a href="php_action/auth_logout.php" onclick="return confirm('Logging out?')"><i class="glyphicon glyphicon-log-out"></i>
            <span>Logout</span>
            
            </section>
            </a>
            </li>  
        </ul>

   
    <!-- /.sidebar -->
</aside>

