import { reactive } from "vue";

export const components = {
  form: "WForm",
  text: "WInput",
  number: "WInput",
  email: "WInput",
  password: "WInput",
  // url: "WInput",
  checkbox: "WCheckbox",
  textarea: "WTextarea",
  select: "WSelect",
  radio: "WRadio",
  toggle: "WToggle",
  datePicker: "WDatePicker",
  timePicker: "WTimePicker",

  card: "WCard",
  cardTitle: "WCardTitle",

  tabs: "WTabs",
  tab: "WTab",

  grid: "WGrid",
};

export function useComponent({ type, ...options }) {
  if (!components[type]) {
    throw new Error(`The type '${type}' of component has not been implemented`);
  }

  const componentName = components[type];

  return reactive({ componentName, type, ...options });
}
