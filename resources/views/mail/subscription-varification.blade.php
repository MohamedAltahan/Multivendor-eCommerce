<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>mail</title>
    </head>

    <body>
        <p>click this link for varify you email</p>
        <a href="{{ route('newsletter-verify', $subscriber->verified_token) }}">click here</a>
    </body>

</html>
