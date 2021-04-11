import { merge, pick } from "lodash-es";
import axios from "axios";
import { inject, provide, reactive, readonly, watch } from "vue";
import { Dialog, Notify } from "quasar";
import { defaultComponentProps } from "./component";

const SCENE_SUBMIT_CONFIRM = "submit_confirm";
const SCENE_SUBMIT_CANCEL = "submit_cancel";
const SCENE_SUBMIT_SUCCESS = "submit_success";
const SCENE_RESET_CONFIRM = "reset_confirm";
const SCENE_RESET_SUCCESS = "reset_success";
const SCENE_RESET_CANCEL = "reset_cancel";

const defaultFormProps = {
  ...defaultComponentProps,
  action: {
    type: String,
    default: "",
  },
  method: {
    type: String,
    default: "POST",
  },
  messages: {
    type: Object,
    default: {},
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

let http;
export function setFormHttp(httpInstance) {
  http = httpInstance;
}

export function useFormProvide(attrs) {
  const onSubmitFormEvent = inject("on_form_submit");

  const defaultFormValue = reactive({});
  const form = reactive({
    action: attrs.action || location.href,
    method: attrs.method || "POST",
    submitting: false,
    reseting: false,
    value: {},
  });

  const initForm = async (key, value) => {
    defaultFormValue[key] = value;
    updateForm(key, value);
  };

  const updateForm = async (key, value) => {
    form.value[key] = value;
  };

  const resetForm = async () => {
    const confirm = async () => {
      try {
        form.reseting = true;
        Object.keys(defaultFormValue).map((key) =>
          updateForm(key, defaultFormValue[key])
        );
        if (attrs.messages[SCENE_RESET_SUCCESS]) {
          Notify.create({
            message: attrs.messages[SCENE_RESET_SUCCESS],
            position: "top",
          });
        }
      } finally {
        form.reseting = false;
      }
    };
    const cancel = async () => {
      if (attrs.messages[SCENE_RESET_CANCEL]) {
        Dialog.create({
          message: attrs.messages[SCENE_RESET_CANCEL],
        });
      }
    };

    if (attrs.messages[SCENE_RESET_CONFIRM]) {
      Dialog.create({
        message: attrs.messages[SCENE_RESET_CONFIRM],
        cancel: true,
      })
        .onOk(confirm)
        .onCancel(cancel)
        .onDismiss(cancel);
    } else {
      return confirm();
    }
  };

  const submitForm = async () => {
    const confirm = async () => {
      try {
        form.submitting = true;
        const { data } = await http({
          url: form.action,
          method: form.method,
          data: form.value,
        });

        const message = data.message || attrs.messages[SCENE_SUBMIT_SUCCESS];
        if (message) {
          Notify.create({
            message,
            position: "top",
          });
        }

        if (onSubmitFormEvent) {
          if (attrs.id) {
            onSubmitFormEvent({
              id: attrs.id,
              form: readonly(form),
              data: readonly(data),
            });
          } else {
            console.warn(
              "Cannot trigger submitFormEvent becase form.id does not specified"
            );
          }
        }
      } finally {
        form.submitting = false;
      }
    };
    const cancel = async () => {
      if (attrs.messages[SCENE_SUBMIT_CANCEL]) {
        Dialog.create({
          message: attrs.messages[SCENE_SUBMIT_CANCEL],
        });
      }
    };

    if (attrs.messages[SCENE_SUBMIT_CONFIRM]) {
      Dialog.create({
        message: attrs.messages[SCENE_SUBMIT_CONFIRM],
        cancel: true,
      })
        .onOk(confirm)
        .onCancel(cancel)
        .onDismiss(cancel);
    } else {
      return confirm();
    }
  };

  provide(FORM_PROVIDE_KEY, readonly(form));
  provide(INIT_FORM_PROVIDE_KEY, initForm);
  provide(UPDATE_FORM_PROVIDE_KEY, updateForm);
  provide(RESET_FORM_PROVIDE_KEY, resetForm);
  provide(SUBMIT_FORM_PROVIDE_KEY, submitForm);

  return { form, initForm, updateForm, updateForm, resetForm, submitForm };
}

export function useFormInject(
  attrs,
  { initFormValue = true, watchValue = true, emit = undefined } = {}
) {
  const form = inject(FORM_PROVIDE_KEY);
  const initForm = inject(INIT_FORM_PROVIDE_KEY);
  const updateForm = inject(UPDATE_FORM_PROVIDE_KEY);
  const resetForm = inject(RESET_FORM_PROVIDE_KEY);
  const submitForm = inject(SUBMIT_FORM_PROVIDE_KEY);

  if (updateForm && attrs.name) {
    // init value
    if (initFormValue) {
      initForm(attrs.name, attrs.value);
    }

    // watch value two way binging for auto update
    if (watchValue) {
      watch(
        () => attrs.value,
        (val) => {
          updateForm(attrs.name, val);

          if (emit) {
            emit("input", val);
          }
        }
      );
      watch(
        () => form.value[attrs.name],
        (val) => (attrs.value = val)
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
