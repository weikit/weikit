import { inject, provide, reactive, readonly, watch } from "vue";

export const FORM_PROVIDE_KEY = Symbol("form");
export const UPDATE_FORM_PROVIDE_KEY = Symbol("update_form");

export function useFormProvide() {
  const form = reactive({});

  const updateForm = (key, value) => {
    form[key] = value;
  };

  provide(FORM_PROVIDE_KEY, readonly(form));
  provide(UPDATE_FORM_PROVIDE_KEY, updateForm);

  return { form, updateForm };
}

export function useFormInject(
  props,
  { initFormValue = true, watchValue = true, emit = undefined } = {}
) {
  const form = inject(FORM_PROVIDE_KEY);
  const updateForm = inject(UPDATE_FORM_PROVIDE_KEY);

  if (updateForm) {
    // init value
    if (initFormValue && props.name) {
      updateForm(props.name, props.value);
    }

    // watch value and auto update
    if (watchValue) {
      watch(
        () => props.value,
        val => {
          updateForm(props.name, val);

          if (emit) {
            emit("input", val);
          }
        }
      );
    }
  }

  return { form, updateForm };
}
