<?php
?>
<div class="container">
    <h1>create post</h1>
    <form method="post" action="/post">

        <div class="form-group">
            <label for="post_title">Post title:</label>
            <input type="text" class="form-control <?php echo isset($errors['post_title']) ? ' is-invalid' : '' ?>"
                   name="post_title">
            <div class="invalid-feedback">
                <?php echo $errors['post_name'] ?? '' ?>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Post Text:</label>
            <textarea class="form-control"  name="post_text" id="post_text" rows="3"
            <?php echo isset($errors['post_text']) ? ' is-invalid' : '' ?>"></textarea>
            <div class="invalid-feedback">
                <?php echo $errors['post_text'] ?? '' ?>
            </div>
        </div>

        <div class="form-group">
            <div class="photo">
                <h>Select image : &nbsp;</h>
                <div>
                    <input class="btn btn-secondary" type="file" name="post_image"><br/>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>