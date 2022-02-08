
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
		<h4 class="utmc__title">Utm Bulk Constructor</h4>

		<div id="bulkApp">

			<div class="utmc__flex-wrap">

				<input type="text" name="utmc_base" class="utmc__text-field utmc_base" v-model="baseUrl" placeholder="base url">

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">utm_source</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_source" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_source'" name="utm_source" class="utmc__text-field --textarea" placeholder="utm_source, separated by newline" v-model="inputs.utm_source"></textarea>
					<v-select v-else taggable :options="options.utm_source"
						name="utm_source" select-on-tab :clearable="false"
						class="utmc__text-field" placeholder="utm_source"
						v-model="inputs.utm_source">
					</v-select>
				</div>

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">utm_media</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_media" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_media'" name="utm_media" class="utmc__text-field --textarea" placeholder="utm_media, separated by newline" v-model="inputs.utm_media"></textarea>
					<v-select v-else taggable :options="options.utm_media"
						name="utm_media" class="utmc__text-field"
						placeholder="utm_media" select-on-tab :clearable="false"
						v-model="inputs.utm_media">
					</v-select>
				</div>

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">utm_campaign</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_campaign" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_campaign'" name="utm_text-field" class="utmc__text-field --textarea" placeholder="utm_campaign, separated by newline" v-model="inputs.utm_campaign"></textarea>
					<v-select v-else taggable :options="options.utm_campaign" label="value"
						name="utm_campaign" class="utmc__text-field"
						placeholder="utm_campaign" v-model="inputs.utm_campaign"
						select-on-tab :clearable="false">
					</v-select>
				</div>

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">utm_content</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_content" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_content'" name="utm_content" class="utmc__text-field --textarea" placeholder="utm_content, separated by newline" v-model="inputs.utm_content"></textarea>
					<v-select v-else taggable :options="options.utm_content" label="value"
						name="utm_content" class="utmc__text-field"
						placeholder="utm_content" v-model="inputs.utm_content"
						select-on-tab :clearable="false">
					</v-select>
				</div>

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">utm_term</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_term" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_term'" name="utm_term" class="utmc__text-field --textarea" placeholder="utm_term, separated by newline" v-model="inputs.utm_term"></textarea>
					<v-select v-else taggable :options="options.utm_term" label="value"
						name="utm_term" class="utmc__text-field" select-on-tab
						placeholder="utm_term" v-model="inputs.utm_term"
						select-on-tab :clearable="false">
					</v-select>
				</div>

				<!-- <textarea name="utmc_urls" class="utmc__text-field utmc__result" v-bind:value="urls" placeholder="result here..."></textarea> -->

			</div>

			<ul class="utmc__result --bulk">
				<li v-for="line in result" class="utmc__li-result">
					{{line}}
				</li>
			</ul>


			<button type="button" class="utmc__submit-btn" v-on:click="mySubmit">Shorten with UTMs</button>
		</div> <!-- app end -->

	</form>
</section>

<script src="<?php echo utmc_resource( 'dist/bulk.js' ) ?>"></script>

<?php
