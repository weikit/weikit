import { merge, pick } from "lodash-es";
import { inject, provide, reactive, readonly, ref, watch } from "vue";
import { defaultComponentProps } from "./component";

const defaultFormProps = {
  ...defaultComponentProps,
  action: {
    default: "",
  },
  method: {
    default: "POST",
  },
};

export function makeFormProps(replaceProps = {}) {
  return merge({}, defaultFormProps, replaceProps);
}

export function useFormAttrs(props) {
  return reactive(pick(props, Object.keys(defaultFormProps)));
}

const FORM_PROVIDE_KEY = Symbol("form");
const INIT_FORM_PROVIDE_KEY = Symbol("init_form");
const UPDATE_FORM_PROVIDE_KEY = Symbol("update_form");
const RESET_FORM_PROVIDE_KEY = Symbol("reset_form");
const SUBMIT_FORM_PROVIDE_KEY = Symbol("submit_form");

export function useFormProvide(props) {
  const defaultFormValue = reactive({});
  const form = reactive({
    action: props.action || location.href,
    method: props.method || "POST",
    value: {},
  });

  const initForm = (key, value) => {
    defaultFormValue[key] = value;
    updateForm(key, value);
  };

  const updateForm = (key, value) => {
    form.value[key] = value;
  };

  const resetForm = () => {
    Object.keys(defaultFormValue).map(key => updateForm(key, defaultForm[key]));
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
  const action = inject();
  const initForm = inject(INIT_FORM_PROVIDE_KEY);
  const updateForm = inject(UPDATE_FORM_PROVIDE_KEY);
  const resetForm = inject(RESET_FORM_PROVIDE_KEY);
  const submitForm = inject(SUBMIT_FORM_PROVIDE_KEY);

  if (updateForm && props.name) {
    // init value
    if (initFormValue) {
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

  return { form, initForm, updateForm, resetForm, submitForm };
}

const defaultFieldProps = {
  ...defaultComponentProps,
  name: {
    type: String,
    default: "",
  },
  label: {
    type: String,
    default: "",
  },
  hint: {
    type: String,
    default: "",
  },
  value: {
    type: String,
    default: "",
  },
};

export function makeFieldProps(replaceProps = {}) {
  return merge({}, defaultFieldProps, replaceProps);
}

export function useFieldAttrs(props) {
  return reactive(pick(props, Object.keys(defaultFieldProps)));
}

const defaultInputFieldProps = {
  placeholder: {
    type: String,
    default: "",
  },
};

export function makeInputFieldProps(replaceProps = {}) {
  return merge(defaultInputFieldProps, replaceProps);
}

export function useInputFieldAttrs(props) {
  return reactive(pick(props, Object.keys(defaultInputFieldProps)));
}
