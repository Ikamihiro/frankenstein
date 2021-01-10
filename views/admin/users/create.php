<div class="container">
    <div class="row col-md-12 col-xs-12 col-sm-12 p-3">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <h1>New Users</h1>
            </div>
            <div class="col-auto">
                <a href="<?php echo URL . 'admin/users'; ?>" class="btn btn-primary">
                    Back to Users
                </a>
            </div>
        </div>
    </div>
    <div class="row col-md-12 col-xs-12 col-sm-12 p-3">
        <form action="<?php echo URL . 'admin/users/store'; ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Password</label>
                <select class="form-select" id="role" aria-label="Default select example">
                    <option selected>Select a role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>