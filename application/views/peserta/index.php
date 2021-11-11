<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<style type="text/css">
		td {
			vertical-align: middle !important;
		}
		table .form-control
		{
			padding:  0 !important;
		}
		.input-group-text {
			cursor: pointer;
		}
	</style>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>
				<div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                    </div>
                    <hr>
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-header"><strong><?= $title ?></strong></div>
                                <div class="card-body">
                                    <form id="form-add-kuis" method="POST" action="<?= base_url('peserta/tambah') ?>" accept-charset="utf-8">
                                        <input type="hidden" name="id" id="id" value="<?= ((isset($getPeserta)) ? $getPeserta->id : '') ?>">
                                        
                                        <div class="form-group">
                                            <label>Pelatihan</label>
                                            <select name="pelatihan" id="pelatihan" class="form-control">
                                                <?php foreach($listPelatihan as $pelatihan) { ?>
                                                    <option <?= ((isset($getPeserta) && $getPeserta->id_pelatihan == $pelatihan->id) ? 'selected' : '') ?> value="<?= $pelatihan->id;?>"><?= $pelatihan->judul; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" value="<?= ((isset($getPeserta)) ? $getPeserta->nama : '') ?>" name="nama" id="nama" class="form-control" required >
                                        </div>

                                        <div class="form-group">
                                            <label>Bisnis</label>
                                            <input type="text" value="<?= ((isset($getPeserta)) ? $getPeserta->bisnis : '') ?>" name="bisnis" id="bisnis" class="form-control" required >
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" value="<?= ((isset($getPeserta)) ? $getPeserta->email : '') ?>" name="email" id="email" class="form-control" required >
                                        </div>

                                        <div class="form-group">
                                            <label>Nomor HP</label>
                                            <input type="text" value="<?= ((isset($getPeserta)) ? $getPeserta->nomor : '') ?>" name="nomor" id="nomor" class="form-control" required >
                                        </div>

                                        <div class="form-group">
                                            <div class="submit">
                                                <button type="submit" id="btn-kirim" class="btn btn-primary btn-user btn-block"><?= ((isset($getPeserta)) ? "Simpan" : "Tambah") ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>				
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
		          	<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header"><strong>List Pelatihan</strong></div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<td>No</td>
												<td>Pelatihan</td>
												<td>Nama</td>
												<td>Bisnis</td>
												<td>Email</td>
												<td>Nomor HP</td>
												<td>aksi</td>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($listPeserta as $peserta){  ?>
												<tr>
													<td><?= $peserta->id ?></td>
													<td><?= $peserta->judul ?></td>
													<td><?= $peserta->nama ?></td>
													<td><?= $peserta->bisnis ?></td>
													<td><?= $peserta->email ?></td>
													<td><?= $peserta->nomor ?></td>
													<td>
                                                        <button class='btn btn-success' onclick='confirm_edit(this); return false;' href='<?= $peserta->id ?>'><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                        <button class='btn btn-danger' onclick='confirm_delete(this); return false;' href='<?= $peserta->id ?>'><i class="fa fa-trash-o" aria-hidden="true"></i></button>
														<button class='btn btn-warning cetakSertifikat' href='<?= $peserta->id ?>'><i class="fa fa-download" aria-hidden="true"> Sertifikat</i></button>
														<button class='btn btn-warning cetakIdCard' href='<?= $peserta->id ?>'><i class="fa fa-download" aria-hidden="true"> ID Card</i></button>
                                                    </td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
		          	</div>
				</div>
                </div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>

    <script>

		$(document).ready(function() {
			$(".cetakSertifikat").click(function(){
				var id = $(this).attr('href');
				if ( id != undefined ) {
					$.ajax({
						type: 'GET',
						url: '<?= base_url('peserta/sertifikat/') ?>'+id,
						success: function (result) {
							parse = JSON.parse(result);
							if ( parse.status == false ) alert(parse.message);
							alert(parse.message);
							window.open(parse.url, '_blank').focus();
						},
						error: function (request, status, error) {
							console.log(error);
						}
					});
				}
			}); 

			$(".cetakIdCard").click(function(){
				var id = $(this).attr('href');
				if ( id != undefined ) {
					$.ajax({
						type: 'GET',
						url: '<?= base_url('peserta/idcard/') ?>'+id,
						success: function (result) {
							parse = JSON.parse(result);
							if ( parse.status == false ) alert(parse.message);
							alert(parse.message);
							window.open(parse.url, '_blank').focus();
						},
						error: function (request, status, error) {
							console.log(error);
						}
					});
				}
			}); 
		});

        function confirm_edit(data){
			Swal.fire({
				title: 'Ingin Edit?',
				text: "",
				icon: 'warning',
				showCancelButton: true,
				cancelButtonColor: '#d33',
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Ya, Edit!',
				reverseButtons: true
			}).then((result) => {
			if (result.isConfirmed) {
				location.href = "<?= base_url('peserta/index') ?>/"+data.getAttribute("href");
			}
			})
		}

		function confirm_delete(data){
			Swal.fire({
				title: 'Hapus ?',
				text: "",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Hapus!',
				reverseButtons: true
			}).then((result) => {
			if (result.isConfirmed) {
				location.href = "<?= base_url('peserta/hapus') ?>/"+data.getAttribute("href");
			}
			})
		}
    </script>    

	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>