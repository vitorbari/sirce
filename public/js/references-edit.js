$(document).ready(function () {

    $('#live-preview').click(function (e) {
        var modal = $('#modal-reference-edit');
        var modal_body = modal.find('.modal-body');

        modal_body.html('Loading...');

        modal.find('#modal-label').html('Live Preview');
        modal.modal('show');

        var markdown = $('textarea[name="markdown"]').val();

        if (!markdown) {
            alert('Please write some stuff!');
            $('textarea[name="markdown"]').focus();
            return false;
        }

        modal_body.load('/sketches/preview', {
            markdown: markdown
        });
    });

    $('.load-template').click(function (e) {
        var markdown_field = $('textarea[name="markdown"]');

        if (markdown_field.val()) {
            if (!confirm('Do you want to replace all your content with the template?')) {
                return false;
            }
        }

        markdown_field.val($('#markdown-template').html());
    });

    $('select[name="component_category_id"]').on('change', function(e) {

        var comp_el = $('select[name="component_id"]');

        comp_el.parent().find('label').append('&nbsp;<span class="small text-muted">Loading...</span>');
        $.getJSON('/components/category/'+$(this).val(), function( data ) {

            var items = [];

            //items.push("<option disabled>...</option>");
            if(data.length) {
                $.each(data, function (key, val) {
                    items.push("<option value='" + val.id + "'>" + val.component + "</option>");
                });
            } else {
                items.push("<option disabled>(No components found)</option>");
            }

            comp_el.html(items.join(""));
            comp_el.parent().find('label').find('span').remove();

            if(component_id && comp_el.find("option[value='"+component_id+"']").length > 0) {
                comp_el.val(component_id);
            }
        });
    }).trigger('change');

    $('select[name="component_id"]').change(function(e) {
        component_id = $(this).val();
    });


})