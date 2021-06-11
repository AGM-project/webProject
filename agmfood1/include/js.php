<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js">
    </script>
    <script src="vendor/mapbox/mapbox-gl.js"></script>
    <script src="vendor/mapbox/mapbox-gl-geocoder.min.js"></script>
    <!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
    <script src="vendor/mapbox/es6-promise.min.js"></script>
    <script src="vendor/mapbox/es6-promise.auto.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    </script>

        <!-- preview gambar -->
        <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('.previewGambar').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }
        $(".inputGambar").change(function() {
        readURL(this);
        });
        //=======================================================================//
        function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('.previewGambar2').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
        }
        $(".inputGambar2").change(function() {
        readURL2(this);
        });
    </script>
    

    <!-- compress gambar -->
    <script>
        function compressImage($source, $destination, $quality) { 
            // mendapatkan info gambar 
            $imgInfo = getimagesize($source); 
            $mime = $imgInfo['mime']; 
            
            // membuat gambar baru dari file sumber
            switch($mime){ 
                case 'image/jpeg': 
                    $image = imagecreatefromjpeg($source); 
                    break; 
                case 'image/png': 
                    $image = imagecreatefrompng($source); 
                    break; 
                case 'image/gif': 
                    $image = imagecreatefromgif($source); 
                    break; 
                default: 
                    $image = imagecreatefromjpeg($source); 
            } 
            
            // menyimpan gambar 
            imagejpeg($image, $destination, $quality); 
            
            // mengembalikan gambar yang dikompres 
            return $destination; 
        } 
        
        
        // path untuk file yang diupload
        $uploadPath = "uploads/"; 
        
        // jika form upload disubmit 
        $status = $statusMsg = ''; 
        if(isset($_POST["submit"])){ 
            $status = 'error'; 
            if(!empty($_FILES["gambar"]["name"])) { 
                // info file 
                $fileName = basename($_FILES["gambar"]["name"]); 
                $imageUploadPath = $uploadPath . $fileName; 
                $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
                
                // hanya membolehkan format file tertentu 
                $allowTypes = array('jpg','png','jpeg'); 
                if(in_array($fileType, $allowTypes)){ 
                    // sumber gambar sementara 
                    $imageTemp = $_FILES["gambar"]["tmp_name"]; 
                    
                    // mengompres ukuran gambar 25% dan upload gambar 
                    $compressedImage = compressImage($imageTemp, $imageUploadPath, 75); 
                    
                    if($compressedImage){ 
                        $status = 'Sukses'; 
                        $statusMsg = "Gambar berhasil dikompres."; 
                    }else{ 
                        $statusMsg = "Kompres gambar gagal!"; 
                    } 
                }else{ 
                    $statusMsg = 'Maaf, hanya file JPG, JPEG, dan PNG yang dibolehkan untuk diupload.'; 
                } 
            }else{ 
                $statusMsg = 'Silakan pilih file gambar untuk diupload.'; 
            } 
        } 
        
        // menampilkan status 
        echo $statusMsg; 
        
    </script>

    <!-- Tanggal Indo-->
    <script>
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth();
        var thisDay = date.getDay(),
            thisDay = myDays[thisDay];
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        document.getElementById('tanggalnow').innerHTML = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
    </script>



    <!-- Search Table -->
    <script>
                $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>

    <!-- Filter Status tabel -->
    <script>
    function filterText()
	{  
		var rex = new RegExp($('#filterText').val());
		if(rex =="/all/"){clearFilter()}else{
			$('.content').hide();
			$('.content').filter(function() {
			return rex.test($(this).text());
			}).show();
	    }
	}
    function clearFilter()
	{
		$('.filterText').val('');
		$('.content').show();
	}
    </script>

    <!-- Peta aku peta aku peta -->
    
    <script>

    mapboxgl.accessToken = 'pk.eyJ1IjoiYWdhbWFyaWEiLCJhIjoiY2tqbm10NXYwMDB4ODJ5bzVja3I5bGR5eiJ9.c0ARJr3B00xq4sp7Up1G4w';

    var bounds = [
        [106.883572, -6.305694], // Southwest coordinates
        [107.024674, -6.149181] // Northeast coordinates
        ];

    var coordinates = document.getElementById('coordinates');
    var map = new mapboxgl.Map({
        container: 'map', // container id
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [106.98844, -6.19239], // starting position
        zoom: 14, // starting zoom
        maxBounds: bounds // Sets bounds as max
    });

    var toko = new mapboxgl.Marker({
        color: "yellow",
        draggable: false})
    .setLngLat([106.98844, -6.19239])
    .setPopup(new mapboxgl.Popup().setHTML("<h4>Tixz Kitchen</h4>"))
    .addTo(map);


    const geocoder = new MapboxGeocoder({                                                                               
        accessToken: mapboxgl.accessToken,
        placeholder: 'Cari tempat..',
        countries: 'id',
        bbox: [106.89372964499967,-6.238922710086669, 106.9771722713308,-6.151418105737719],
        proximity: { //Koordinat JakTim
            longitude: 106.900447,
            latitude: -6.225014
        },
        mapboxgl: mapboxgl,
        marker: false,
        })

    geocoder.on('result', e => {
          const marker = new mapboxgl.Marker({
            draggable: true,
          })
          .setLngLat(e.result.center)
          .addTo(map)
          marker.on('dragend',function(e){
            var lngLat = e.target.getLngLat();
            document.getElementById("lng").value = lngLat['lng'];
            document.getElementById("lat").value = lngLat['lat'];
            // console.log(lngLat['lng']);
            // console.log(lngLat['lat']);
          })
        });
    map.addControl(geocoder)

    </script>

    <script>
        //Script buat copy text
    
        function copyToClipboard(element) {
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val($(element).text()).select();
          document.execCommand("copy");
          $temp.remove();
          alert('No. Rekening telah disalin ke clipboard')
        }
    </script>