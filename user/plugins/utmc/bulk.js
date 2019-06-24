// override vue-select controls
$vueSelectComponent = VueSelect.VueSelect;
$vueSelectComponent.props.components.default = function() {
	return {
		Deselect: {
			template: '<svg><use xlink:href="#spr_cross"/></svg>'
	  },
	  OpenIndicator: {
			template: '<svg><use xlink:href="#spr_caret"/></svg>'
	  },
	}
}

// v-select component
Vue.component('v-select', $vueSelectComponent);

var utmc = new Vue({
	el: '#app',
	data: {
		baseUrl: '',
		inputs: {
			utm_source: '',
			utm_media: '',
			utm_campaign: '',
			utm_content: '',
			utm_term: ''
		},
		radioModel: '',

		// AVAILABLE UTM SOURCES
		sources: [
			'Facebook.com',
			'Vk.com',
			'Twitter.com',
			'Telegram',
			'Whatsapp',
			'Travelpayouts',
			'Blog.travelpayouts.com',
			'Webinar.travelpayouts.com',
			'Aviasales.ru',
		],

		// AVAILABLE UTM MEDIA
		media: [
			'paid',
			'referral',
			'affiliate',
		]
	},
	computed: {
		/**
		* take base url
		* take all params which are not array, add them to url
		* for each param which is array
		*   add val to the url
		*   and push url in the array
		*/
		result: function() {
			var str = this.baseUrl;
			var params = [];
			for (var prop in this.inputs) {
				if (this.inputs.hasOwnProperty(prop)) {
					var obj = {};
					obj[prop] = this.prepareInput(this.inputs[prop]);
					params.push(obj);
				}
			}
			// console.log(params);
			var multiParams = {};
			var results = [];

			params.forEach(function(param, i) {

				var prefix = (i == 0) ? '?' : '&';
				var par_k = encodeURIComponent(Object.keys(param)[0]) + '=';
				var par_val = Object.values(param)[0];

				// store multi-param property for later use and skip
				if ( par_val instanceof Array ) {
					multiParams.name = par_k;
					multiParams.params = par_val;
					console.log(multiParams);
					return;
				}

				if (par_val !== '' && typeof par_val !== 'undefined' && par_val !== null) {
					par_val = encodeURIComponent(par_val);
					str += prefix + par_k + par_val;
				}
			});

			results.push(str);

			if (Object.entries(multiParams).length > 0) {
				multiParams.params.forEach(function(param){
					results.push(str += '&' + multiParams.name + param);
				})
			}

			return results;
		},
	},
	methods: {
		prepareInput: function(str) {
			return (str.indexOf('\n') > 0) ? str.split('\n') : str;
		},
		mySubmit: function(e) {
			e.preventDefault();

			axios.get('/admin/admin-ajax.php', { params: {
					action:'add_links',
					// should be generated, like result, but multiple lines
					urls: this.urls,
					keyword: 'keyword',
					nonce: 'nonce',
				}}
			).then(function (response) {
			    console.log(response);
		  });
		}
	}
});


document.addEventListener('DOMContentLoaded', function(){

	// update base url in vue
	var urlInput = document.getElementById('add-url');

	if (urlInput) {
		urlInput.addEventListener('keyup', function(e){
			utmc.baseUrl = this.value
		});
	}

});
