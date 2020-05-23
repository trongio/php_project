<?php

$errors = $errors ?? [];
$data = $data ?? [];

echo '<pre>';
var_dump($errors, $data);
echo '</pre>';
?>

<h1>Contact page</h1>

<form method="post" action="/contact">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1"
               name="email">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>