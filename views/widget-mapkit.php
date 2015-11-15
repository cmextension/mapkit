<?php $view->script('google-maps', '//maps.googleapis.com/maps/api/js', 'google'); ?>
<div class="uk-width-1-1">
	<div id="<?php echo $map_id; ?>" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>"></div>
	<?php if ($get_direction) : ?>
		<div class="uk-float-right">
			<a href="//maps.google.com/?daddr=<?php echo $lat; ?>,<?php echo $lng; ?>" target="_blank">
				<?php echo __('Get Direction'); ?>
			</a>
		</div>
	<?php endif; ?>
</div>
<script>
jQuery(document).ready(function() {
	var lat = <?php echo $lat; ?>;
	var lng = <?php echo $lng; ?>;

	var latlng = new google.maps.LatLng(lat, lng);

	var mapOptions = {
		zoom: <?php echo $zoom; ?>,
		center: latlng
	};

	var map = new google.maps.Map(
		document.getElementById('<?php echo $map_id; ?>'),
		mapOptions
	);

	var marker = new google.maps.Marker({
		position: latlng,
		map: map,
	});
});
</script>