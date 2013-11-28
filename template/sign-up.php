<h1>Sign Up</h1>
<form action="" method="post" role="form" xmlns="http://www.w3.org/1999/html">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Choose a password" required>
    </div>
    <?php if ($userSession->isConnected() && $userSession->hasRole('ROLE_ADMIN')): ?>
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" class="form-control">
                <option value="ROLE_USER">User</option>
                <option value="ROLE_ADMIN">Admin</option>
            </select>
        </div>
    <?php endif; ?>
    <input type="submit" name="submit" class="btn btn-default" value="Submit">
</form>