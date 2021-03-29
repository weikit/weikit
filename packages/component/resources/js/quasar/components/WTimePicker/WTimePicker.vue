<template>
  <q-input
    :id="id"
    :type="type"
    :label="label"
    :class="classes"
    :placeholder="placeholder"
    :hint="hint"
    :maxlength="maxLength"
    :minlength="minLength"
  >
    <template v-slot:append>
      <q-icon name="event" class="cursor-pointer">
        <q-popup-proxy
          ref="qDateProxy"
          transition-show="scale"
          transition-hide="scale"
        >
          <q-time>
            <div class="row items-center justify-end">
              <q-btn v-close-popup label="Close" color="primary" flat />
            </div>
          </q-time>
        </q-popup-proxy>
      </q-icon>
    </template>
  </q-input>
</template>

<script>
import { defineComponent, reactive } from "vue";

export default defineComponent({
  props: {
    id: String,
    label: String,
    name: String,
    classes: String,
    placeholder: String,
    hint: String,
  },
  setup({ id, label, name, classes, placeholder, hint }) {
    return {
      ...reactive({
        id,
        label,
        name,
        classes,
        placeholder: placeholder || label || name,
        hint,
      }),
    };
  },
});
</script>
