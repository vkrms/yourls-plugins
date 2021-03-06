import axios from 'axios'

export const data = {

    baseUrl: '',
    inputs: {},

    options: [],
    radioModel: '',
}

// get stuff from db with axios

const ajaxurl = '/admin/admin-ajax.php'

export function getOptions() {
    return axios.get(ajaxurl, { params: {
        action: 'get_options'
    } })
}

export function handleMainInput(utmc) {
    document.addEventListener('DOMContentLoaded', () => {

        // update base url in vue
        const urlInput = document.getElementById('add-url')

        if (urlInput) {
            urlInput.addEventListener('keyup', function (e) {
                utmc.baseUrl = this.value
            })
        }
    })
}
