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
                const oReq = new XMLHttpRequest();
                oReq.addEventListener("load", function () {
                    window.document.getElementById("object").innerHTML = this.responseText;
                });

                document.getElementById("objectId").value = receivedMessage.objectId;

                oReq.open("GET", '/widgets/get-item?accountId={{$accountId??''}}&entity={{$entity}}&objectId=' + receivedMessage.objectId);
                oReq.send();

                window.setTimeout(function () {
                    const sendingMessage = {
                        name: "OpenFeedback",
                        correlationId: receivedMessage.messageId
                    };
                    logSendingMessage(sendingMessage);
                    hostWindow.postMessage(sendingMessage, '*');

                }, 200);
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


        function send(e, form) {
            fetch(form.action, {method: 'post', body: new FormData(form)})
                .then((response) => {
                    return response.json();
                })
                .then((result) => {
                    console.log(result);
                    document.querySelector('#object').classList.toggle('hidden')
                    document.querySelector('#click-form').classList.toggle('hidden')
                    document.querySelector('.receipt').innerHTML = result.data.view
                    window.print();
                });
            e.preventDefault();
        }

    </script>
</head>
<body>
<div id="object">

</div>

<div class="receipt">

</div>

<form method="POST" onsubmit="send(event,this)" action="{{route('sale')}}" id="click-form" method="POST">
    <label>
        <input name="uuid" value="{{ \Ramsey\Uuid\Uuid::uuid4()->toString()  }}" hidden="">
    </label>
    @csrf
    <label>
        <input hidden name="accountId" value="{{$accountId}}">
    </label>
    <label>
        <input hidden name="objectId" id="objectId" >
    </label>
    <button class="button button--success" type="submit" value="12">
        Печать чека
    </button>
    <div class="hidden" id="doing-popup">
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
            </div>
        </div>
        <span id="doing-action-name"></span>
    </div>
</form>

</body>
</html>
