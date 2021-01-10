<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 p-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <h1>Users</h1>
                </div>
                <div class="col-auto">
                    <a href="<?php echo URL; ?>" class="btn btn-primary">
                        Voltar p/ Home
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 p-3">
            <div class="row justify-content-start align-items-center">
                <div class="col-auto">
                    <a href="<?php echo URL . 'admin/users/create'; ?>" class="btn btn-primary">
                        New User
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 p-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Email</td>
                        <td>Role</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($users)) { ?>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?php echo $user->id; ?></td>
                                <td><?php echo $user->email; ?></td>
                                <td><?php echo $user->role; ?></td>
                                <td>
                                    <a class="btn btn-warning" href="<?php echo URL . 'admin/users/edit/' . $users->id; ?>">
                                        Edit
                                    </a>
                                    <form action="<?php echo URL . 'admin/users/delete/' . $users->id; ?>">
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <p>No found data</p>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
