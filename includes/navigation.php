<?php session_start(); ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fas fa-leaf"></i> TV-Shows</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 

                        $query = "SELECT * FROM categories";
                        $select_all_categories_query = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<li class='nav-item'><a class='nav-link' href='index.php?source=show&category=". $cat_id."'>". $cat_title. "</a></li>";
                        }

                     ?>
                     

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php 
                        if(isset($_SESSION['username'])){
                    ?>  
                        
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                        <?php echo $_SESSION['username']; ?>
                         <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="admin"><i class="fa fa-fw fa-user"></i> Admin</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            
                            <li class="divider"></li>
                            <li>
                                <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>

                    <?php } else { ?>
                    <li>
                        <a href="registration.php" class="float-right">Sign Up</a>
                    </li>
                    <li>
                        <a href="admin"><i class="fa fa-fw fa-user"></i> Admin</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>