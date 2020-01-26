@component('mail::message')
    {{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Whoops!
@else
# {{ __('site.hello') }}
@endif
@endif

    {{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

    {{-- Action Button --}}
@isset($actionText)

@component('mail::button', ['url' => $actionUrl])
{{ $actionText }}
@endcomponent
@endisset

    {{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

    {{-- Salutation --}}
@if (! empty($salutation))
{!! $salutation !!}
@else
{{ __('site.regards') }},
{{ config('app.name') }}
@endif

    {{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
    {{ __('site.action',['actionText'=>$actionText,'actionUrl'=>$actionUrl]) }}
@endcomponent
@endisset
@endcomponent