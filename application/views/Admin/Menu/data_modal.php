<?php echo form_open_multipart($simpan, array('name' => 'modal-menu', 'id' => 'modal-menu')); ?>
  <div class="modal-header">
    <h5 class="modal-title" id="ModalLabelSmall"><b>Master Menu</b></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <input type="hidden" name="id" id="id" value="<?= !empty($data['id']) ? $data['id'] : '';?>">
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Nama Menu</label>
        <?php echo form_input('nama_menu', !empty($data['nama_menu']) ? $data['nama_menu'] : '', 'class="form-control form-control-user"');?>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <label>Type Menu</label>
        <?php echo form_dropdown('type', $type, !empty($data['type']) ? $data['type'] : '', 'class="form-control form-control-user" id="type"');?>
      </div>
    </div>
    <div class="form-group row" style="display:none;" id="parent">
      <div class="col-sm-12">
        <label>Parent</label>
        <select class="form-control form-control-user" id="list_parent" name="id_parent">
          <option value="">- Pilih -</option>
        </select>
      </div>
    </div>
    <div class="form-group row" style="display:none;" id="icon">
      <div class="col-sm-12">
        <label>Icon</label>
        <?php echo form_input('icon', !empty($data['icon']) ? $data['icon'] : '', 'class="form-control form-control-user"');?>
      </div>
    </div>
    <div class="form-group row" style="display:none;" id="url">
      <div class="col-sm-12">
        <label>URL</label>
        <?php echo form_input('url', !empty($data['url']) ? $data['url'] : '', 'class="form-control form-control-user"');?>
      </div>
    </div>
  </div>
  <div class="modal-footer">
  <button type="button" id="simpan" class="btn btn-dark" <?=$disable;?>>Simpan</button>
<?php echo form_close() ?>

<script type="text/javascript" src="<?= base_url();?>assets/admin/vendor/jquery/bootbox.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="<?= base_url();?>assets/toastr-js/toastr.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
      $("#type").change(function(){
        var type = $("#type").val();
        if (type == 'Menu') {
          $("#icon").show();
          $("#parent").show();
          $("#url").hide();
        }else if (type == 'Sub Menu') {
          $("#icon").hide();
          $("#parent").show();
          $("#url").show();
        }else if (type == 'Header') {
          $("#icon").hide();
          $("#parent").hide();
          $("#url").hide();
        }
        if (type != 'Header') {
          $.ajax({
            type: "POST",
            url: "<?= $list_parent; ?>",
            data: {id : $("#id").val(), type : type},
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){
              $("#list_parent").html(response.list_parent).show();
            },
            error: function (xhr, ajaxOptions, thrownError) {
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
          });
        }
      });
  });

  $(document).ready(function(){
    var type = $("#type").val();
    if (type == 'Menu') {
      $("#icon").show();
      $("#parent").show();
      $("#url").hide();
    }else if (type == 'Sub Menu') {
      $("#icon").hide();
      $("#parent").show();
      $("#url").show();
    }else if (type == 'Header') {
      $("#icon").hide();
      $("#parent").hide();
      $("#url").hide();
    }
    if (type != 'Header') {
      $.ajax({
        type: "POST",
        url: "<?= $list_parent; ?>",
        data: {id : $("#id").val(), type : type},
        dataType: "json",
        beforeSend: function(e) {
          if(e && e.overrideMimeType) {
            e.overrideMimeType("application/json;charset=UTF-8");
          }
        },
        success: function(response){
          $("#list_parent").html(response.list_parent).show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
      });
    }
  });

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
