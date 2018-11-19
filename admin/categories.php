<?php include 'includes/admin_header.php'; 
    ?>

    <div id="wrapper">
    
        <?php include 'includes/admin_navigation.php'; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to the CMS
                            <small>Admin</small>
                        </h1>
                        <div class="row">
                            <div class="col-xs-6 well">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="cat_title">Add Categories</label>
                                            <?php insert_category(); ?>
                                            <input type="text" name="cat_title" class="form-control" id="cat_title">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit_add" class="btn btn-primary" value="Create Category">
                                        </div>
                                    </form>
                                    

                                            <?php edit_category(); ?>

                                     

                            </div>
                            <div class="col-xs-6">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Category Title</th>
                                            <th>Delete</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php find_all_categories(); ?>

                                    <?php delete_category_by_id(); ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>




        <!-- /#page-wrapper -->
<?php include 'includes/admin_footer.php'; ?>