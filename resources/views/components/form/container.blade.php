@props([
    'form',
])

<form
    wire:submit.prevent="{{ $form->submitMethod }}"
    {{ $attributes }}
>
    <x-weikit::form.layout :schema="$form->schema" :columns="$form->columns" />

    {{ $slot }}
</form>
