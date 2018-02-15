<div dir="rtl">

@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# خطأ!
@else
# مرحبا!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
شكراً ، تطبيق دور
@endif

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
إن واجهتك مشكلة فى الضغط على زر "{{ $actionText }}", فضلا ، قوم بنسخ الرابط التالى الى متصفحك<br>
[{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent


</div>