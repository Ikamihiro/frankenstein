<div class="row justify-content-center p-5">
    <?php if (isset($erro)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $erro; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>
    <?php if (isset($users)) {
        echo count($users);
    } ?>
</div>