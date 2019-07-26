import { ajaxurl, data, getOptions, handleMainInput, clearableTabindex } from './shared'
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

// append stuff to the shared data object
data.presetName = ''
data.preset = '' //
data.presets = []

const utmc = new Vue({
    el: '#bulkApp',
    data,
    mounted() {
        this.updateOptions()
        this.updatePresets()
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

                let val = params[param]

                if (val && val !== '') {
                    // convert foo/nbar/nbaz string into array, leave others as is
                    val = this.prepareInput(val)

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

        mySubmit(e) {
            e.preventDefault()
            const urls = this.result

            axios.get(ajaxurl, { params: {
                action: 'add_links',
                urls: urls,
                keyword: 'keyword',
                nonce: 'nonce',
            }})
                .then((response) => {
                    this.$toasted.success('Saved', { duration: 10000 })
                    this.updateOptions()
                })
        },

        // if input has newlines, return array
        prepareInput(str) {
            return (str.indexOf('\n') > 0) ? str.split('\n') : str
        },

        // populate form on preset selected
        presetSelected(preset) {
            if (preset.id) {
                // this creates non-reactive object copy
                let presetTemp = Object.assign({}, preset)
                delete presetTemp.id
                delete presetTemp.name

                // activate appropriate radio\textarea
                for (let utm in presetTemp) {
                    if (preset[utm].indexOf('\n') > 0)
                        this.radioModel = utm
                }

                this.inputs = Object.assign(this.inputs, presetTemp)
            }
        },

        rmPreset(e) {
            e.preventDefault(e)
            axios.get(ajaxurl, { params: {
                action: 'remove_preset',
                id: this.preset.id
            } }).then(res => {
                this.$toasted.success('Removed', { duration: 10000 })
                this.preset = {}
                this.updatePresets()
            })
        },

        savePreset(e) {
            e.preventDefault()

            let params = Object.assign({
                action: 'save_preset',
                name: this.preset.name
            }, this.inputs)

            axios.get(ajaxurl, { params: params }).then(res => {
                this.$toasted.success('Saved', { duration: 10000 })
                this.updatePresets()
            })
        },

        // get available options
        updateOptions() {
            getOptions().then((res) => {
                this.options = res.data
            })
        },

        // get available presets
        updatePresets() {
            axios.get(ajaxurl, { params: {
                action: 'get_presets'
            }}).then(res => {
                this.presets = res.data
            })
        }

    }
})

clearableTabindex()
