import { data, getOptions, handleMainInput } from './shared'
import axios from 'axios'
import Toasted from 'vue-toasted'

Vue.use(Toasted)

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
    el: '#bulkApp',
    data,
    mounted() {
        this.updateOptions()
    },

    watch: {
        // clear model that was a textarea before
        radioModel(newVal, oldVal) {
            if (oldVal != '') {
                this.inputs[oldVal] = ''
            }
        }
    },

    computed: {

        result() {
            let str = this.baseUrl
            const params = this.inputs
            let results = [str]

            let prefix = '?'

            // iterate over inputs
            for (const param in params) {

                // convert foo/nbar/nbaz string into array, leave others as is
                const val = this.prepareInput(params[param])

                if (val !== '') {

                    // if we got the array, prepend each item with current string
                    // and push everything into results array
                    if (val instanceof Array) {
                        const str = results[0]
                        results = []
                        val.forEach((innerVal) => {
                            const innerStr = `${str}${prefix}${encodeURIComponent(param)}` +
                                `=${encodeURIComponent(innerVal.trim())}`
                            results.push(innerStr)
                        })
                        continue
                    }

                    // if current value is a string but one of the previos is array
                    // append each of them with current param=val pair
                    if (results.length > 1) {
                        results.forEach((str, i) => {
                            str += `${prefix}${encodeURIComponent(param)}` +
                                `=${encodeURIComponent(val)}`
                            results[i] = str
                        })
                        prefix = '&'
                        continue
                    }

                    // business as usual
                    results[0] += `${prefix}${encodeURIComponent(param)}=${encodeURIComponent(val)}`
                    prefix = '&'
                }
            }
            return results
        },
    },
    methods: {
        // if input has newlines, return array
        prepareInput(str) {
            return (str.indexOf('\n') > 0) ? str.split('\n') : str
        },

        mySubmit(e) {
            e.preventDefault()
            const urls = this.result

            axios.get('/admin/admin-ajax.php', { params: {
                action: 'add_links',
                urls: urls,
                keyword: 'keyword',
                nonce: 'nonce',
            }})
                .then((response) => {
                    this.$toasted.success('Сохранено', { duration: 10000 })
                    this.updateOptions()
                })
        },

        updateOptions() {
            getOptions().then((res) => {
                this.options = res.data
            })
        },

    }
})

document.addEventListener('DOMContentLoaded', () => {

    // update base url in vue
    const urlInput = document.getElementById('add-url')

    if (urlInput) {
        urlInput.addEventListener('keyup', (e) => {
            utmc.baseUrl = this.value
        })
    }

})
