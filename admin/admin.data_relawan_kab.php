<?php
	require_once "../include/class.function.php";

	$dbo = new MyFunction();
	$relawan = $dbo->getDataRelawan(1); // 1 -> DPRD Kabupaten
?>

<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">Data Relawan</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<ul class="breadcrumb">
			<li><a href="javascript:void(0);">DPRD Kabupaten</a></li>
			<li class="active">Data Relawan</li>
		</li>
	</div>
	<!-- /.col-lg-12 -->
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a href="?page=form_add_relawan_kab">
					<button type="button" class="btn btn-outline btn-primary"><i class="fa fa-plus"></i>&nbsp;Tambah Data Baru</button>
				</a>
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-basic">
					<thead>
						<tr>
							<th>No.</th>
							<th>NIK</th>
							<th>Nama Relawan</th>
							<th>L/P</th>
							<th>No. Telp/HP</th>
							<th>Alamat</th>
							<th>Pilihan</th>
						</tr>
					</thead>
					<tbody>
					<?php if (count($relawan) >= 1) { ?>
						<?php $no = 1; foreach ($relawan as $data) { ?>
						<tr>
							<td align="center"><?php echo $no; ?></td>
							<td><?php echo $data['nik']; ?></td>
							<td><?php echo $data['nama_relawan']; ?></td>
							<td align="center"><?php echo $data['jenis_kelamin']; ?></td>
							<td><?php echo $data['no_telp']; ?></td>
							<td><?php echo $data['alamat'].", ".$data['nama_kelurahan']." - ".$data['kode_pos']; ?></td>
							<td>
								<button type="button" class="btn btn-outline btn-primary btn-xs"><i class="fa fa-edit"></i>&nbsp;Edit</button>
								<button type="button" class="btn btn-outline btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="fa fa-times"></i>&nbsp;Hapus</button>
							</td>
						</tr>
						<?php $no++; } ?>
					<?php } ?>
					</tbody>
				</table>
				<!-- /.table-responsive -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>