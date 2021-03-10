<div
    aria-labelledby="{{ "{$formComponent->parent->id}.{$formComponent->id}" }}"
    id="{{ "{$formComponent->parent->id}.{$formComponent->id}-tab" }}"
    role="tabpanel"
    tabindex="0"
    x-show="tab === '{{ "{$formComponent->parent->id}.{$formComponent->id}" }}'"
    class="p-4 md:p-6"
>
    <x-weikit::form.layout :schema="$formComponent->schema" :columns="$formComponent->columns" />
</div>
