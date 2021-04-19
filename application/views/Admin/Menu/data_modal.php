<?php echo form_open_multipart($simpan, array('name' => 'modal-menu', 'id' => 'modal-menu')); ?>
  <div class="modal-header">
    <h5 class="modal-title" id="ModalLabelSmall"><b>Master Menu</b></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <input type="hidden" name="id" value="<?= !empty($data['id']) ? $data['id'] : '';?>">
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Nama Menu</label>
        <?php echo form_input($data, !empty($data['nama_menu']) ? $data['nama_menu'] : '', 'class="form-control form-control-user" name="nama_menu"');?>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Icon</label>
        <?php echo form_input($data, !empty($data['icon']) ? $data['icon'] : '', 'class="form-control form-control-user" name="icon"');?>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Parent</label>
        <?php echo form_input($data, !empty($data['id_parent']) ? $data['id_parent'] : '', 'class="form-control form-control-user" name="id_parent"');?>
      </div>
    </div>
    <div class="form-group row" style="display:none;">
      <div class="col-sm-12">
        <label>Headline</label>
        <?php echo form_input($data, !empty($data['headline']) ? $data['headline'] : '', 'class="form-control form-control-user" name="headline"');?>
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
