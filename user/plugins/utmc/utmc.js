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
