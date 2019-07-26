import { ajaxurl, data, getOptions, handleMainInput, clearableTabindex } from './shared'

// override vue-select controls
const $vueSelectComponent = VueSelect.VueSelect
$vueSelectComponent.props.components.default = () => {
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
Vue.component('v-select', $vueSelectComponent)

const utmc = new Vue({
    el: '#mainApp',
    data,
    mounted() {
        this.updateOptions()
    },

    computed: {
        result() {
            let str = this.baseUrl
            const params = this.inputs

            let prefix = '?'

            for (const param in params) {
                const val = params[param]

                if (val !== '') {
                    str += `${prefix}${encodeURIComponent(param)}=${encodeURIComponent(val)}`
                    prefix = '&'
                }
            }
            return str
        },
    },

    methods: {

        addLinkFromVue(e) {
            if (e.key === 'Enter') {
                console.log('attempt do add link', utmc)
                window.addLink(utmc)
            }
        },

        mySubmit(e) {
            e.preventDefault()
            axios.get('/admin/admin-ajax.php', { params: {
                action: 'add_links',
                urls: this.urls,
                keyword: 'keyword',
                nonce: 'nonce',
            } }).then((response) => {
                console.log(response)
                this.updateOptions()
            })
        },

        updateOptions() {
            getOptions().then((res) => {
                this.options = res.data
            })
        },
    },
})

// ugly but has to be done in for interaction with vendor scripts
window.utmc = utmc

// main input listener
handleMainInput(utmc)
clearableTabindex()
