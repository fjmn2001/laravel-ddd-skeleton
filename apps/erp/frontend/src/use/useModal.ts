import $ from 'jquery'

export function useModal() {

    function show(name: string) {
        const modal = $('#' + name);
        const body = $('body');

        body.addClass('modal-open');
        body.append('<div id="' + name + 'Background" class="modal-backdrop fade show"></div>')
        modal.addClass('show');
        modal.css('display', 'block');
    }

    function hide(name: string) {
        const modal = $('#' + name);
        const body = $('body');
        body.removeClass('modal-open');
        body.find('#' + name + 'Background').remove();
        modal.removeClass('show');
        modal.css('display', 'none');
    }

    function populateLoading(name: string) {
        const modal = $('#' + name);

        modal.find(".modal-body").empty().html('Loading...')
    }

    function populateBody(name: string, html: string) {
        const modal = $('#' + name);

        modal.find(".modal-body").empty().html(html)
    }

    return {
        show,
        hide,
        populateLoading,
        populateBody
    }
}
