@extends('moysklad.layouts')
@section('title', 'Page Title')
@section('js')
    <script>
        const hostWindow = window.parent;
        const token = "7c4d83ee4b3ce4fa922a1ac9292f59799a7f1a2a";
        const uid = "admin@zhan96";
        const accountId = "e0be3639-7d4c-11ed-0a80-07f300006563";
        const entity = "customerorder";
        let objectId = "";

        window.addEventListener("message", function (event) {
            const receivedMessage = event.data;

            logReceivedMessage(receivedMessage);

            if (receivedMessage.name === 'Open' || receivedMessage.name === 'Save') {
                const oReq = new XMLHttpRequest();
                oReq.addEventListener("load", function () {
                    window.document.getElementById("object").innerHTML = this.responseText;
                    prepareButtons();
                    const sendingMessage = {
                        name: "OpenFeedback",
                        correlationId: receivedMessage.messageId
                    };
                    logSendingMessage(sendingMessage);
                    hostWindow.postMessage(sendingMessage, '*');
                });
                objectId = receivedMessage.objectId;
                oReq.open("GET", "https://kassakz1.nirguna.ru/1/widgets/get-object.php?token=7c4d83ee4b3ce4fa922a1ac9292f59799a7f1a2a&uid=admin@zhan96&accountId=e0be3639-7d4c-11ed-0a80-07f300006563&entity=customerorder&objectId=" + receivedMessage.objectId);
                oReq.send();
            } else if (receivedMessage.name === 'ShowPopupResponse' && receivedMessage.popupName === 'formsPopup' && receivedMessage.popupResolution === 'normal' && (typeof receivedMessage.popupResponse !== 'undefined')) {
                clickButton(receivedMessage.correlationId, receivedMessage.popupResponse);
            }
        });

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

            $('.button--success').click(function () {
                const form = $(this).parents('form');
                const button = $(this);
                const buttonId = Number(button.attr('value'));

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
        }
    </script>
@endsection
@section('content')
    <div class="content">
        <button type="button" value="1" class="require-popup btn button button--success btn-lg text-white">
            Выбить чек
        </button>
    </div>
@endsection

