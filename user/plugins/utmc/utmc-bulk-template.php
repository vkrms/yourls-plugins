
<!-- ASSETS -->
<!-- vue -->
<script src="https://unpkg.com/vue@latest"></script>

<!-- vue-select -->
<script src="https://unpkg.com/vue-select@latest"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

<!-- axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<!-- <script src="https://unpkg.com/axios@latest"></script> -->

<!-- utmc stuff -->
<link rel="stylesheet" href="<?php echo utmc_resource( 'utmc.css' ) ?>"/>

<!-- SVG SPRITES -->
<svg id="svg-sprites">
	<symbol id="spr_cross" viewBox="0 0 16 16">
		<path d="M9.2,8l4.6-4.6c0.3-0.3,0.3-0.9,0-1.2s-0.9-0.3-1.2,0L8,6.8L3.4,2.2c-0.3-0.3-0.9-0.3-1.2,0s-0.3,0.9,0,1.2L6.8,8l-4.6,4.6
			c-0.3,0.3-0.3,0.9,0,1.2C2.4,13.9,2.6,14,2.8,14s0.4-0.1,0.6-0.2L8,9.2l4.6,4.6c0.2,0.2,0.4,0.2,0.6,0.2s0.4-0.1,0.6-0.2
			c0.3-0.3,0.3-0.9,0-1.2L9.2,8z"/>
	</symbol>

	<symbol id="spr_caret" viewBox="0 0 16 16">
		<path d="M8,12.6c-0.2,0-0.4-0.1-0.6-0.2L2.1,7c-0.3-0.3-0.3-0.9,0-1.2s0.9-0.3,1.2,0L8,10.5l4.7-4.7c0.3-0.3,0.9-0.3,1.2,0
			s0.3,0.9,0,1.2l-5.3,5.3C8.5,12.5,8.3,12.6,8,12.6L8,12.6z"/>
	</symbol>
</svg>

<!-- MARKUP -->
<section class="utmc">
	<form class="utmc__form" action="/" method="post">
		<h4 class="utmc__title">Utm constructor</h4>

		<div id="app">

			<div class="utmc__flex-wrap">

				<input type="text" name="utmc_base" class="utmc__text-field utmc__result" v-model="baseUrl" placeholder="base url">

				<div class="utmc__input-group">
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_source" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_source'" name="utm_source" class="utmc__text-field --textarea" placeholder="utm_source, separated by newline" v-model="inputs.utm_source"></textarea>
					<v-select v-else taggable :options="sources" name="utm_source" class="utmc__text-field" placeholder="utm_source" v-model="inputs.utm_source"></v-select>
				</div>

				<div class="utmc__input-group">
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_media" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_media'" name="utm_media" class="utmc__text-field --textarea" placeholder="utm_media, separated by newline" v-model="inputs.utm_media"></textarea>
					<v-select v-else taggable :options="media"  name="utm_media" class="utmc__text-field" placeholder="utm_media" v-model="inputs.utm_media"></v-select>
				</div>

				<div class="utmc__input-group">
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_campaign" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_campaign'" name="utm_text-field" class="utmc__text-field --textarea" placeholder="utm_campaign, separated by newline" v-model="inputs.utm_campaign"></textarea>
					<input v-else type="text" name="utm_campaign" class="utmc__text-field" placeholder="utm_campaign" v-model="inputs.utm_campaign">
				</div>

				<div class="utmc__input-group">
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_content" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_content'" name="utm_content" class="utmc__text-field --textarea" placeholder="utm_content, separated by newline" v-model="inputs.utm_content"></textarea>
					<input v-else type="text" name="utm_content" class="utmc__text-field" placeholder="utm_content" v-model="inputs.utm_content">
				</div>

				<div class="utmc__input-group">
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_term" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_term'" name="utm_term" class="utmc__text-field --textarea" placeholder="utm_term, separated by newline" v-model="inputs.utm_term"></textarea>
					<input v-else type="text" name="utm_term" class="utmc__text-field" placeholder="utm_term" v-model="inputs.utm_term">
				</div>

				<!-- <textarea name="utmc_urls" class="utmc__text-field utmc__result" v-bind:value="urls" placeholder="result here..."></textarea> -->

			</div>

			<pre>
			{{result}}
			</pre>

			<button type="button" class="utmc__submit-btn" v-on:click="mySubmit">Shorten with UTMs</button>
		</div> <!-- app end -->

	</form>
</section>

<script src="<?php echo utmc_resource( 'bulk.js' ) ?>"></script>

<?php