<?php
$errorMessage = $errorMessage ?? false;
$data = $data ?? ['email' => ''];
?>
<div class="container">
<h1>Login to your account</h1>

<form method="post" action="/login">
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger">
            <p><?php echo $errorMessage ?></p>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label>Email address</label>
        <input type="email" class="form-control" name="email" value="<?php echo $data['email'] ?>">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>