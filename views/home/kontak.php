<br><br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h3 class="card-title">Lokasi Perusahaan</h3><br>
					<div id="map" style="width: 100%; height: 400px;"></div>
				</div>
			</div>
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<img src="/assets/img/building.jpg" alt="placeholder+image">
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card">
				<div class="card-body">
					<p><strong>PT. USAHA JAYA EXPRESS</strong></p><hr>
					<p>Jln. Olo Ladang No. 3</p>
					<p>Padang - Sumatera Barat 25116</p>
					<p>Tlp : 0751 – 36728</p>
					<p>Fax : 0751 – 31715</p>
					<p>Email : usahajayaexpress@gmail.com</p>
				</div>
			</div>
		</div>
	</div>
</div>

<br><br>

<script>
	function initMap() {
		var ptuje = {lat: -0.943425, lng: 100.353815};
		var map = new google.maps.Map(
			document.getElementById('map'), {zoom: 18, center: ptuje});
		var marker = new google.maps.Marker({position: ptuje, map: map});
	}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1DchaaiOU7AVAxzesciqvNucinuWWeqI&callback=initMap" async defer></script>