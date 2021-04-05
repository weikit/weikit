import { update } from "lodash";
import { inject, provide, reactive, readonly, watch } from "vue";

export const FORM_PROVIDE_KEY = Symbol("form");
export const INIT_FORM_PROVIDE_KEY = Symbol("init_form");
export const UPDATE_FORM_PROVIDE_KEY = Symbol("update_form");
export const RESET_FORM_PROVIDE_KEY = Symbol("reset_form");
export const SUBMIT_FORM_PROVIDE_KEY = Symbol("submit_form");

export function useFormProvide(props) {
  const defaultForm = reactive({});
  const form = reactive({});

  const initForm = (key, value) => {
    defaultForm[key] = value;
    updateForm(key, value);
  };

  const updateForm = (key, value) => {
    form[key] = value;
  };

  const resetForm = () => {
    Object.keys(defaultForm).map(key => updateForm(key, defaultForm[key]));
  };

  const submitForm = () => {};

  provide(FORM_PROVIDE_KEY, readonly(form));
  provide(INIT_FORM_PROVIDE_KEY, initForm);
  provide(UPDATE_FORM_PROVIDE_KEY, updateForm);
  provide(RESET_FORM_PROVIDE_KEY, resetForm);
  provide(SUBMIT_FORM_PROVIDE_KEY, submitForm);

  return { form, initForm, updateForm, updateForm, resetForm, submitForm };
}

export function useFormInject(
  props,
  { initFormValue = true, watchValue = true, emit = undefined } = {}
) {
  const form = inject(FORM_PROVIDE_KEY);
  const updateForm = inject(UPDATE_FORM_PROVIDE_KEY);
  const initForm = inject(INIT_FORM_PROVIDE_KEY);

  if (updateForm) {
    // init value
    if (initFormValue && props.name) {
      initForm(props.name, props.value);
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
