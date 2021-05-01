import { merge, pick } from "lodash-es";
import { computed, inject, provide, reactive, readonly, ref, watch } from "vue";
import { Dialog, Notify } from "quasar";
import { emitComponentEvent } from "./event";
import { useComponentHttp } from "./http";

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

let useFormCallback;
export function setForm(callback: Function) {
  useFormCallback = callback;
}

function makeForm(props) {
  const http = useComponentHttp();

  if (useFormCallback) return useFormCallback(props, { http });

  const defaultFormData = reactive({});
  const form = reactive({
    id: props.id,
    url: props.url || location.href,
    method: props.method || "POST",
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
        if (props.messages[SCENE_RESET_SUCCESS]) {
          Notify.create({
            message: props.messages[SCENE_RESET_SUCCESS],
            position: "top",
          });
        }
      } finally {
        form.processing = false;
      }
    };
    const cancel = async () => {
      if (props.messages[SCENE_RESET_CANCEL]) {
        Dialog.create({
          message: props.messages[SCENE_RESET_CANCEL],
        });
      }
    };

    if (props.messages[SCENE_RESET_CONFIRM]) {
      Dialog.create({
        message: props.messages[SCENE_RESET_CONFIRM],
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

        const message = data.message || props.messages[SCENE_SUBMIT_SUCCESS];
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

        if (props.id) emitComponentEvent(`form_submit:${props.id}`, event);
        emitComponentEvent(`form_submit`, event);
      } catch (e) {
        console.log(e);
        const { status, data } = e.response || {};

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
      if (props.messages[SCENE_SUBMIT_CANCEL]) {
        Dialog.create({
          message: props.messages[SCENE_SUBMIT_CANCEL],
        });
      }
    };

    if (props.messages[SCENE_SUBMIT_CONFIRM]) {
      Dialog.create({
        message: props.messages[SCENE_SUBMIT_CONFIRM],
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

export function useFormProvide(props) {
  const { form, initForm, updateForm, resetForm, submitForm } = makeForm(props);

  provide(FORM_PROVIDE_KEY, readonly(form));
  provide(INIT_FORM_PROVIDE_KEY, initForm);
  provide(UPDATE_FORM_PROVIDE_KEY, updateForm);
  provide(RESET_FORM_PROVIDE_KEY, resetForm);
  provide(SUBMIT_FORM_PROVIDE_KEY, submitForm);

  return { form, initForm, updateForm, resetForm, submitForm };
}

export function useFormInject(
  props,
  { initFormValue = true, watchValue = true, emit = null } = {}
) {
  const form: any = inject(FORM_PROVIDE_KEY);
  const initForm: Function = inject(INIT_FORM_PROVIDE_KEY);
  const updateForm: Function = inject(UPDATE_FORM_PROVIDE_KEY);
  const resetForm: Function = inject(RESET_FORM_PROVIDE_KEY);
  const submitForm: Function = inject(SUBMIT_FORM_PROVIDE_KEY);

  const value = ref(props.value);

  if (updateForm && props.name) {
    // init value
    if (initFormValue) {
      initForm(props.name, props.value);
    }

    // watch value two way binging for auto update
    if (watchValue) {
      watch(
        () => props.value,
        (val) => {
          updateForm(props.name, val);

          if (emit) {
            emit("input", val);
          }
        }
      );
      watch(
        () => form.data[props.name],
        (val) => (value.value = val)
      );
    }
  }

  const errors = computed(() => {
    let errors = [];

    Object.keys(form.errors).forEach((key) => {
      if (key == props.name) {
        errors = form.errors[props.name];
      }
    });

    return errors;
  });

  const isValid = computed(() => !(errors.value.length > 0));

  return {
    value,
    form,
    errors,
    isValid,
    initForm,
    updateForm,
    resetForm,
    submitForm,
  };
}
