<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Tables</h1>
  <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
      <!-- <div class="row">
        <div class="col-sm-6">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Auditee </label>
            <div class="col-sm-6 input-group ">
              <?php echo form_dropdown('auditee', '', '', 'class="form-control select2"'); ?>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Tahun </label>
            <div class="col-sm-3 input-group date">
              <input type="text" class="form-control datepick" data-date-format="yyyy" name="tahun_pkat" id="tahun" readonly="true">
              <div class="input-group-append">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Jenis Audit </label>
            <div class="col-sm-6 input-group ">
              <?php echo form_dropdown('jns_audit', '', '', 'class="form-control"'); ?>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Status </label>
            <div class="col-sm-6 input-group ">
              <?php echo form_dropdown('st_audit', '', 5, 'class="form-control"'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="text-right">
            <button type="button" class="btn btn-info btn-mini" onclick="load_table()"> Cari </button>
          </div>
        </div>
      </div> -->
      <div align="right">
        <a href="#" class="btn btn-success btn-icon-split getModal" style="align:right;">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
          </span>
          <span class="text">Tambah</span>
        </a>
      </div>
      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="5%">No. </th>
              <th>Nama Lengkap</th>
              <th>Username</th>
              <th>Email</th>
              <th>Headline</th>
              <th>Tentang Saya</th>
              <th width="15%">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No. </th>
              <th>Nama </th>
              <th>Jabatan </th>
              <th>Tanggal Lahir </th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody class="row_position">
            <?php $no=0; foreach ($data['data'] as $key => $value) { $no++; ?>
              <?php if ($data['status'] == 200) { ?>
                  <tr id="<?php echo $value['id'] ?>">
                    <td><?= $no;?>.</td>
                    <td><?= $value['nama_lengkap'];?></td>
                    <td><?= $value['username'];?></td>
                    <td><?= $value['email'];?></td>
                    <td><?= $value['headline'];?></td>
                    <td><?= $value['tentang_saya'];?></td>
                    <td>
                      <a href="#" id="<?=$value['id'];?>" class="btn btn-info btn-circle btn-sm getModal">
                        <i class="fas fa-info-circle"></i>
                      </a>
                      <a href="#" id="<?=$value['id'];?>" class="btn btn-danger btn-circle btn-sm deleteData">
                        <i class="fas fa-trash"></i>
                      </a>
                    </td>
                  </tr>
              <?php }else{ ?>
                <td>Tidak Ada Data !</td>
              <?php } ?>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<script type="text/javascript" src="<?= base_url();?>assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/custom.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/vendor/jquery/bootbox.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script>
  $('.datepick').datepicker({
    autoclose: true,
    minViewMode: 2,
    format: 'yyyy',
    orientation: 'bottom auto'
  }).next().on('click', function() {
    $(this).prev().focus();
  });

  $('.datepickYear').datepicker({
    autoclose: true,
    minViewMode: 2,
    orientation: 'bottom auto'
  }).next().on('click', function() {
    $(this).prev().focus();
  });

  $( ".row_position" ).sortable({
          delay: 150,
          stop: function() {
              var selectedData = new Array();
              $('.row_position>tr').each(function() {
                  selectedData.push($(this).attr("id"));
              });
              updateOrder(selectedData);
          }
      });

  function updateOrder(data) {
    bootbox.confirm("Apakah anda yakin akan mengubah urutan ini?", function(result){
      if(result == true) {
        $.ajax({
            url:"<?= $update_list;?>",
            type:'post',
            data:{position:data},
            success: function(){
               toastr.success('Urutan Biodata Berhasil Diubah');
               setTimeout(function () {
                 location.reload(true);
               }, 1500);
            },
        })
      }else{
        toastr.error('Urutan Biodata Tidak Berubah');
        setTimeout(function () {
          location.reload(true);
        }, 1500);
      }
    });
  }

  $(document).ready(function(){
    $('.datepick').datepicker({
      autoclose: true,
      minViewMode: 2,
      format: 'yyyy',
      orientation: 'bottom auto'
    }).next().on('click', function() {
      $(this).prev().focus();
    });

    $('.datepickYear').datepicker({
      autoclose: true,
      minViewMode: 2,
      orientation: 'bottom auto'
    }).next().on('click', function() {
      $(this).prev().focus();
    });

    $(".getModal").click(function(event){
      var id = $(this).attr('id');
        $.ajax({
            url: "<?=$get_data_edit;?>",
            method: "POST",
            data: {id:id},
            success: function(data){
                $('#dataModalSmall').html(data);
                $('#ModalSmall').modal('show');
            }
        });
      });

    $(".deleteData").click(function(event){
      var id = $(this).attr('id');
      bootbox.confirm("Apakah anda yakin akan menghapus data ini?", function(result){
        if(result == true) {
          $.ajax({
              url: "<?=$get_data_delete;?>",
              method: "POST",
              data: {id:id},
              success: function(res){
                var hasil = $.parseJSON(res);
                if (hasil["status"] == 200) {
                   toastr.success(hasil["pesan"]);
                   setTimeout(function () {
                     return hasil["status"];
                   }, 1500);
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
                toastr.error("Data tidak dapat dihapus.");
                result = false;
                return false;
              },
          });
        }
      });
    });
  });
</script>
