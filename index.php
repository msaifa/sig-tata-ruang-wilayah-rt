<?php 
	include("lib_func.php");
	
    $allCoords = [];
	$allColors = [];
    $link=koneksi_db();
    
    	$sql="SELECT * FROM lahan_petani 
          ORDER BY kode_lahan asc";
		$res=mysqli_query($link,$sql); 
		$banyakrecord=mysqli_num_rows($res);
		if($banyakrecord > 0) {
			while ($row=mysqli_fetch_array($res)) {
				$data = $row['points'];
				$luas_lahan = $row['luas_lahan'];
				$warna = $row['warna'];

				preg_match_all('/\((.*?)\)/', $data, $matches);
         
		        array_push($allCoords, $matches[1]);
		        array_push($allColors, $warna);
			}
		}

		// echo '<pre>';
		// print_r($allColors);
		// echo '</pre>';
		// die();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Pendataan Tata Ruang</title>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBw6bnAk0C2jIDDbz_dVRso9gUEnHLTH68&sensor=false"></script>
	<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="polygon.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript">
	$(function(){
		//create map
		var garutCikandangCenter=new google.maps.LatLng(-7.315273473190408, 112.7272606931132);
		var myOptions = {
			zoom: 17,
			center: garutCikandangCenter,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById('main-map'), myOptions);
		
		var creator = new PolygonCreator(map);		 

		// set polygon data to the form hidden field
		$('#map-form').submit(function () {
		$('#map-coords').val(creator.showData());
		});


		<?php 
			if (count($allCoords) > 0): 
				foreach($allCoords as $key => $coords){
		?>
					// create
					var polygonCoords = [<?php
										foreach ( $coords as $i=>$coord ):
											echo 'new google.maps.LatLng('.$coord.')';
											if ( $i<=count($coords)) {
												echo ',';
											}
										endforeach;?>];


					// construct the polygon
					polygon = new google.maps.Polygon({
										paths: polygonCoords,
										strokeColor: "#<?= $allColors[$key] ?>",
										strokeOpacity: 0.8,
										strokeWeight: 2,
										fillColor: "#<?= $allColors[$key] ?>",
										fillOpacity: 0.35
					});

					// show polygon on the map
					polygon.setMap(map);
					
					var infowindow = new google.maps.InfoWindow({
							content: 'Luas Lahan : <?php echo "$luas_lahan"; ?>'
						});
						// Menambahkan event Click pada marker
						google.maps.event.addListener(polygon, 'click', function() {		
							// Memanggil 'open method' InfoWindow
							infowindow.open(map, polygon);
							});
			
		<?php 
				}
			endif;
		?>


		 //reset
		 $('#reset').click(function(){ 
		 		creator.destroy();
		 		creator=null;
		 		
		 		creator=new PolygonCreator(map);
		 });		 
		 
		 //show paths
		 $('#showData').click(function(){ 
		 		$('#dataPanel').empty();
		 		if(null==creator.showData()){
		 			$('#dataPanel').append('Please first create a polygon');
		 		}else{
		 			$('#dataPanel').append(creator.showData());
		 		}
		 });
		 
		 //show color
		 $('#showColor').click(function(){ 
		 		$('#dataPanel').empty();
		 		if(null==creator.showData()){
		 			$('#dataPanel').append('Please first create a polygon');
		 		}else{
		 				$('#dataPanel').append(creator.showColor());
		 		}
		 });


	});	
	</script>
</head>
<body style="background-color: #888;">
	<div style="margin:auto;  width: auto; ">
		<div id="main-map" style="height: 500px;">
		</div>
		<center>
			<form action="index.php" method="POST" id="map-form">         
	            <input type="hidden" name="coords" id="map-coords" value=""/>
				<table cellspacing="10">
					<tr>
	            		<td><label style="color: #efefef;">Nama Pemilik</label></td>
						<td><input type="text" name="nama_pemilik" id="nama_pemilik" ></input></td>
					</tr>
					<tr>
						<td><label style="color: #efefef;">Luas Lahan</label></td>
						<td><input type="number" name="luas_lahan" id="luas_lahan"></input><br></td>
					</tr>
					<tr>
						<td><input type="submit" value="Save" style="border-radius:5px; width: 4.4cm; 
	height: 0.8cm;"/></td>
						<td><input type="reset" value="Reset"style="border-radius:5px; width: 4.4cm; 
	height: 0.8cm;"/></td>            	
				</table>
	        </form>
		</center>
	</div>
	<div id="side">
		<input style="font-size:14px; margin-left: 30px; border-radius:5px; width: 9cm;" id="reset" value="Reset Marker Polygon" type="button" class="navi"/>
		<input style="font-size:14px; margin-left: 30px; border-radius:5px; width: 9cm;" id="showData"  value="Show Paths" type="button" class="navi"/>
		<div   id="dataPanel" style="margin-left: 30px; background-color: #efefef;">
		</div>
	</div>
	<br>
	<br>
	<table border="1" width="80%" style=" background-color: #efefef; margin-left: 120px;">
		<tr>
			<th>No.</th>
			<th>Nama Pemilik</th>
			<th>Luas Lahan</th>
			<th>Action</th>
		</tr>
		<?php 
			$sql="SELECT * FROM lahan_petani 
					ORDER BY kode_lahan asc";
			$res=mysqli_query($link,$sql); 
			$no = 1;
			while ($row=mysqli_fetch_array($res)) {
				$data = $row['nama_pemilik'];
				$luas_lahan = $row['luas_lahan'];
				$warna = $row['warna'];
				$id = $row['kode_lahan'] ;

				echo "<tr style='background-color: #{$warna}'>";
				echo "<td>$no</td>";
				echo "<td>$data</td>";
				echo "<td>$luas_lahan</td>";
				echo "<td><a href='?hapus=$id'>Hapus</a></td>";
				echo "</tr>";

				$no++;
			}
		?>
	</table>
	<?php 
		if (!empty($_POST)) {
	        $luas_lahan=$_POST['luas_lahan'];
	        $nama_pemilik=$_POST['nama_pemilik'];
	        $coordinats=$_POST['coords'];
	        $warna = random_color() ;

	    	echo "$luas_lahan <br>";
	    	echo "$coordinats";
	    	$save_lahan = mysqli_query($link,"INSERT INTO lahan_petani VALUES('','$nama_pemilik','$warna','$coordinats','$luas_lahan')");
	    	if ($save_lahan) {
	    		
	    		?> 
			      <script type='text/javascript'>
			              window.alert('Data lahan berhasil disimpan!')
			      </script>
			      <script>document.location='index.php'</script>
			    <?php
			    }
			    else {
			      
			    ?> 
			      <script type='text/javascript'>
			              window.alert('Terjadi kesalahan dalam penyimpanan data lahan dengan kesalahan <?php echo mysql_error($link);?>. Silahkan diulang lagi!<br>')
			            </script>
			            <script>document.location='index.php'</script>
			    <?php
			    }
	    	
	    } 

		if (isset($_GET['hapus']) && $_GET['hapus'] > 0){
			$id = $_GET['hapus'];
			$del_lahan = mysqli_query($link,"DELETE from lahan_petani where kode_lahan = $id");

			if ($del_lahan){
				header("Location: index.php");
				die();
			}
		}
	 ?>
</body>
</html>
