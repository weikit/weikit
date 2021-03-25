import { reactive, toRefs } from "vue";

export const builderComponents = {
  form: "WForm",
  text: "WInput",
  number: "WInput",
  email: "WInput",
  password: "WInput",
  // url: "WInput",
  checkbox: "WCheckbox",
  textarea: "WTextarea",
  select: "WSelect",
  select: "WSelect",
  radio: "WRadio",
  toggle: "WToggle",
  datePicker: "WDatePicker",
  timePicker: "WTimePicker",
};

export function useComponent({ type, ...options }) {
  if (!builderComponents[type]) {
    throw new Error(`The type '${type}' of component has not been implemented`);
  }

  const componentName = builderComponents[type];

  return reactive({ componentName, type, ...options });
}
