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

							<h3 class=""><strong>Tambah  Rumah Ibadah </strong></h3>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="card">
									<div class="card-body">
										<div class="p-0">
											<p>Berikut adalah form data Rumah ibadah. silahkan lengkapi data-data dibawah ini dengan lengkap dan benar</p>
											<hr />
											<form action="<?= site_url('admin/rumahibadah/add') ?>" method="POST" enctype="multipart/form-data">
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

												<h5>Image</h5>
												<div class="form-group mt-2">													
													<canvas id="canvas" width="475" height="475" alt="Canvas image" name="userfile"></canvas>
												
												</input>
													<!-- Webcam video snapshot -->
													<?= $this->session->userdata('errorUpload') ?>
												</div>
<div class="form-group mt-3">
													<a href="<?= site_url('admin/rumahibadah') ?>" class="btn btn-light">Kembali</a>
													<button class="btn btn-primary">Simpan</button>
												</div>

											</form>



											<!-- Percobaan -->
											<br>
											<div class="row">
														<div class="col-lg-6">
														<!-- Here we stream video from the webcam -->
														<video id="video" playsinline autoplay alt="Webcam video stream"></video>
														<h4>
															Carema webcam
															<button class="btn btn-primary" id="btnCapture">Ambil foto</button>
														</h4>
														</div>

														
  													</div>


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
		
			<!-- Webcam -->
		<script>
const video = document.querySelector("#video");

// Basic settings for the video to get from Webcam
const constraints = {
  audio: false,
  video: {
    width: 300,
    height: 300
  }
};

// This condition will ask permission to user for Webcam access
if (navigator.mediaDevices.getUserMedia) {
  navigator.mediaDevices.getUserMedia(constraints)
    .then(function(stream) {
      video.srcObject = stream;
    })
    .catch(function(err0r) {
      console.log("Something went wrong!");
    });
}

function stop(e) {
  const stream = video.srcObject;
  const tracks = stream.getTracks();

  for (let i = 0; i < tracks.length; i++) {
    const track = tracks[i];
    track.stop();
  }
  video.srcObject = null;
}


// Below code to capture image from Video tag (Webcam streaming)
const btnCapture = document.querySelector("#btnCapture");
const canvas = document.getElementById('canvas');

btnCapture.addEventListener('click', function() {
  const context = canvas.getContext('2d');
  // Capture the image into canvas from Webcam streaming Video element
  context.drawImage(video, 0, 0);
});

// Upload image to server - ajax call - with the help of base64 data as a parameter
const btnSave = document.querySelector("#btnSave");

btnSave.addEventListener('click', async function() {
  // Below new canvas to generate flip/mirror image from existing canvas
  const destinationCanvas = document.createElement("canvas");
  const destCtx = destinationCanvas.getContext('2d');

  destinationCanvas.height = 300;
  destinationCanvas.width = 300;

  destCtx.translate(video.videoWidth, 0);
  destCtx.scale(-1, 1);
  destCtx.drawImage(document.getElementById("canvas"), 0, 0);

  // Get base64 data to send to server for upload
//   let imagebase64data = destinationCanvas.toDataURL("image/png");
//   imagebase64data = imagebase64data.replace('data:image/png;base64,', '');

});
		</script>

</body>

</html>
