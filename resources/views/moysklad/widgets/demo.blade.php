<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">

    <title>DummyApp:</title>
    <meta name="description" content="TIS KZ">
    <meta name="author" content="">
    <script>
        const hostWindow = window.parent;

        window.addEventListener("message", function (event) {
            const receivedMessage = event.data;

            logReceivedMessage(receivedMessage);

            if (receivedMessage.name === 'Open') {
                var oReq = new XMLHttpRequest();
                oReq.addEventListener("load", function () {
                    window.document.getElementById("object").innerHTML = this.responseText;
                });

                oReq.open("GET", '/widgets/get-item?accountId={{$accountId??''}}&entity={{$entity}}&objectId=' + receivedMessage.objectId);
                oReq.send();

                window.setTimeout(function () {
                    var sendingMessage = {
                        name: "OpenFeedback",
                        correlationId: receivedMessage.messageId
                    };
                    logSendingMessage(sendingMessage);
                    hostWindow.postMessage(sendingMessage, '*');

                }, getOpenFeedbackDelay());
            }
        });

        function logReceivedMessage(msg) {
            logMessage("→ Received", msg)
        }

        function logSendingMessage(msg) {
            logMessage("← Sending", msg)
        }

        function logMessage(prefix, msg) {
            var messageAsString = JSON.stringify(msg);
            console.log(prefix + " message: " + messageAsString);
            addMessage(prefix.toUpperCase() + " " + messageAsString);
        }

        function addMessage(item) {
            var messages = window.document.getElementById("messages");
            messages.innerHTML = item + "<br/>" + messages.innerHTML;
            messages.title += item + "\n";
        }

        function getOpenFeedbackDelay() {
            return window.document.getElementById("openFeedbackDelay").value
        }

        function toggleBorders(value) {
            body().className = value ? "borders" : "";
        }

        function showDimensions() {
            var dimensions = window.document.getElementById("dimensions");
            dimensions.innerText = body().offsetWidth + " x " + body().offsetHeight
        }

        function body() {
            return window.document.body;
        }
    </script>
</head>
<body>
    <b title="Используя objectId, переданный в сообщении Open, можем получить через JSON API открытую пользователем сущность/документ">Открыт
        объект <span class="hint">(?)</span>:</b> <span id="object"></span></p>

<p><b title="Синтетическая задержка, позволяющая посмотреть как работает функционал OpenFeedback">Задержка OpenFeedback,
        мс <span class="hint">(?)</span>:</b> <input type="text" id="openFeedbackDelay" value="300"></p>

<b title="Лог входящих от хост-окна и исходящих от виджета сообщений (коммуникация через Window.postMessage). Здесь лог отображается в обратном порядке (последние сообщения сверху), при наведении на текст сообщений можно посмотреть все сообщения в прямом порядке (последние сообщения в конце)">Сообщения
    <span class="hint">(?)</span>:</b>
<div id="messages"></div>
</body>
</html>
