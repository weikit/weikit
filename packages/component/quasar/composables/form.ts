import { merge, pick, cloneDeep } from "lodash-es";
import { AxiosInstance } from "axios";
import { inject, provide, reactive, readonly, watch } from "vue";
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
    children: useChildrenAttrs(props.children),
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

export type FormType = {
  errors: {};
  hasErrors: boolean;
  processing: boolean;
  progress: any;
  wasSuccessful: boolean;
  recentlySuccessful: boolean;
  transform: (callback: any) => any;
  reset: (...fields: any[]) => void;
  clearErrors: (...fields: any[]) => void;
  submit: (method: string, url: string, options?: any) => void;
  get: (url: string, options?: any) => void;
  post: (url: string, options?: any) => void;
  put: (url: string, options?: any) => void;
  patch: (url: string, options?: any) => void;
  delete: (url: string, options?: any) => void;
  cancel: () => void;
  [key: string]: any;
};

export function setUseForm(useFormCallback: (...args: any[]) => FormType) {
  useForm = useFormCallback;
}

export let useForm = function (...args) {
  const data = (typeof args[0] === "string" ? args[1] : args[0]) || {};
  const defaults = cloneDeep(data);
  let cancelToken = null;
  let transform = (data) => data;

  let form: FormType = reactive({
    ...data,
    errors: {},
    hasErrors: false,
    processing: false,
    progress: null,
    wasSuccessful: false,
    recentlySuccessful: false,
    data() {
      return Object.keys(data).reduce((carry, key) => {
        carry[key] = this[key];
        return carry;
      }, {});
    },
    transform(callback) {
      transform = callback;

      return this;
    },
    reset(...fields) {
      let clonedDefaults = cloneDeep(defaults);
      if (fields.length === 0) {
        Object.assign(this, clonedDefaults);
      } else {
        Object.assign(
          this,
          Object.keys(clonedDefaults)
            .filter((key) => fields.includes(key))
            .reduce((carry, key) => {
              carry[key] = clonedDefaults[key];
              return carry;
            }, {})
        );
      }

      return this;
    },
    clearErrors(...fields) {
      this.errors = Object.keys(this.errors).reduce(
        (carry, field) => ({
          ...carry,
          ...(fields.length > 0 && !fields.includes(field)
            ? { [field]: this.errors[field] }
            : {}),
        }),
        {}
      );

      this.hasErrors = Object.keys(this.errors).length > 0;

      return this;
    },
    async submit(method, url, options: any = {}) {
      const data = transform(this.data());
      const httpOptions = options.httpOptions || {};
      http[method](url, data, httpOptions);
    },
    get(url, options) {
      this.submit("get", url, options);
    },
    post(url, options) {
      this.submit("post", url, options);
    },
    put(url, options) {
      this.submit("put", url, options);
    },
    patch(url, options) {
      this.submit("patch", url, options);
    },
    delete(url, options) {
      this.submit("delete", url, options);
    },
    cancel() {
      if (cancelToken) {
        cancelToken.cancel();
      }
    },
  });

  return form;
};

function flattenFormDefaults(children: object[]) {
  let defaults = [];

  children.forEach((child: any) => {
    if (child.name && child.value) {
      defaults[child.name] = child.value;
    } else if (child.children && child.key != "WForm") {
      defaults = [...defaults, flattenFormDefaults(child.children)];
    }
  });

  return defaults;
}

export function useFormProvide(attrs) {
  const defaults = flattenFormDefaults(attrs.children);
  const form = useForm(defaults);
  provide(FORM_PROVIDE_KEY, readonly(form));

  return { form };
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
        () => form.value[attrs.name],
        (val) => (attrs.value = val)
      );
    }
  }

  return { form, initForm, updateForm, resetForm, submitForm };
}

export function useFormProvide1(attrs) {
  const defaultFormValue = reactive({});
  const form = reactive({
    id: attrs.id,
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
        const event = {
          form: readonly(form),
          data: readonly(data),
        };

        if (attrs.id) emitComponentEvent(`form_submit:${attrs.id}`, event);
        emitComponentEvent(`form_submit`, event);
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

  return { form, initForm, updateForm, resetForm, submitForm };
}

export function useFormInject1(
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
        () => form.value[attrs.name],
        (val) => (attrs.value = val)
      );
    }
  }

  return { form, initForm, updateForm, resetForm, submitForm };
}
