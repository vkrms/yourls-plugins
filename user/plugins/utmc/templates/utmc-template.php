
<!-- ASSETS -->
<!-- vue -->
<script src="https://unpkg.com/vue@2"></script>

<!-- vue-select -->
<script src="https://unpkg.com/vue-select@3"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-select@3/dist/vue-select.css">

<!-- utmc stuff -->
<link rel="stylesheet" href="<?php echo utmc_resource( 'src/css/utmc.css' ) ?>"/>

<!-- SPRITES -->
<?php require( 'sprites.svg.php' ) ?>

<!-- MARKUP -->
<section class="utmc">
	<form class="utmc__form" action="/" method="post">
		<h4 class="utmc__title">Utm constructor</h4>

		<div id="mainApp">

			<div class="utmc__flex-wrap">

				<v-select taggable :options="options.utm_source" label="value"
					name="utm_source" class="utmc__text-field"
					placeholder="utm_source" v-model="inputs.utm_source"
					select-on-tab :clearable="false">
				</v-select>

				<v-select taggable :options="options.utm_media"  label="value"
					name="utm_media" class="utmc__text-field"
					placeholder="utm_media" v-model="inputs.utm_media"
					select-on-tab :clearable="false">
				</v-select>

				<v-select taggable :options="options.utm_campaign" label="value"
					name="utm_campaign" class="utmc__text-field"
					placeholder="utm_campaign" v-model="inputs.utm_campaign"
					select-on-tab :clearable="false">
				</v-select>

				<v-select taggable :options="options.utm_content" label="value"
					name="utm_content" class="utmc__text-field"
					placeholder="utm_content" v-model="inputs.utm_content"
					select-on-tab :clearable="false">
				</v-select>

				<v-select taggable :options="options.utm_term" label="value"
					name="utm_term" class="utmc__text-field"
					placeholder="utm_term" v-model="inputs.utm_term"
					select-on-tab :clearable="false">
				</v-select>

				<div class="utmc__text-field utmc__result">
					{{ result }}
				</div>

			</div>

		</div> <!-- app end -->

		<button type="button" class="utmc__submit-btn">Shorten with UTMs</button>

	</form>
</section>

<script src="<?php echo utmc_resource( 'dist/addLink.js' ) ?>"></script>
<script src="<?php echo utmc_resource( 'dist/utmc.js' ) ?>"></script>

<?php
