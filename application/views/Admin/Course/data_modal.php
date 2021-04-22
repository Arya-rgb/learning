<?php echo form_open_multipart($simpan, array('name' => 'modal-course', 'id' => 'modal-course')); ?>
  <div class="modal-header">
    <h5 class="modal-title" id="ModalLabelLarge"><b>Master Course</b></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <input type="hidden" name="id" value="<?= !empty($data['id']) ? $data['id'] : '';?>">
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Modul</label>
        <?php echo form_dropdown('id_modul', $opt_modul, !empty($data['id_modul']) ? $data['id_modul'] : '', 'class="form-control form-control-user"');?>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Judul</label>
        <?php echo form_input('judul', !empty($data['judul']) ? $data['judul'] : '', 'class="form-control form-control-user"');?>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Deskripsi</label>
        <?php echo form_textarea('deskripsi', !empty($data['deskripsi']) ? $data['deskripsi'] : '', 'class="form-control form-control-user" id="ckeditor"');?>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Video</label>
        <?php echo form_upload('url_video', '', 'class="form-control form-control-user"');?>
        <?php echo form_input('url_video_old', !empty($data['url_video']) ? $data['url_video'] : '', 'class="form-control form-control-user" hidden');?>
        <?php echo form_input('type_video_old', !empty($data['type_video']) ? $data['type_video'] : '', 'class="form-control form-control-user" hidden');?>
      </div>
    </div>
  </div>
  <div class="modal-footer">
  <button type="button" id="simpan" class="btn btn-dark" <?=$disable;?>>Simpan</button>
<?php echo form_close() ?>

<script type="text/javascript" src="<?= base_url();?>assets/admin/vendor/jquery/bootbox.min.js"></script>
<link href="<?= base_url();?>assets/toastr-js/toastr.scss" rel="stylesheet"/>
<script src="<?= base_url();?>assets/toastr-js/toastr.js"></script>
<script>
    CKEDITOR.replace('ckeditor');
</script>
<script type="text/javascript">
  $("#simpan").click(function(){
    for (instance in CKEDITOR.instances) {
      CKEDITOR.instances[instance].updateElement();
    }
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
