
<!-- ASSETS -->
<!-- vue -->
<script src="https://unpkg.com/vue@latest"></script>

<!-- vue-select -->
<script src="https://unpkg.com/vue-select@latest"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

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

				<div class="utmc__input-group --fullwidth --presets">
					<label class="utmc_label preset-label">presets</label>
					<v-select taggable :options="presets" label="name"
						select-on-tab
						class="utmc__text-field --preset" placeholder="preset"
						:create-option="preset => ({ name: preset })"
						v-model="preset" @input="presetSelected">
					</v-select>

					<button type="button" class="utmc__submit-btn --small" v-on:click="savePreset">Save</button>
					<button type="button" class="utmc__remove-btn" v-on:click="rmPreset" title="Delete preset">&times;</button>

				</div>

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">utm_source</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_source" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_source'" name="utm_source" class="utmc__text-field --textarea" placeholder="utm_source, separated by newline" v-model="inputs.utm_source"></textarea>
					<v-select v-else taggable :options="options.utm_source"
						name="utm_source" select-on-tab
						class="utmc__text-field" placeholder="utm_source"
						v-model="inputs.utm_source">
					</v-select>
				</div>

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">utm_medium</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_medium" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_medium'" name="utm_medium" class="utmc__text-field --textarea" placeholder="utm_medium, separated by newline" v-model="inputs.utm_medium"></textarea>
					<v-select v-else taggable :options="options.utm_medium"
						name="utm_medium" class="utmc__text-field"
						placeholder="utm_medium" select-on-tab
						v-model="inputs.utm_medium">
					</v-select>
				</div>

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">utm_campaign</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_campaign" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_campaign'" name="utm_text-field" class="utmc__text-field --textarea" placeholder="utm_campaign, separated by newline" v-model="inputs.utm_campaign"></textarea>
					<v-select v-else taggable :options="options.utm_campaign" label="value"
						name="utm_campaign" class="utmc__text-field"
						placeholder="utm_campaign" v-model="inputs.utm_campaign"
						select-on-tab>
					</v-select>
				</div>

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">utm_content</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_content" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_content'" name="utm_content" class="utmc__text-field --textarea" placeholder="utm_content, separated by newline" v-model="inputs.utm_content"></textarea>
					<v-select v-else taggable :options="options.utm_content" label="value"
						name="utm_content" class="utmc__text-field"
						placeholder="utm_content" v-model="inputs.utm_content"
						select-on-tab>
					</v-select>
				</div>

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">utm_term</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" value="utm_term" tabindex="-1" title="click here for multiple input "/>
					<textarea v-if="radioModel == 'utm_term'" name="utm_term" class="utmc__text-field --textarea" placeholder="utm_term, separated by newline" v-model="inputs.utm_term"></textarea>
					<v-select v-else taggable :options="options.utm_term" label="value"
						name="utm_term" class="utmc__text-field" select-on-tab
						placeholder="utm_term" v-model="inputs.utm_term"
						select-on-tab>
					</v-select>
				</div>

				<div class="utmc__input-group">
					<label class="utmc_label bulk-label">no_bulk</label>
					<input type="radio" name="utmc_multi" class="utmc__radio" v-model="radioModel" :value="false" tabindex="-1" title="click here for NO multiple input "/>
					<input class="utmc__text-field" select-on-tab
						placeholder="<< check for NO multiple input" disabled>
				</div>

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
