$(document).ready(function () {
    const errorClass = 'error';
    const formSelector = '.js-commentForm';

    $(document).on('submit', formSelector, function (event) {
        event.preventDefault();
        var self = $(this);
        var ajaxSelector = self.data('ajax-container');
        var errorContainer = self.find(self.data('error-box'));
        var ajaxContainer = $(ajaxSelector);
        var formButton = self.find('button');

        if (errorContainer.length !== 0) {
            errorContainer.hide();
            errorContainer.find('.' + errorClass).remove();
        }

        $.ajax({
            url: self.attr('action'),
            method: self.attr('method'),
            data: self.serialize(),
            global: false,
            beforeSend: function() {
                formButton.attr('disabled', 'disabled');
            },
            complete: function () {
                formButton.removeAttr('disabled');
            },
            success: function (data) {
                self[0].reset();

                if (ajaxContainer.length !== 0) {
                    ajaxContainer.load(' ' + ajaxSelector + ' > *')
                }
            },
            error: function (request, status, error) {
                var responseJson = JSON.parse(request.responseText);
                var errors = responseJson.errors

                if (errors.length !== 0 && self.data('error-box')) {
                    errorContainer.show();

                    Object.values(errors).forEach(function callback(currentValue, index, array) {
                        errorContainer.prepend('<p class="' + errorClass + '">' + currentValue + '</p>')
                    })
                }
            }
        })
    })

    $(document).on('click', '.js-replyButton', function (event) {
        var form = $(formSelector);
        var self = $(this);

        if (form.length !== 0) {
            form.find('.js-parentInput').val(self.data('id'));
        }
    })

});
