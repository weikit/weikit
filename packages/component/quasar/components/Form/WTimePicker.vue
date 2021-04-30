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
import { merge } from "lodash-es";
import { defineComponent, toRefs } from "vue";
import {
  useFormInject,
  defaultComponentProps,
  defaultComponentFieldProps,
  defaultComponentInputFieldProps,
} from "../../composables";

export default defineComponent({
  props: merge(
    {},
    defaultComponentProps,
    defaultComponentFieldProps,
    defaultComponentInputFieldProps,
    {
      type: {
        type: String,
        default: "",
      },
    }
  ),
  setup(props, { emit }) {
    const { updateForm } = useFormInject(fieldAttrs, { emit });

    return {
      ...toRefs(props),
      type,
    };
  },
});
</script>
