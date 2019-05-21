
<!-- ASSETS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.default.min.css" />

<link rel="stylesheet" href="<?php echo utmc_resource( 'utmc.css' ) ?>"/>


<section class="utmc">
	<form class="utmc__form" action="/" method="post">
		<h4 class="utmc__title">Utm constructor</h4>
		<input type="text" name="utm_source" class="utmc__text-field" placeholder="utm_source">
		<input type="text" name="utm_medium" class="utmc__text-field" placeholder="utm_medium">
		<input type="text" name="utm_campaign" class="utmc__text-field" placeholder="utm_campaign">
		<input type="text" name="utm_content" class="utmc__text-field" placeholder="utm_content">

		<select name="" class="utmc__text-field utmc__selectize" placeholder="utm_source">
			<?php
			foreach ( $sources as $source ) {
				echo "<option>$source</option>";
			}
			?>
		</select>
	</form>
</section>

<script charset="utf-8">
	$( '.utmc__selectize' ).selectize( {
		create: true,
		sortField: 'text'
	});
</script>

<?php
