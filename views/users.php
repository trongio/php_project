<?php
?>

<table class="table table-sm table-hover table-dark">
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['name'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo $user['phone'] ?></td>
            <td>
                <a href="/posts?userId=<?php echo $user['id'] ?>">
                    Posts
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
