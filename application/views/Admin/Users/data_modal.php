<?php echo form_open_multipart($simpan, array('name' => 'modal-biodata', 'id' => 'modal-biodata')); ?>
  <div class="modal-header">
    <h5 class="modal-title" id="ModalLabelLarge"><b>Master Users</b></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <input type="hidden" name="id" value="<?= !empty($data['id']) ? $data['id'] : '';?>">
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Nama Lengkap</label>
        <?php echo form_input($data, !empty($data['nama_lengkap']) ? $data['nama_lengkap'] : '', 'class="form-control form-control-user" name="nama_lengkap"');?>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Username</label>
        <?php echo form_input($data, !empty($data['username']) ? $data['username'] : '', 'class="form-control form-control-user" name="username"');?>
      </div>
    </div>
    <?php if (empty($data['id'])) { ?>
      <div class="form-group row">
        <div class="col-sm-12">
          <label>Password</label>
          <?php echo form_password($data, !empty($data['password']) ? $data['password'] : '', 'class="form-control form-control-user" name="password"');?>
        </div>
      </div>
    <?php } ?>
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Email</label>
        <?php echo form_input($data, !empty($data['email']) ? $data['email'] : '', 'class="form-control form-control-user" name="email"');?>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Headline</label>
        <?php echo form_input($data, !empty($data['headline']) ? $data['headline'] : '', 'class="form-control form-control-user" name="headline"');?>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Tentang Saya</label>
        <?php echo form_textarea($data, !empty($data['tentang_saya']) ? $data['tentang_saya'] : '', 'class="form-control form-control-user" name="tentang_saya"');?>
      </div>
    </div>
  </div>
  <div class="modal-footer">
  <button type="button" id="simpan" class="btn btn-dark" <?=$disable;?>>Simpan</button>
<?php echo form_close() ?>

<script type="text/javascript" src="<?= base_url();?>assets/admin/vendor/jquery/bootbox.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script type="text/javascript">
  $("#simpan").click(function(){
    var form = $("#" + $(this).closest('form').attr('name'));
    var formdata = false;
    if (window.FormData) {
      formdata = new FormData(form[0]);
    }
    bootbox.confirm("Apakah anda yakin akan menyimpan data ini?", function(result){
      if(result == true) {
        $.ajax({
          type: form.attr("method"),
          url: form.attr("action"),
          data: formdata ? formdata : form.serialize(),
          processData: false,
          contentType: false,
          cache: false,
          async: false,
          success: function (res) {
            var hasil = $.parseJSON(res);
            if (hasil["status"] == 200) {
               toastr.success(hasil["pesan"]);
               setTimeout(function () {
                 return hasil["status"];
               }, 1500);
               $('#ModalLarge').modal('hide');
               setTimeout(function () {
                 location.reload(true);
               }, 1500);
             }else{
               toastr.error(hasil["pesan"]);
               result = false;
               return hasil["status"];
             }
           },
           error: function (res) {
             toastr.error("Data tidak dapat disimpan.");
             result = false;
             return false;
           },
        });
      }
    });
  });
</script>
