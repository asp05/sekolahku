<!-- Main content -->
    <section class="content">
      <div class="row">
        <section class="col-lg-3 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Waktu</h3>
            </div>
            <div class="box-body">
              <form id="form_filter">
                <div class="form-group">
                  <label>Jurusan</label>
                  <select name="jurusan" id="jurusan" class="form-control">
                    <option value="" >Pilih jurusan</option>
                      <?php foreach ($jurusan as $x): ?>
                        <option value="<?=$x->id_jurusan?>"><?=$x->nama_jurusan?></option>
                      <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" id="nama" class="form-control">
                </div>
                <div class="form-group">
                  <div class="col-lg-6 col-xs-12">
                    <button type="button" class="btn btn-primary btn-block btn-flat" id="filter">Cari</button>
                  </div>
                  <div class="col-lg-6 col-xs-12">
                    <button type="button" class="btn btn-danger btn-block btn-flat" id="reset">reset</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>
        <section class="col-lg-9 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Table Master Siswa</h3>
              <div class="box-tools pull-right">
                <a class="btn btn-box-tool" id="reload_table()" data-toggle="tooltip" title="Refresh">
                  <i class="fa fa-refresh"></i>
                </a>
                <a href="<?=base_url('master/siswa/tambah')?>" class="btn btn-box-tool" data-toggle="tooltip" title="Tambah">
                  <i class="fa fa-plus"></i>
                </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table table-responsive">
              <table class="table table-striped table-hover tabel_data">
                <thead>
                  <tr>
                  <th>No</th>
                  <th>Nis</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>jurusan</th>
                  <th>Agama</th>
                  <th>Tempat Tanggal Lahir</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                  <tr>
                  <th>No</th>
                  <th>Nis</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>jurusan</th>
                  <th>Agama</th>
                  <th>Tempat Tanggal Lahir</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<script>
  var table
  $(document).ready(function(){
    table = $('.tabel_data').DataTable({
      "processing"  : true,
      "serverSide"  : true,
      "order"       : [],
      "ajax" : {
        "url" :  "<?php echo base_url('master/siswa/ajax_list') ?>",
        "type":   "POST",
        "data": function(data){
          data.jurusan = $('#jurusan').val();
          data.nama = $('#nama').val();
        }
      },
      "language" :{
        "sEmptyTable" : "Tidak ada data",
       
        "paginate"  : {
          "next"  : "Berikutnya",
          "previous" : "Sebelumnya"
        },
        "zeroRecords" : "Data tidak di temukan",
        "lengthMenu"  : "Menampilkan _MENU_ data",
        "loadingRecords": "Mohon Tunggu",
        "processing"  : "Mohon Tunggu",
        "info":           "Menampilkan _START_ to _END_ of _TOTAL_ entries",
        "infoEmpty":      "Menampilkan 0 sampai 0 dari 0 data",
        "infoFiltered"  : "(Memfilter dari _MAX_ total data )",
      },
      "columDefs": [
      {
        "targets"  : [0],
        "orderable"   : false,
      },
      ],
    });
    $('#filter').click(function(){
      table.ajax.reload();
    });
    $('#reset').click(function(){ 
        $('#form-filter')[0].reset();
        table.ajax.reload(); 
    });
    $('#reload_table').click(function(){
      table.ajax.reload();
    });
  });
</script>