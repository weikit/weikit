@php
    $primaryClasses = $column->primary ? 'font-medium' : null;
@endphp

<div class="py-4">
    @if ($column->action)
        <button
            wire:click="{{ $column->action }}('{{ $record->getKey() }}')"
            type="button"
            class="{{ $primaryClasses }} hover:underline hover:text-primary-600 transition-colors duration-200"
        >
            {{ $column->getValue($record) }}
        </button>
    @elseif ($column->url)
        <a
            href="{{ $column->getUrl($record) }}"
            class="{{ $primaryClasses }} hover:underline hover:text-primary-600 transition-colors duration-200"
            @if ($column->shouldOpenUrlInNewTab)
                target="_blank"
                rel="noopener noreferrer"
            @endif
        >
            {{ $column->getValue($record) }}
        </a>
    @else
        <span class="{{ $primaryClasses }}">{{ $column->getValue($record) }}</span>
    @endif
</div>
