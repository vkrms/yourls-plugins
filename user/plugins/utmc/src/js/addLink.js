function addLink(utmc) {

    const newurl = utmc.result

    const nonce = $('#nonce-add').val()
    if (!newurl || newurl === 'http://' || newurl === 'https://') {
        return
    }
    const keyword = $('#add-keyword').val()
    add_loading('#add-button')
    $.getJSON(
        ajaxurl,
        { action: 'add', url: newurl, keyword, nonce },
        (data) => {
            if (data.status === 'success') {
                $('#main_table tbody').prepend(data.html).trigger('update')
                $('#nourl_found').css('display', 'none')
                zebra_table()
                increment_counter()
                toggle_share_fill_boxes(data.url.url, data.shorturl, data.url.title)
            }

            add_link_reset()
            end_loading('#add-button')
            end_disable('#add-button')

            feedback(data.message, data.status)

            // update available options
            utmc.updateOptions()

        }
    )
}

window.addLink = addLink

$('.utmc__submit-btn').click((e) => {
    addLink(window.utmc)
})
