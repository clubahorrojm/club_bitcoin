<div class="wrapper">



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 1156px;">
        <!-- Content Header (Page header) -->
        <br/>
        <br/>
        <br/>
        <br/>
         <div class="col-md-3">
		</div>
        <div class="col-md-12">
              <!--<div class="box box-solid">-->
   
                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
<!--                      <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>-->
                    </ol>
                      <div class="carousel-inner" style="margin-left: 10%" >
						<div class="box-body no-padding">
							<div class="row">
							  <div class="col-md-9 col-sm-8">
								<div class="pad" style="border: groove">
								  <!-- Map will be created here -->
								  <div id="world-map-markers" style="height: 550px;"></div>
								</div>
							  </div>
							  <!-- /.col -->
							</div>
							<!-- /.row -->
						</div>
						<input type="text" class="form-control" id="lista" name="lista" />
                      <!--<div class="item active">-->
                      <!--  <img style="width: 50%; text-align: center " src="<?= base_url() ?>/static/img/img3.jpg" alt="First slide">-->
                      <!--  <div style="font-weight: bold; text-align: center; color: black" class="carousel-caption">-->
                      <!--    Criptozone-->
                      <!--  </div>-->
                      <!--</div>-->
                      <!--<div class="item">-->
                      <!--    <img style="width: 50%; text-align: center " src="<?= base_url() ?>/static/img/img1.jpg"  alt="Second slide">-->
                      <!--  <div style="font-weight: bold; text-align: center; color: black" class="carousel-caption">-->
                      <!--    Criptozone-->
                      <!--  </div>-->
                      <!--</div>-->
                      <!--<div class="item">-->
                      <!--  <img style="width: 70%; text-align: center " src="<?= base_url() ?>/static/img/img4.jpg" alt="Third slide">-->
                      <!--  <div style="font-weight: bold; text-align: center; color: black" class="carousel-caption">-->
                      <!--    Criptozone-->
                      <!--  </div>-->
                      <!--</div>-->
                    </div>
                  </div>
			<p>Click the button to get your coordinates.</p>
			
			<button onclick="getLocation()">Try It</button>
			
			<p><strong>Note:</strong> The geolocation property is not supported in IE8 and earlier versions.</p>
			
			<p id="demo"></p>
              <!--</div> /.box -->
            </div><!-- /.col -->
              <div class="col-md-3">
		</div>
<!--        <div  style="text-align:center;">
			<img  src="<?= base_url() ?>/static/img/img1.jpg"/>
		</div>-->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
         <!-- <img  src="<?= base_url() ?>/static/img/footer.png"/> -->
      </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<script>
	$.post('<?php echo base_url(); ?>index.php/User_Authentication/cargar_punteros/', function(response) {
		var lista = response;
		//$('#lista').val(response);
		alert(lista);
		//var obj = jQuery.parseJSON(lista); 
		$('#world-map-markers').vectorMap({
				map              : 'world_mill_en',
				normalizeFunction: 'polynomial',
				hoverOpacity     : 0.9,
				hoverColor       : false,
				backgroundColor  : '#001A5A',
				regionStyle      : {
				  initial      : {
					fill            : '#A3A3A5',
					'fill-opacity'  : 10,
					stroke          : 'none',
					'stroke-width'  : 0,
					'stroke-opacity': 1
				  },
				  hover        : {
					'fill-opacity': 0.7,
					cursor        : 'pointer'
				  },
				  selected     : {
					fill: 'blu'
				  },
				  selectedHover: {}
				},
				markerStyle      : {
				  initial: {
					fill  : 'red',
					stroke: '#111'
				  }
				},
				markers          : [{ latLng:[45.9,12.45], name:'operador'}, { latLng:[1.3,103.18], name:'marcuri'}, { latLng:[-0.52,166.93], name:'jsolorzano'}, ]
		});
		
	});
	//var lista = $("#lista").val();
	//alert(lista);
	
	var x = document.getElementById("demo");
	
	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else { 
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	}
	
	function showPosition(position) {
		latitud = (position.coords.latitude);
		longitud = (position.coords.longitude);

		x.innerHTML = "Latitude: " + latitud + 
		"<br>Longitude: " + longitud;
		$('#latitud').val(position.coords.latitude);
		$('#longitud').val(position.coords.longitude);
	}
  
  </script>