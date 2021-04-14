import { merge, pick, cloneDeep } from "lodash-es";
import { AxiosInstance } from "axios";
import {
  computed,
  ErrorCodes,
  inject,
  provide,
  reactive,
  readonly,
  watch,
} from "vue";
import { Dialog, Notify } from "quasar";
import { defaultComponentProps, useChildrenAttrs } from "./component";
import { emitComponentEvent } from "./event";

const SCENE_SUBMIT_CONFIRM = "submit_confirm";
const SCENE_SUBMIT_CANCEL = "submit_cancel";
const SCENE_SUBMIT_SUCCESS = "submit_success";
const SCENE_RESET_CONFIRM = "reset_confirm";
const SCENE_RESET_SUCCESS = "reset_success";
const SCENE_RESET_CANCEL = "reset_cancel";

const FORM_PROVIDE_KEY = Symbol("form");
const INIT_FORM_PROVIDE_KEY = Symbol("init_form");
const UPDATE_FORM_PROVIDE_KEY = Symbol("update_form");
const RESET_FORM_PROVIDE_KEY = Symbol("reset_form");
const SUBMIT_FORM_PROVIDE_KEY = Symbol("submit_form");

let http: AxiosInstance;
export function setFormHttp(httpInstance: AxiosInstance) {
  http = httpInstance;
}

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
  children: {
    type: Array,
    default: [],
  },
};

export function makeFormProps(replaceProps = {}) {
  return merge({}, defaultFormProps, replaceProps);
}

export function useFormAttrs(props) {
  return reactive({
    ...pick(props, Object.keys(defaultFormProps)),
    ...useChildrenAttrs(props),
  });
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
  type: {
    type: String,
    default: "text",
  },
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

let useForm;
export function setUseForm(callback: Function) {
  useForm = callback;
}

function makeForm(attrs) {
  if (useForm) return useForm(attrs);

  const defaultFormData = reactive({});
  const form = reactive({
    id: attrs.id,
    url: attrs.url || location.href,
    method: attrs.method || "POST",
    processing: false,
    errors: {},
    data: {},
  });

  const initForm = async (key, value) => {
    defaultFormData[key] = value;
    updateForm(key, value);
  };

  const updateForm = async (key, value) => {
    form.data[key] = value;
  };

  const resetForm = async () => {
    const confirm = async () => {
      try {
        form.processing = true;
        Object.keys(defaultFormData).map((key) =>
          updateForm(key, defaultFormData[key])
        );
        if (attrs.messages[SCENE_RESET_SUCCESS]) {
          Notify.create({
            message: attrs.messages[SCENE_RESET_SUCCESS],
            position: "top",
          });
        }
      } finally {
        form.processing = false;
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
        form.errors = {};
        form.processing = true;
        const { data } = await http({
          url: form.url,
          method: form.method,
          data: form.data,
        });

        const message = data.message || attrs.messages[SCENE_SUBMIT_SUCCESS];
        if (message) {
          Notify.create({
            message,
            position: "top",
          });
        }
        const event = {
          form: readonly(form),
          data: readonly(data),
        };

        if (attrs.id) emitComponentEvent(`form_submit:${attrs.id}`, event);
        emitComponentEvent(`form_submit`, event);
      } catch (e) {
        const {
          response: { status, data },
        } = e;

        form.errors = {};
        if (status == 422) {
          form.errors = data.errors;
        }

        throw e;
      } finally {
        form.processing = false;
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

  return { form, initForm, updateForm, resetForm, submitForm };
}

export function useFormProvide(attrs) {
  const { form, initForm, updateForm, resetForm, submitForm } = makeForm(attrs);

  provide(FORM_PROVIDE_KEY, readonly(form));
  provide(INIT_FORM_PROVIDE_KEY, initForm);
  provide(UPDATE_FORM_PROVIDE_KEY, updateForm);
  provide(RESET_FORM_PROVIDE_KEY, resetForm);
  provide(SUBMIT_FORM_PROVIDE_KEY, submitForm);

  return { form, initForm, updateForm, resetForm, submitForm };
}

export function useFormInject(
  attrs,
  { initFormValue = true, watchValue = true, emit = null } = {}
) {
  const form: any = inject(FORM_PROVIDE_KEY);
  const initForm: Function = inject(INIT_FORM_PROVIDE_KEY);
  const updateForm: Function = inject(UPDATE_FORM_PROVIDE_KEY);
  const resetForm: Function = inject(RESET_FORM_PROVIDE_KEY);
  const submitForm: Function = inject(SUBMIT_FORM_PROVIDE_KEY);

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
        () => form.data[attrs.name],
        (val) => (attrs.value = val)
      );
    }
  }

  const errors = computed(() => {
    let errors = [];

    Object.keys(form.errors).forEach((key) => {
      if (key == attrs.name) {
        errors = form.errors[attrs.name];
      }
    });

    return errors;
  });

  const isValid = computed(() => !(errors.value.length > 0));

  return { form, errors, isValid, initForm, updateForm, resetForm, submitForm };
}
