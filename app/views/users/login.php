<?php require APPROOT . '/views/include/header.php'; ?>
<div class="row">
    <div class="col-md-6 col-12 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success'); ?>
            <h2>Login</h2>
            <p>Fill all inputs to login</p>
            <form action="/users/login" method="post">

                <div class="form-group">
                    <label for="email">Email* : </label>
                    <input class="form-control form-control-lg <?php if(!empty($data['errors']['email']))
                    {
                        echo 'is-invalid';
                    }?>" type="email" name="email" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['errors']['email']; ?></span>
                </div>

                <div class="form-group">
                    <label for="password">Password* : </label>
                    <input class="form-control form-control-lg <?php if(!empty($data['errors']['password']))
                    {
                        echo 'is-invalid';
                    }?>" type="password" name="password" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['errors']['password']; ?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT;?>/users/register" class="btn btn-light btn-block">Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>