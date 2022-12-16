<x-mail::message>
Hello Admin!

Name: {{ $name }} <br>
Email: {{ $email }} <br>
Subject: {{ $subject }} <br>
Message: {{ $message }} <br>

<x-mail::button :url="''">
Reply
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
