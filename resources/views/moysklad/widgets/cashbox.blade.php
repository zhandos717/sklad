@extends('moysklad.layouts')
@section('title', 'Popup')
@section('js')
    <script>
        $('.button--success').click(function () {
            const form = $(this).parents('form');
            const button = $(this);
            const buttonId = Number(button.attr('value'));

            console.log('2121')

            if (button.hasClass('require-popup')) {
                const sendingMessage = {
                    "name": "ShowPopupRequest",
                    "messageId": buttonId,
                    "popupName": "formsPopup",
                    "popupParameters": {
                        "token": token,
                        "uid": uid,
                        "accountId": accountId,
                        "entity": entity,
                        "objectId": objectId,
                        "buttonId": buttonId,
                    }
                };
                logSendingMessage(sendingMessage);
                hostWindow.postMessage(sendingMessage, '*');
                return false;
            }

            $('#object').hide();
            $('#doing-action-name').text(button.text());
            $('#doing-popup').show();

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: {'buttonId': button.attr('value')},
                success: function (data, textStatus, jqXHR) {
                    $('#doing-popup').hide();
                    $('#object').show();
                    $('#object-new').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#doing-popup').hide();
                    $('#result-error').show();
                }
            });

            return false;
        });
    </script>
@endsection
@section('content')
    <div class="content">
        <form action="/">
            <button type="button" value="1" class="require-popup btn button button--success btn-lg text-white">
                Выбить чек
            </button>
        </form>
    </div>
@endsection

