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
		utm_source: null,
		utm_media: undefined,
		utm_campaign: '',
		utm_content: null,
		utm_term: null,

		utm_term_multi_on: '',
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
		result: function() {
			var str = this.baseUrl;
			var params = [
				{ utm_source: this.utm_source },
				{ utm_media: this.utm_media },
				{ utm_campaign: this.utm_campaign },
				{ utm_content: this.utm_content },
				{ utm_term: this.utm_term },
			];
			params.forEach(function(param, i) {
				var prefix = (i == 0) ? '?' : '&';
				var par_k = encodeURIComponent(Object.keys(param)[0]) + '=';
				var par_val = Object.values(param)[0];
				if (par_val !== '' && typeof par_val !== 'undefined' && par_val !== null) {
					par_val = encodeURIComponent(par_val);
					str += prefix + par_k + par_val;
				}
			});
			return str;
		},
		utm_content_bulk: function() {
			return (this.utm_content.indexOf('\n') > 0) ?  this.utm_content.split('\n') : this.utm_content;
		}
	},
	methods: {
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
