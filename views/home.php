
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4">Azaels blog</h1>
            <?php
                $database=new \app\db\Database();
                $table= $database->get_table();

                foreach ($table as $post){
                   echo "<div class=\"card mb-4\">";
                   echo "<img class=\"card-img-top\" src=\"../views/images/$post[post_image]\" alt=\"Card image cap\">";
                   echo "<div class=\"card-body\">";
                   echo "<h2 class=\"card-title\">$post[post_title]</h2>";
                   echo "<p class=\"card-text\">$post[post_text]</p></div>";
                   echo "<div class=\"card-footer text-muted\">Posted on $post[post_date] by ";
                   echo "<a href=\"#\">$post[poster_name]</a></div></div>";
                }

            ?>

            <!-- Blog Post -->
            <div class="card mb-4">
                <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">Post Title</h2>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam.
                        Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!
                    </p>
                </div>
                <div class="card-footer text-muted">
                    Posted on January 1, 2017 by
                    <a href="#">Start Bootstrap</a>
                </div>
            </div>

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