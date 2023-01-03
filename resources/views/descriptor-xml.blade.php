<ServerApplication xmlns="https://online.moysklad.ru/xml/ns/appstore/app/v2"
                   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                   xsi:schemaLocation="https://online.moysklad.ru/xml/ns/appstore/app/v2 https://online.moysklad.ru/xml/ns/appstore/app/v2/application-v2.xsd">
    <iframe>
        <sourceUrl>{{ route('iframe')  }}</sourceUrl>
    </iframe>
    <vendorApi>
        <endpointBase>{{ url('/vendor-endpoint')  }}</endpointBase>
    </vendorApi>
    <access>
        <resource>https://online.moysklad.ru/api/remap/1.2</resource>
        <scope>admin</scope>
    </access>
    <widgets>
        <document.customerorder.edit>
            <sourceUrl>{{ route('customerorder.widget')  }}</sourceUrl>
            <height>
                <fixed>250px</fixed>
            </height>
            <supports>
                <open-feedback/>
            </supports>
        </document.customerorder.edit>
    </widgets>
    <popups>
        <popup>
            <name>formsPopup</name>
            <sourceUrl>{{ route('popup')  }}</sourceUrl>
        </popup>
    </popups>
</ServerApplication>
