<!doctype html>
<html lang="en">

<head>

	<?php $this->load->view('_parts/style') ?>
</head>

<body>
	<!-- Begin page -->
	<div id="layout-wrapper">



		<?php $this->load->view('_parts/header') ?>
		<?php $this->load->view('_parts/sidebar') ?>

		<!-- ============================================================== -->
		<!-- Start right Content here -->
		<!-- ============================================================== -->
		<div class="main-content" style="margin-top:100px;">
			<div class="page-content">
				<div class="container-fluid">
					<div class="page-content-wrapper">
						<div class="mt-3">
							<h3 class=""><strong><?= $title ?></strong></h3>
						</div>

						<div class="row ">
							<div class="col-12">
								<div class="card text-center">
									<div class="card-header">
										Cara Penggunaan Aplikasi
									</div>
									<div class="card-body">
										<h5 class="card-title"> Aplikasi Pemetaan Rumah Ibadah <h5>
											<p>
											Aplikasi ini di rancang hanya untuk mencari lokasi yang di tuju. Aplikasi ini merepkan algoritma Haversine untuk menghitung jarak antara rumah ibadah dengan lokasi pengguna.
									<h2>Langkah Awal</h2>

									<div class="card" style="width: 50rem;">
									  <img src="<?= base_url() ?>assets/tutor/1.jpg " class="card-img-top" alt="...">
									  <div class="card-body">
									    <p class="card-text">Tahap awal adalah melakukan pencarian pada klik menu pencarian rute kemudian tentukan tujuan. </p>
									  </div>
									</div>

									<h2>Langkah Ke 2</h2>
									<div class="card" style="width: 50rem;">
									  <img src="<?= base_url() ?>assets/tutor/2.jpg " class="card-img-top" alt="...">
									  <div class="card-body">
									    <p class="card-text">Tahap ke 2 adalah menentukan titik kordinat awal perjalan ditahapan bertepatan di Kelurahan Kranji.</p>
									  </div>
									</div>

									<h2>Langkah ke 3</h2>
									<div class="card" style="width: 50rem;">
									  <img src="<?= base_url() ?>assets/tutor/3.jpg " class="card-img-top" alt="...">
									  <div class="card-body">
									    <p class="card-text">Tahap ke 3 menentukan lokasi tujuan. jika sudah maka dapat menentukan atau menarik garis jalur untuk tombol membuat garis berda di sebelah kanan atas. klik dari awal kordinat yg di lambangkan marker warna merah dan biru untuk tujuan. tarik garis merah ke titik marker biru selanjutnya tap</p>
									  </div>
									</div>

									<h2>Langkah ke 4</h2>
									<div class="card" style="width: 50rem;">
									  <img src="<?= base_url() ?>assets/tutor/4.jpg " class="card-img-top" alt="...">
									  <div class="card-body">
									    <p class="card-text">Tahap 4 dari hasil penarikann garis akan terlihat jalur rute perjalan dan jumlah jarak dan waktu tempuh.</p>
									  </div>
									</div>
									<div class="card-footer text-muted">
										@Pemetaan Rumah Ibadah
									</div>
								</div>
							</div>
						</div>

					</div>
				</div> <!-- container-fluid -->
			</div>
			<!-- End Page-content -->

			<?php $this->load->view('_parts/footer') ?>
		</div>
		<!-- end main content-->

	</div>
	<!-- END layout-wrapper -->

	<?php $this->load->view('_parts/js') ?>
</body>
<script>
	$('.carousel').carousel();
</script>

</html>
