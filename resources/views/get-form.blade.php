<form id="popup-form"><h2>Формирование чека</h2>
    <table class="ui-table">
        <thead>
        <tr>
            <th>Наименование</th>
            <th>Кол-во</th>
            <th>Цена</th>
            <th>НДС</th>
            <th>Скидка</th>
            <th>Сумма</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Кока Кола</td>
            <td>101</td>
            <td>100</td>
            <td>без НДС</td>
            <td>0</td>
            <td>10100</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="font-size: 200%;">10100</td>
        </tr>
        <tbody>
    </table>
    <div style="display: inline-block; width: 200px;vertical-align: top;">Тип оплаты: <br><label><input type="radio"
                                                                                                        name="pay-type"
                                                                                                        value="cash"
                                                                                                        checked>
            Наличными</label><label><input type="radio" name="pay-type" value="card"> Безналичными</label><br></div>
    <div style="display: inline-block; width: 200px;vertical-align: top;">Тип чека: <br><select name="check-type">
            <option value="4" selected>Полный расчет</option>
            <option value="-1">Полный возврат</option>
        </select></div>
    <div style="display: inline-block; width: 200px;vertical-align: top;">
        <button class="button button--success" onclick="RegisterCheck();return false;" id="button-register-check">
            Напечатать чек
        </button>
    </div>
    <div style="display: inline-block; width: 300px;vertical-align: top;">
        <button class="button" onclick="ExecuteKkm({Command: 'OpenShift'});return false;">Открыть смену</button>
        <button class="button" onclick="ExecuteKkm({Command: 'CloseShift'});return false;">Закрыть смену</button>
        <button class="button" onclick="ExecuteKkm({Command: 'XReport'});return false;">X отчет</button>
    </div>
    <script>var ObjectData = atob("eyJDb21tYW5kIjoiUmVnaXN0ZXJDaGVjayIsIklzRmlzY2FsQ2hlY2siOnRydWUsIlR5cGVDaGVjayI6MCwiQ2hlY2tTdHJpbmdzIjpbeyJSZWdpc3RlciI6eyJOYW1lIjoiXHUwNDFhXHUwNDNlXHUwNDNhXHUwNDMwIFx1MDQxYVx1MDQzZVx1MDQzYlx1MDQzMCIsIlF1YW50aXR5IjoxMDEsIlByaWNlIjoxMDAsIkFtb3VudCI6MTAxMDAsIlRheCI6LTEsIlNpZ25NZXRob2RDYWxjdWxhdGlvbiI6NCwiU2lnbkNhbGN1bGF0aW9uT2JqZWN0IjoxfX1dLCJNU19zdW0iOjEwMTAwfQ==");</script>
    <script>
        var Data = {};

        function finishExecution(Result) {
            let message = "";
            const serviceCommandsArray = ["OpenShift", "CloseShift", "XReport"];
            if (Result.Command == "RegisterCheck" && typeof (Result.CheckNumber) == "number" && Result.Error === "") {
                message = "Чек успешно напечатан! Смена " + Result.SessionNumber + ", чек " + Result.CheckNumber + ".";
                message += "<br><a href='" + Result.URL + "'>Ссылка на чек на сайте вашего ОФД</a>."
            } else if (serviceCommandsArray.includes(Result.Command) && Result.Error === "") {
                switch (Result.Command) {
                    case "OpenShift":
                        message += "Смена открыта. Номер смены: " + Result.SessionNumber + ".";
                        break;
                    case "CloseShift":
                        message += "Смена закрыта. Номер смены: " + Result.SessionNumber + ".";
                        break;
                    case "XReport":
                        message += "X отчет напечатан.";
                        break;
                }
            } else {
                if (Result.Error === "Unknown error.") {
                    message = "Произошла ошибка! <br>ККТ не подключена, не настроено расширение KkmServer.<br>Обратитесь к руководству пользователя для настройки.";
                } else {
                    message = "Произошла ошибка! <br>Текст ошибки: " + Result.Error;
                }
            }
            document.getElementById("result").innerHTML = message;
        }

        window.addEventListener("message", function (event) {
            var receivedMessage = event.data;
            if (receivedMessage.name === 'KkmExecutionResult') {
                finishExecution(receivedMessage.Result);
            }
        });

        function ExecuteKkm(DataParametr) {
            window.Data = DataParametr;
            window.open('../kassa/KkmExecute.php', '_blank');
        }

        function RegisterCheck() {
            // block button
            $("#button-register-check").prop('disabled', true).removeClass("button--success");
            // unpack ObjectData if necessary
            if (typeof (ObjectData) == "string") {
                ObjectData = JSON.parse(ObjectData);
            }
            // apply pay type
            let payType = $("[name=pay-type]:checked").val();
            if (payType == 'cash') {
                ObjectData.Cash = ObjectData.MS_sum;
            } else {
                ObjectData.ElectronicPayment = ObjectData.MS_sum;
            }

            // apply check type
            let checkType = $("[name=check-type]").val();
            if (checkType == '-1') {
                ObjectData.TypeCheck = 1;
            } else {
                ObjectData.TypeCheck = 0;
            }

            // console.log(ObjectData);

            // send data
            ExecuteKkm(window.ObjectData);
        }

        $(".buttons-container").hide();
    </script>
    <br>
    <div id="result" style="font-size: 200%;"></div>
    <div class="buttons-container">
        <button class="button button--success" onclick="ClosePopup(true);return false;">Отправить</button>
        <button class="button" onclick="ClosePopup();return false;">Отмена</button>
    </div>
</form>
