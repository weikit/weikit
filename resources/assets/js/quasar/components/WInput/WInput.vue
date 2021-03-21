<template>
  <q-input
    :id="id"
    :type="type"
    :label="label"
    :class="className"
    :placeholder="placeholder"
    :hint="hint"
    :maxlength="maxLength"
    :minlength="minlength"
  />
</template>

<script>
import { defineComponent, toRefs } from "vue";

export default defineComponent({
  props: {
    id: String,
    type: String,
    label: String,
    name: String,
    className: String,
    placeholder: String,
    hint: String,
    maxLength: Number,
    minLength: Number,
  },
  setup({
    id,
    className,
    type,
    label,
    name,
    placeholder,
    hint,
    maxLength,
    minLength,
  }) {
    return {
      ...toRefs({
        id,
        type,
        className,
        label,
        name,
        placeholder: placeholder || label || name,
        hint,
        maxLength,
        minLength,
      }),
    };
  },
});
</script>
