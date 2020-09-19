<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"><?php echo SITENAME; ?></h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="<?php echo URLROOT; ?>">HOME</a>
    <a class="p-2 text-dark" href="<?php echo URLROOT.'/pages/about'; ?>">ABOUT</a>
  </nav>
  <?php if(isset($_SESSION['user_id']))
  {
    ?>
		<a class="btn btn-outline-primary mr-2" href="<?php echo URLROOT; ?>/users/logout">Sign out</a>
    <?php
  }
  else
  {
    ?>
    <a class="btn btn-outline-primary mr-2" href="<?php echo URLROOT; ?>/users/register">Sign up</a>
    <a class="btn btn-outline-primary mr-2" href="<?php echo URLROOT; ?>/users/login">Sign in</a>
    <?php
  }
  ?>
</div>