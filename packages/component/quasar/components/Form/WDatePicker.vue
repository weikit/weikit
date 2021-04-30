<template>
  <q-input
    :id="id"
    :label="label"
    :class="classes"
    :placeholder="placeholder"
    :hint="hint"
    v-bind="extra"
    v-model="value"
    :type="type"
  >
    <template v-slot:append>
      <q-icon name="event" class="cursor-pointer">
        <q-popup-proxy
          ref="qDateProxy"
          transition-show="scale"
          transition-hide="scale"
        >
          <q-date>
            <div class="row items-center justify-end">
              <q-btn v-close-popup label="Close" color="primary" flat />
            </div>
          </q-date>
        </q-popup-proxy>
      </q-icon>
    </template>
  </q-input>
</template>

<script>
import { defineComponent, toRefs } from "vue";
import {
  defaultComponentFieldProps,
  defaultComponentInputFieldProps,
  defaultComponentProps,
} from "../../composables";

import {
  useFormInject,
  useFieldAttrs,
  useInputFieldAttrs,
} from "../../composables/form";

export default defineComponent({
  props: {
    ...defaultComponentProps,
    ...defaultComponentFieldProps,
    ...defaultComponentInputFieldProps,
    type: {
      type: String,
      default: "",
    },
  },
  setup(props, { emit }) {
    const { updateForm } = useFormInject(fieldAtts, { emit });

    return {
      ...toRefs(props),
      ...toRefs(inputFieldAttrs),
    };
  },
});
</script>
