<h1>List Users</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?= $user->getId(); ?></td>
                <td><?= $user->getName(); ?></td>
                <td><?= $user->getRole(); ?></td>
                <td>
                    <a href="admin-user-edit.php?id=<?= $user->getId(); ?>">Edit <span class="glyphicon glyphicon-edit"></span></a> |
                    <a href="admin-user-delete.php?id=<?= $user->getId(); ?>">Delete <span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>