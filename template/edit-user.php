<h1>Edit user</h1>
<form action="" method="post" role="form" xmlns="http://www.w3.org/1999/html">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" value="<?= $user->getName(); ?>" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Choose a password" required>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select id="role" name="role" class="form-control">
            <option value="ROLE_USER" <?php if ('ROLE_USER' === $user->getRole()) echo "selected"; ?>>User</option>
            <option value="ROLE_ADMIN" <?php if ('ROLE_ADMIN' === $user->getRole()) echo "selected"; ?>>Admin</option>
        </select>
    </div>
    <input type="submit" name="submit" class="btn btn-default" value="Submit">
</form>