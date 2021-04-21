<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?=$judul;?></h6>
    </div>
    <div class="card-body">
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
        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th width="5%">No. </th>
              <th width="15%">Judul</th>
              <th width="15%">Sub Judul</th>
              <th width="28%">Deskripsi</th>
              <th width="29%">Video</th>
              <th width="8%">Aksi</th>
            </tr>
          </thead>
          <tbody class="row_position">
            <?php $no=0; foreach ($data['data'] as $key => $value) { $no++; ?>
              <?php if ($data['status'] == 200) { ?>
                  <tr id="<?php echo $value['id'] ?>">
                    <td><?= $no;?>.</td>
                    <td><?= $value['judul'];?></td>
                    <td><?= $value['sub_judul'];?></td>
                    <td>
                      <div id="less">
                        <?= character_limiter($value['deskripsi'], 200);?>
                        <a href="#" id="load_more">Load More</a>
                      </div>
                      <div id="more" style="display:none">
                        <?= $value['deskripsi'];?>
                        <a href="#" id="load_less">Load Less</a>
                      </div>
                    </td>
                    <td>
                      <video width="300" height="200" controls>
                        <source src="<?= $value['url_video'];?>" type="<?= $value['type_video'];?>">
                      </video>
                    </td>
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
<script type="text/javascript" src="<?= base_url();?>assets/admin/vendor/jquery/bootbox.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="<?= base_url();?>assets/toastr-js/toastr.js"></script>
<script>
  $(document).ready(function(){
    $("#load_more").click(function(){
      $("#more").show();
      $("#less").hide();
    });
    $("#load_less").click(function(){
      $("#less").show();
      $("#more").hide();
    });

    $(".getModal").click(function(event){
      var id = $(this).attr('id');
        $.ajax({
            url: "<?=$get_data_edit;?>",
            method: "POST",
            data: {id:id},
            success: function(data){
                $('#dataModalLarge').html(data);
                $('#ModalLarge').modal('show');
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
