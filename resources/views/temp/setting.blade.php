@extends('moysklad.layouts')

@section('content')

    <div class="tabs-border js-tabs">
        <ul class="tabs-border__buttons">
            <li class="tabs-border__button js-tabs-button b-active"
                onclick="window.open('?tab=main&token=44bb898899483b6b77f348d1e98acae74c818a1f&accountId=e0be3639-7d4c-11ed-0a80-07f300006563&uid=admin@zhan96&','_self')">
                Главная
            </li>
            <li class="tabs-border__button js-tabs-button"
                onclick="window.open('?tab=buttons&token=44bb898899483b6b77f348d1e98acae74c818a1f&accountId=e0be3639-7d4c-11ed-0a80-07f300006563&uid=admin@zhan96&','_self')">
                Кнопки
            </li>
            <li class="tabs-border__button js-tabs-button"
                onclick="window.open('?tab=users&token=44bb898899483b6b77f348d1e98acae74c818a1f&accountId=e0be3639-7d4c-11ed-0a80-07f300006563&uid=admin@zhan96&','_self')">
                Сотрудники
            </li>
            <li class="tabs-border__button js-tabs-button"
                onclick="window.open('?tab=help&token=44bb898899483b6b77f348d1e98acae74c818a1f&accountId=e0be3639-7d4c-11ed-0a80-07f300006563&uid=admin@zhan96&','_self')">
                Помощь
            </li>
        </ul>
    </div>

    <h2>О приложении "Касса Казахстан"</h2>
    <iframe width="560" height="315" referrerpolicy="origin" src="https://www.youtube-nocookie.com/embed/lEj7UW6d8TE"
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    <img src="./img/screen1-640w.png" height="315">
    <br>
    <iframe width="560" height="315" referrerpolicy="origin" src="https://www.youtube-nocookie.com/embed/EFYowherpyQ"
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    <p>Печатайте кассовые и товарные чеки напрямую из документов МойСклад.</p>
    <!--
    <br/>
    -->
    <h2>Новости приложения</h2>
    <p><strong>Подписывайтесь на новости в Telegram: <a href="https://t.me/kassa_kz_moysklad" target="_blank">t.me/kassa_kz_moysklad</a>.</strong>
    </p>
    <p><strong>1 августа 2022</strong> Приложение доступно в маркетплейсе МойСклад.</p>
    <!--
    <br/>
    -->
    <h2>Недавние события</h2>
    <table class="ui-table">
        <thead>
        <tr>
            <th>Время</th>
            <th>Событие</th>
            <th>Сотрудник</th>
            <th>Объект</th>
            <th>Комментарий</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>25.12.2022 14:46</td>
            <td>Изменение настроек</td>
            <td>admin@zhan96</td>
            <td> ()</td>
            <td></td>
        </tr>
        <tr>
            <td>25.12.2022 14:46</td>
            <td>Изменение настроек</td>
            <td>admin@zhan96</td>
            <td> ()</td>
            <td></td>
        </tr>
        <tr>
            <td>17.12.2022 16:18</td>
            <td>Активация приложения</td>
            <td></td>
            <td> ()</td>
            <td></td>
        </tr>
        </tbody>
    </table>

@endsection
