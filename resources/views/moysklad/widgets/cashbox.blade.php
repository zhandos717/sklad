@extends('moysklad.layouts')
@section('title', 'Popup')
@section('js')
    <script>
        function logReceivedMessage(msg) {
            logMessage("→ Received", msg)
        }

        function logSendingMessage(msg) {
            logMessage("← Sending", msg)
        }

        function logMessage(prefix, msg) {
            const messageAsString = JSON.stringify(msg);
            console.log(prefix + " message: " + messageAsString);
        }

        function body() {
            return window.document.body;
        }

        function clickButton(buttonId, popupFormParameters) {
            const form = $('#click-form');
            const button = form.children('button[value=' + buttonId + ']');

            $('#object').hide();
            $('#doing-action-name').text(button.text());
            $('#doing-popup').show();

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: {'buttonId': buttonId, 'popupFormParameters': popupFormParameters},
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
        }

        function prepareButtons() {

            if ($('#result-error').css('display') != 'none') {
                $('#result-error').hide();
                $('#object').show();
            }

            if ($('#object-new').css('display') != 'none') {
                $('#object-new').hide();
                $('#object').show();
            }
        }

        prepareButtons();

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



    <form
        action="../knopki/click.php?accountId=e0be3639-7d4c-11ed-0a80-07f300006563&uid=admin%40zhan96&entity=customerorder&token=7fc1d63d7a007e59da105919afe4af8478907ab4&objectId=1f179a85-868d-11ed-0a80-0916007fca50"
        id="click-form" method="POST">
        <table class="raspred-form">
            <tr>
                <td><p></p></td>
                <td>
                    <button class="button require-popup" name="buttonId" value="1">Печать чека</button>
                </td>
            </tr>
        </table>
    </form>
@endsection

