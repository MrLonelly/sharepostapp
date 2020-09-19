<?php require APPROOT . '/views/include/header.php'; ?>
<div class="row">
    <div class="col-md-6 col-12 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>Create an account</h2>
            <p>Fill all inputs to register</p>
            <p class="bg-red"><?php if(isset($data['errors']['global']))
            {
                echo $data['errors']['global'];
            }
            ?></p>
            <form action="/users/register" method="post">
                <div class="form-group">
                    <label for="name">Name* : </label>
                    <input class="form-control form-control-lg <?php if(!empty($data['errors']['name']))
                    {
                        echo 'is-invalid';
                    }?>" type="text" name="name" value="<?php echo $data['name']; ?>">
                    <span class="invalid-feedback"><?php echo $data['errors']['name']; ?></span>
                </div>

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

                <div class="form-group">
                    <label for="confirm_password">Confirm password* : </label>
                    <input class="form-control form-control-lg <?php if(!empty($data['errors']['confirm_password']))
                    {
                        echo 'is-invalid';
                    }?>" type="password" name="confirm_password" value="<?php echo $data['confirm_password']; ?>">
                    <span class="invalid-feedback"><?php echo $data['errors']['confirm_password']; ?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Register" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT;?>/users/login" class="btn btn-light btn-block">Have an accout? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>