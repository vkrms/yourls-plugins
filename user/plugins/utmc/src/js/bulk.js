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
    watch: { radioModel: (newVal, oldVal) => {
        console.log(newVal, oldVal)
        this.inputs[oldVal] = ''
    } },

    computed: {

        result: () => {
            let str = this.baseUrl
            const params = []

            // for (const prop in this.inputs) {
            //     if (this.inputs.hasOwnProperty(prop)) {
            //         const obj = {}
            //         obj[prop] = this.prepareInput(this.inputs[prop])
            //         params.push(obj)
            //     }
            // }

            for (prop of this.inputs) {
                const obj = {}
                obj[prop] = this.prepareInput(this.inputs[prop])
                params.push(obj)
            }

            // console.log(params);
            const multiParams = {}
            const results = []

            params.forEach((param, i) => {

                const prefix = (i === 0) ? '?' : '&'
                const par_k = `${encodeURIComponent(Object.keys(param)[0])}=`
                let par_val = Object.values(param)[0]

                // store multi-param property for later use and skip
                if (par_val instanceof Array) {
                    multiParams.name = par_k
                    multiParams.params = par_val
                    console.log(multiParams)
                    return
                }

                if (par_val !== '' && typeof par_val !== 'undefined' && par_val !== null) {
                    par_val = encodeURIComponent(par_val)
                    str += prefix + par_k + par_val
                }
            })

            results.push(str)

            if (Object.entries(multiParams).length > 0) {
                multiParams.params.forEach((param) => {
                    results.push(str += `&${multiParams.name}${param}`)
                })
            }

            return results
        }, },
    methods: { prepareInput: (str) => {
        return (str.indexOf('\n') > 0) ? str.split('\n') : str
    },
    mySubmit: (e) => {
        e.preventDefault()

        axios.get('/admin/admin-ajax.php', { params: { action: 'add_links',
            // should be generated, like result, but multiple lines
            urls: this.urls,
            keyword: 'keyword',
            nonce: 'nonce', } }).then((response) => {
            console.log(response)
        })
    } } })


document.addEventListener('DOMContentLoaded', () => {

    // update base url in vue
    const urlInput = document.getElementById('add-url')

    if (urlInput) {
        urlInput.addEventListener('keyup', (e) => {
            utmc.baseUrl = this.value
        })
    }

})
