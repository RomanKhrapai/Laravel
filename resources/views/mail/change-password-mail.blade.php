<x-mail::message>
    # Introduction

    Dear {{ $user->name }}
    Your password has been changed {{ $time }}. If it's not you, contact the administrators.



    Thanks,
    {{ config('app.name') }}
</x-mail::message>
