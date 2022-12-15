                <?php include "includes/admin_header.php"; ?>

                <div id="wrapper">

                <!-- Navigation -->
                <?php include "includes/admin_navigation.php"; ?>


                <div id="page-wrapper">

                <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                <div class="col-lg-12">
                <h1 class="page-header">
                Welcome to Admin
                <small>Author</small>
                </h1>



                <div class="col-xs-6">

                <?php // insert query
                insert_category();
                ?>


                <!-- add category form -->

                <form action="" method="post">
                <div class="form-group">
                <label for="cat-title">Add Category</label>
                <input type="text"  class="form-control" name="cat_title">

                </div>

                <div class="form-group" >
                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                </div>



                </form>
                <?php //update query and include

                if(isset($_GET['update']))
                {
                $get_cat_id1=$_GET['update'];

                include "includes/update_category.php";

                }


                ?>

                </div> 


                <div class="col-xs-6">

                <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Category Title</th>
                  <th>Delete</th>
                  <th>Update</th>
                </tr>
                </thead>
                <tbody>

                <?php   //add category
                findallcategory();
                ?>



                <?php //delete query
               
                               
                delete_category();             



              

              

                ?>

                </tbody>
                </table>


                </div>


                </div>
                </div>
                <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- /#page-wrapper -->

                </div>
                <!-- /#wrapper -->

                <?php include "includes/admin_footer.php";?>