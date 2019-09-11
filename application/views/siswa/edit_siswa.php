 <section class="content">
      <div class="row">
        <section class="col-lg-9 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Siswa</h3>
              <div class="box-tools pull-right">
                <a href="<?=base_url('master/siswa')?>" class="btn btn-box-tool" data-toggle="tooltip" title="kembali">
                  <i class="fa fa-arrow-circle-o-left"></i>
                </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form method="post" enctype="multipart/form-data" action="<?=base_url('master/siswa/edit/'.$siswa->nis)?>">
              	<div class="row">
              		<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>Nis siswa</label>
              				<input type="number" readonly name="nis" value="<?=$siswa->nis?>" class="form-control">
              				<?=form_error('nis','<small class="text-danger">','</small>')?>
              			</div>
              		</div>
              		<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>Nama siswa</label>
              				<input type="text" value="<?=$siswa->nama_siswa?>" name="nama_siswa" class="form-control">
              				<?=form_error('nama_siswa','<small class="text-danger">','</small>')?>
              			</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="form-group">
              			<div class="col-lg-6 col-xs-12">
              				<label>Email</label>
              				<input type="text" name="email" class="form-control" value="<?=$siswa->email?>">
              				<?=form_error('email','<small class="text-danger">','</small>')?>
              			</div>
              			<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>agama</label>
              				<input type="text" name="agama" class="form-control" value="<?=$siswa->agama?>">
              				<?=form_error('agama','<small class="text-danger">','</small>')?>
              			</div>
              		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="form-group">
              			<div class="col-lg-6 col-xs-12">
              				<label>Kelas</label>
              				<select name="kelas" class="form-control">
              					<?php foreach ($kelas as $x): ?>
              						<option value="<?=$x->id_kelas?>"><?=$x->nama_kelas?></option>
              					<?php endforeach ?>
              				</select>
              			</div>
              			<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>Jurusan</label>
              				<select name="jurusan" class="form-control">
              					<?php foreach ($jurusan as $x): ?>
              						<option value="<?=$x->id_jurusan?>"><?=$x->nama_jurusan?></option>
              					<?php endforeach ?>
              				</select>
              			</div>
              		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="form-group">
              			<div class="col-lg-6 col-xs-12">
              				<label>Tempat</label>
              				<input type="text" name="tempat" class="form-control" value="<?=$siswa->tempat?>">
              				<?=form_error('tempat','<small class="text-danger">','</small>')?>
              			</div>
              			<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>Tanggal Lahir</label>
              				<input type="date" name="tgl_lahir" class="form-control" value="<?=$siswa->tgl_lahir?>">
              				<?=form_error('tgl_lahir','<small class="text-danger">','</small>')?>
              			</div>
              		</div>
              		</div>
              	</div>
               <div class="row">
              		<div class="form-group">
              			<div class="col-lg-6 col-xs-12">
              				<label>Foto</label>
              				<input type="file" name="foto" id="preview" class="form-control" value="<?=set_value('foto')?>">
              				<?=form_error('foto','<small class="text-danger">','</small>')?>
              			</div>
              			<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<img src="#" id="gambar" width="350px" alt="preview gambar">
              			</div>
              			</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>Mulai Masuk</label>
              				<input type="text" name="masuk" value="<?=date_indo($siswa->masuk)?>" readonly class="form-control">
              			</div>
              		</div>
              		<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>Jeni Kelamin</label><br>
              				<input type="radio" name="jk"  value="laki-laki" <?=($siswa->jk == 'laki-laki' ? 'checked' : '')?> >Laki-Laki
              				<input type="radio" name="jk" style="margin-left: 20px" value="perempuan" <?=($siswa->jk == 'perempuan' ? 'checked' : '')?> >Perempuan
              			</div>
              		</div>	
              	</div>
              	<div class="row">
              		<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>Tahun Mulai Ajaran</label>
              				<input type="number" name="tahun_mulai"class="form-control hitung" id="awal" value="<?=$siswa->tahun_mulai?>">
              				<?=form_error('tahun_mulai','<small class="text-danger">','</small>')?>
              			</div>
              		</div>
              		<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>Tahun Akhir Ajaran</label>
              				<input type="number" name="tahun_selesai" class="form-control hitung" id="akhir" readonly value="<?=$siswa->tahun_selesai?>">
              			</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="form-group">
              			<div class="col-lg-6 col-xs-12">
              				<label>Provinsi</label>
              				<select name="province_id" onchange="getCity(this.value)" class="form-control" >
              					<option>Pilih Provinsi</option>
              					<?php foreach ($provinsi as $x): ?>
              						<option value="<?=$x->province_id?>" <?= ($siswa->provinsi == $x->province_id) ? 'selected' : ''?> ><?=$x->province?></option>
              					<?php endforeach ?>
              				</select>
              				<?=form_error('province_id','<small class="text-danger">','</small>')?>
              			</div>
              			<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>Kota</label>
              				<select class="form-control" name="city_id" onchange="getkec(this.value)"></select>
              				<?=form_error('city_id','<small class="text-danger">','</small>')?>
              			</div>
              			</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="form-group">
              			<div class="col-lg-6 col-xs-12">
              				<label>Kecamatan</label>
              				<select name="kecamatan" class="form-control"></select>
              				<?=form_error('kecamatan','<small class="text-danger">','</small>')?>
              			</div>
              			<div class="col-lg-6 col-xs-12">
              				<label>Alamat</label>
              				<textarea name="alamat" class="form-control"><?=$siswa->alamat?></textarea>
              				<?=form_error('alamat','<small class="text-danger">','</small>')?>	
              			</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-lg-6 col-xs-12">
              			<div class="form-group">
              				<label>Password</label>
              				<span class="small text-danger">konfirmai untuk perubahan</span>
              				<input type="password" name="password" class="form-control">
              				<?=form_error('password','<small class="text-danger">','</small>')?>
              			</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-lg-6 col-xs-12">
              			<button type="submit" class="btn btn-block btn-flat btn-primary">Tambah</button>
              		</div>
              		<div class="col-lg-6 col-xs-12">
              			<button type="reset" class="btn btn-block btn-flat btn-danger">Reset</button>
              		</div>
              	</div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
        <section class="col-lg-3 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Waktu</h3>
            </div>
            <div class="box-body text-center">
              <h2 class="jam"></h2>
              <hr>
              <font color="red">
              	<h4><span class="glyphicon glyphicon-exclamation-sign"></span>Perhatian</h4>
              	<h5><i>-masukan provinsi,kota,lalu kecamatan secara berurutan</i></h5>
              	<h5><i>-jangan ada field yang kosong</i></h5>
              </font>
            </div>
          </div>
        </section>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<script>
	function bacaGambar(input){
		if (input.files && input.files[0]) {
			var reader  = new FileReader();
			reader.onload = function(e){
				$('#gambar').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#preview").change(function(){
		bacaGambar(this);
	});

	function getCity(value) {
		$.ajax({
			url: "<?=site_url('master/siswa/kota')?>",
			data: {
				province_id: value,
			},
			dataType:"JSON",
			type:'post',
			success:function(response){
				var ls = '<option>Pilih Kota</option>';
				response.data.map(({city_id, city_name}) => {
					ls += `<option value="${city_id}" >${city_name}</option>`;
				});

				$('[name="city_id"]').html(ls);
			}
		})
	}
	function getkec(value){
		$.ajax({
			url: "<?=site_url('master/siswa/kecamatan')?>",
			data:{
				city_id: value,
			},
			dataType:"JSON",
			type:'post',
			success:function(response){
				var ls = '<option>Pilih Kecamatan</option>';
				response.data.map(({subdistrict_id, subdistrict_name}) =>{
					ls += `<option value=${subdistrict_id}>${subdistrict_name}</option>`
				});
				$('[name="kecamatan"').html(ls);
			}
		})
	}
	$(".hitung").keyup(function(){
		var awal = parseInt($("#awal"). val())
		var hasil = awal + 3;
		$("#akhir").attr("value",hasil)
	});
</script>