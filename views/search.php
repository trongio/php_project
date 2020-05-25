<?php

?>

<div class="container">

    <h1 class="my-4">Results:</h1>
    <div class="row">


        <!-- Blog Entries Column -->
        <div class="col-md grid">
            <?php
            $database=new \app\db\Database();
            $search_text=substr($_SERVER['REQUEST_URI'],strpos($_SERVER['REQUEST_URI'],'=')+1);
            $table= $database->search($search_text);

            foreach (array_reverse($table) as $post){
                echo "<div class=\" block card\">";
                if(isset($post['post_image']))
                    echo "<img class=\"card-img-top\" src=\"images/$post[post_image]\" alt=\"Card image cap\">";
                echo "<div class=\"card-body\">";
                echo "<h2 class=\"card-title\">$post[post_title]</h2>";
                if(strlen($post['post_text']) >255) $post['post_text']=substr($post['post_text'],0,255)." ...";
                echo "<p class=\"card-text\">$post[post_text]</p></div>";
                echo "<div class=\"card-footer text-muted\">Posted on $post[post_date] by ";
                echo "<a name=\"$post[poster_name]\" href=\"$post[poster_name]\">$post[poster_name]</a></div></div>";
            }

            ?>

        </div>

    </div>

</div>