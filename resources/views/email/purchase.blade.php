@component('mail::message')
# Thank you for purchasing from us!

You bought:

@foreach($keys as $key)
    {{$key['game']}}
    {{$key['code']}}
@endforeach

Thanks,<br>
{{ config('app.name') }}
@endcomponent
