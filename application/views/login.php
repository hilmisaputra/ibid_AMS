<div class="row min-h-fullscreen center-vh p-20 m-0">
  <div class="col-12">
    <div class="card card-shadowed px-50 py-30 w-400px mx-auto" style="max-width: 100%">
      <h5 class="text-uppercase">Masuk</h5>
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
       <!--MASIH GAGAL-->
      <form class="form-type-material" method="POST" action="<?php echo base_url('user/login') ?>" id="form-login">
        <div class="form-group">
          <input type="text" class="form-control" id="username" name="username"  value="<?php echo isset($old_username) ? $old_username: ''; ?>">
          <span style="color: red"><?php echo form_error('username');?></span>
          <label for="username">Nama User</label>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" id="password" name="password">
          <span style="color: red"><?php echo form_error('password');?></span>
          <label for="password">Kata Sandi</label>
        </div>

        <div class="form-group flexbox flex-column flex-md-row">
          <label class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="remember_me">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Biarkan saya tetap masuk</span>
          </label>

          <!-- <a class="text-muted hover-primary fs-13 mt-2 mt-md-0" href="<?php echo $this->config->item('adms_auth')['forgot'];?>">Lupa kata sandi?</a> -->
        </div>

        <div class="form-group">
          <button class="btn btn-bold btn-block btn-primary" type="submit">Masuk</button>
        </div>
      </form>
    </div>
  </div>


  <footer class="col-12 align-self-end text-center fs-13">
    <p class="mb-0"><small>Copyright © 2018 <a href="http://thetheme.io/theadmin">IBID AMS</a>. All rights reserved.</small></p>
  </footer>
</div>