<!doctype html>
<html lang="en">

<head>

	<?php $this->load->view('_parts/style') ?>

	<style>
		/* Flipping the video as it was not mirror view */
video {
  transform: scaleX(-1);
  /* margin-top: 5px; */
}

/* Flipping the canvas image as it was not mirror view */
#canvas {
  transform: scaleX(-1);
  filter: FlipH;
}
	</style>
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

							<h3 class=""><strong>Tambah  Rumah Ibadah</strong></h3>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="card">
									<div class="card-body">
										<div class="p-0">
											<p>Berikut adalah form data Rumah ibadah. silahkan lengkapi data-data dibawah ini dengan lengkap dan benar</p>
											<hr />
											<form action="<?= site_url('admin/rumahibadah/add') ?>" method="POST" enctype="multipart/form-data"  onsubmit="return validateForm();">
												<div class="form-group">
													<label>Nama Rumah ibadah</label>
													<input type="text" name="name" class="form-control" value="<?= set_value('name') ?>">
													<?= form_error('name') ?>
												</div>

												<div class="form-group">
													<label>Deskripsi</label>
													<textarea class="form-control" name="desc" rows="6" placeholder=""><?= set_value('desc') ?></textarea>
												</div>

												<!-- <div class="row">
													<div class="col-6"><label>Latitude</label>
														<input type="text" id="lat" name="lat" value="<?= set_value('lat') ?>" class="form-control">
														<?= form_error('lat') ?>
													</div>
													<div class="col-6"><label>Longitude</label>
														<input type="text" id="lng" name="lng" value="<?= set_value('lng') ?>" class="form-control">
														<?= form_error('lng') ?>
													</div>
												</div> -->

												<!-- Ambil node otomatis -->

												<br />
												<div class='form-group'>
                   									 <input type='button' value='Get Location' onclick='getLocationConstant()' />
                 								 </div>	

                 								 <div class='form-group'>
                    								<label>Latitude</label>
                    								<input class='form-control'  name='lat' type='text' id='Latitude' value="<?= set_value('lat') ?>" readonly >
                  								</div>				
                							 	 <div class='form-group'>
                							  	  <label>Longitude</label>
                							  	  <input class='form-control'  name='lng' type='text' id='Longitude' value="<?= set_value('lng') ?>" readonly>
                							 	 </div>

												  <div class="form-group mt-2">
    <label for="capturedImage">Capture Image</label>
    
    <input type="file" name="capturedImage" id="capturedImage" style="display: none;">
  </div>
												<div class="form-group mt-3">
													<a href="<?= site_url('admin/rumahibadah') ?>" class="btn btn-light">Kembali</a>
													<button class="btn btn-primary" type="submit">Simpan</button>
												</div>

											</form>

											<button type="button" id="capture">Capture</button>
											<canvas id="canvas" width="400" height="300"></canvas>
											<video id="video" width="400" height="300" autoplay></video>

											



										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="card">
									<div class="card-body">
										<div id="map" style="height: 450px;width: 100%;"></div>
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
	<script type="text/javascript">
		mapboxgl.accessToken = 'pk.eyJ1IjoiZWZoYWwiLCJhIjoiY2ptOXRiZ3k2MDh4bzNrbnljMjk5Z2d5aSJ9.8dSNgeAjpdTlZ3x-b2vsog';
		var map = new mapboxgl.Map({
			container: 'map', // container id
			style: 'mapbox://styles/mapbox/streets-v9', // stylesheet location
			center: [106.97161383372077, -6.224593576068031], // starting position [lng, lat]
			zoom: 10, // starting zoom
			logoPosition: 'top-right',
		});

		var marker;
		map.on('click', function(e) {
			if (marker) {
				marker.remove();
			}
			marker = new mapboxgl.Marker({
					color: "#7d000c",
				})
				.setLngLat(e.lngLat)
				.addTo(map);
			$("#lat").val(e.lngLat.lat);
			$("#lng").val(e.lngLat.lng);
		})

		var markers = [];

		$.ajax({
			'url': "<?= site_url('admin/graph/ajax/data') ?>",
			'type': 'POST',
			success: function(e) {
				var data_obj = JSON.parse(e);
				data_obj.forEach(function(i) {
					var color = i.type == '-' ? '#01f254' : '#015ff2';
					markers.push(new mapboxgl.Marker({
							color: color,
						})
						.setLngLat([i.lng, i.lat])
						.setPopup(new mapboxgl.Popup().setHTML(`
						<div class="card" style="width: 10rem;">
						<img src="<?= base_url('uploads/') ?>${i.picture}" class="card-img-top" alt="...">
							<div class="card-body">
								<h6 class="card-title">${i.name}</h6>
								${i.type == 'object' ? `<a href="<?= site_url('hotel/detail/') ?>${i.id}" class="btn btn-primary">Lihat detail</a>` : ''}
								</div>
							</div>
						`)) // add popup
						.addTo(map));
				})
			}

		});
		</script>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

		
		<!-- ambil node secara otomatis -->
		<script type="text/javascript">
			function getLocationConstant() {
					if (navigator.geolocation) {
							navigator.geolocation.getCurrentPosition(onGeoSuccess, onGeoError);
					} else {
							alert("Your browser or device doesn't support Geolocation");
					}
			}

			// If we have a successful location update
			function onGeoSuccess(event) {
					document.getElementById("Latitude").value = event.coords.latitude;
					document.getElementById("Longitude").value = event.coords.longitude;
					document.getElementById("Position1").value = event.coords.latitude + ", " + event.coords.longitude;

			}

			// If something has gone wrong with the geolocation request
			function onGeoError(event) {
					alert("Error code " + event.code + ". " + event.message);
			}
		</script>	
		
		<script>
// Dapatkan elemen video, tombol capture, dan elemen canvas
const video = document.getElementById('video');
const captureButton = document.getElementById('capture');
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
const fileInput = document.getElementById('userfile');

function captureImage() {
  // Gambar video ke elemen canvas
  context.drawImage(video, 0, 0, canvas.width, canvas.height);

  // Ubah gambar ke data URL
  const imageData = canvas.toDataURL('uploads');

  // Buat objek Blob dari data gambar
  const blob = dataURItoBlob(imageData);

  // Buat objek File dari objek Blob
  const file = new File([blob], 'image.png', { type: 'image/png' });

  // Simpan file dalam elemen input file
  const capturedImageInput = document.getElementById('capturedImage');
  capturedImageInput.files = [file];
}

// ...

// Tambahkan event listener untuk tombol capture
captureButton.addEventListener('click', captureImage);


// Periksa apakah browser mendukung getUserMedia untuk mengakses webcam
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
  // Izinkan akses ke video dari webcam
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
      // Setel objek stream sebagai sumber video
      video.srcObject = stream;
    })
    .catch(function (error) {
      console.log('Error accessing webcam:', error);
    });

  // Tambahkan event listener untuk tombol capture
  captureButton.addEventListener('click', captureImage);
} else {
  console.log('getUserMedia is not supported in this browser.');
}

// Fungsi utilitas untuk mengubah data URL menjadi objek File
function dataURLtoFile(dataURL, filename) {
  const arr = dataURL.split(',');
  const mime = arr[0].match(/:(.*?);/)[1];
  const bstr = atob(arr[1]);
  let n = bstr.length;
  const u8arr = new Uint8Array(n);
  while (n--) {
    u8arr[n] = bstr.charCodeAt(n);
  }
  return new File([u8arr], filename, { type: mime });
}



		</script>

</body>

</html>
