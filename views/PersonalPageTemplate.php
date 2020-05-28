
<div class="container">
    <h1 class="my-4"><?php echo substr($_SERVER['PATH_INFO'],1); ?>s blog</h1>
    <div class="row">

        <!-- Blog Entries Column -->

        <div class="col-md grid">
            <?php
            $database=new \app\db\Database();
            $table= $database->get_posts();

            foreach (array_reverse($table) as $post){
                if($post['poster_name']==substr($_SERVER['PATH_INFO'],1)){
                    echo "<div class=\"block card \">";
                    if($post['post_image']!=false)
                        echo "<img class=\"card-img-top\" src=\"images/$post[post_image]\" alt=\"Card image cap\">";
                    echo "<div class=\"card-body\">";
                    echo "<h2 class=\"card-title\">$post[post_title]</h2>";
                    if(strlen($post['post_text']) >255) $post['post_text']=substr($post['post_text'],0,255)." ...";
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