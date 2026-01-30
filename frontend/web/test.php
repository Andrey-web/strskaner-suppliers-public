<?php
        $message = 'Код подтверждения для регистрации на сайте stroyru.ru: ';
        $phone = '+79206513266';

        `curl --location --request POST 'https://direct.i-dgtl.ru/api/v1/message/' \
        --header 'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJqdm1fYmFja2VuZCIsInN1YiI6IjM0NiIsImNsaWVudF9pZCI6MzA1ODQsInR5cGUiOiJhY2Nlc3MiLCJnZW4iOjEsImdlbmVyYXRlZF9ieSI6MzIxLCJuYW1lIjoi0JjQvdCz0LAg0JPRgNGD0L_QvyIsImlhdCI6MTYyMDEzODcyOSwiZXhwIjo5MjIzMzcyMDM2ODU0Nzc1fQ.fxYciRgTy6SoWOVA6MeDctugA6OA58uQFyk5WKdgiaA' \
        --header 'Content-Type: application/json' \
        --data-raw '[{
        "channelType":"SMS",
        "senderName":"StroyRu",
        "destination":"$phone",
        "content":"$message",
        "useLocalTime":true,"ttl":43200,
        "tags":["tag1","tag2"]}]'`;

	echo 'Test';
?>