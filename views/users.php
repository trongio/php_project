<div class="container">
    <h1 class="my-4">User List</h1>
    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md grid">
            <?php
            $database=new \app\db\Database();
            $users= $database->get_users();

            foreach (array_reverse($users) as $user){
                echo "<div class=\"block card \">";
                if(file_exists("images/user_images/".$user['full_name'].".png"))
                echo "<img class=\"card-img-top\" src=\"images/user_images/$user[full_name].png\" alt=\"Card image cap\">";
                echo "<div class=\"card-body\">";
                echo "<h2 class=\"card-title\"><a href='/$user[full_name]'>$user[full_name]</a></h2>";
                echo "<p class=\"card-text\">$user[email]</p></div>";
                echo "<div class=\"card-footer text-muted\">$user[reg_date]";
                echo "</div></div>";
            }

            ?>

        </div>

    </div>

</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
</footer>