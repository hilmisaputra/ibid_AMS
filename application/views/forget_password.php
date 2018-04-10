<div class="row min-h-fullscreen center-vh p-20 m-0">
  <div class="col-12">
    <div class="card card-shadowed px-50 py-30 w-400px mx-auto" style="max-width: 100%">
      <h5 class="text-uppercase"><?php echo $title;?></h5>
      <br>
      <?php if (isset($error_login)) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $error_login ?>
        </div>
      <?php } elseif ($this->session->flashdata('message_success')) { ?>
        <div class="alert alert-info" role="alert">
          <?php echo $this->session->flashdata('message_success'); ?>
        </div>
      <?php } elseif ($this->session->flashdata('message_failed')) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $this->session->flashdata('message_failed'); ?>
        </div>
      <?php } ?>
      <form id="form-reset" class="form-type-material" method="POST" action="<?php echo base_url('user/forget_passwordPOST') ?>">
        <div class="form-group">
          <input type="text" class="form-control" id="username" name="username"  value="<?php echo isset($old_username) ? $old_username: ''; ?>">
          <span style="color: red"><?php echo form_error('username');?></span>
          <label for="username">Username</label>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" id="password" name="password">
          <span style="color: red"><?php echo form_error('password');?></span>
          <label for="password">Your new password</label>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" id="confirm_password" name="confirm_password">
          <label for="confirm_password">Confirm new password</label>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-4">
              <a href="<?php echo base_url()?>user/" class="btn btn-bold btn-block btn-default">Back</a>
            </div>
            <div class="col-8">
              <button class="btn btn-bold btn-block btn-primary" type="submit">Save</button>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>


  <footer class="col-12 align-self-end text-center fs-13">
    <p class="mb-0"><small>Copyright © 2017 <a href="http://thetheme.io/theadmin">TheAdmin</a>. All rights reserved.</small></p>
  </footer>
</div>