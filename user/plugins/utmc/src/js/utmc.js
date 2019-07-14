import { data, getOptions, handleMainInput } from './shared'

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
        utm_content_bulk() {
            return (this.utm_content.indexOf('\n') > 0) ? this.utm_content.split('\n') : this.utm_content
        }
    },

    methods: {

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

        mySubmit(e) {
            e.preventDefault()
            axios.get('/admin/admin-ajax.php', { params: {
                action: 'add_links',
                urls: this.urls,
                keyword: 'keyword',
                nonce: 'nonce',
            } }).then((response) => {
                console.log(response)
            })
        },

        updateOptions() {
            getOptions().then((res) => {
                this.options = res.data
            })
        },

        addLinkFromVue(e) {
            if (e.key === 'Enter') {
                console.log('attempt do add link', utmc)
                window.addLink(utmc)
            }
        }
    }
})

// ugly but has to be done in for interaction with vendor scripts
window.utmc = utmc

// main input listener
handleMainInput(utmc)
