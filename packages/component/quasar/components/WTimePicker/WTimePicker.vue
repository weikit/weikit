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
import { defineComponent, toRefs } from "vue";
import {
  makeFieldProps,
  makeInputFieldProps,
  useFieldAttrs,
  useInputFieldAttrs,
} from "../../composables/field";

export default defineComponent({
  props: {
    ...makeFieldProps(),
    ...makeInputFieldProps(),
    type: {
      type: String,
      default: "",
    },
  },
  setup(props) {
    const fieldAttrs = useFieldAttrs(props);
    const inputFieldAttrs = useInputFieldAttrs(props);
    const type = ref(props.type);

    return {
      ...toRefs(fieldAttrs),
      ...toRefs(inputFieldAttrs),
      type,
    };
  },
});
</script>
