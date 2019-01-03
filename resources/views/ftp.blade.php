	  
	<?php ini_set('upload_max_filesize', '10M'); ?>
	  <form action="{{ url('upload') }}" enctype="multipart/form-data" method="POST">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
				<input type="file" name="image" />
			</div>
			<div class="col-md-12">
				<button type="submit" class="btn btn-success">Upload</button>
			</div>
		</div>
	  </form>


	      <?php
$total = 
diskfreespace('/');
echo "Total Space Server : $total ";

$free = disk_free_space("/");

echo "Free Space Server : $free  <br/>";

echo "<pre>";
print_r($_SERVER );
echo "</pre>";
?>