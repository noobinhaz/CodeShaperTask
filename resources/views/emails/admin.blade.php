<x-mail::message>
# Introduction

There is a new post by {{$user}}!

<x-mail::button :url="$url">
Check Now
</x-mail::button>

<x-mail::panel>
    {{$title}}
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
