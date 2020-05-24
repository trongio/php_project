
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4"><?php echo substr($_SERVER['PATH_INFO'],1); ?>s blog</h1>
            <?php
            $database=new \app\db\Database();
            $table= $database->get_posts();

            foreach (array_reverse($table) as $post){
                if($post['poster_name']==substr($_SERVER['PATH_INFO'],1)){
                    echo "<div class=\"card mb-4\">";
                    if (isset($post['post_image']))
                        echo "<img class=\"card-img-top\" src=\"images/$post[post_image]\" alt=\"Card image cap\">";
                    echo "<div class=\"card-body\">";
                    echo "<h2 class=\"card-title\">$post[post_title]</h2>";
                    echo "<p class=\"card-text\">$post[post_text]</p></div>";
                    echo "<div class=\"card-footer text-muted\">Posted on $post[post_date] by ";
                    echo "<a name=\"$post[poster_name]\" href=\"$post[poster_name]\">$post[poster_name]</a></div></div>";
                }
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