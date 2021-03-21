import { reactive, toRefs } from "vue";

export const builderComponents = {
  form: "WForm",
  text: "WInput",
  number: "WInput",
  email: "WInput",
  password: "WInput",
  // url: "WInput",
};

export function useComponent({ type, ...options }) {
  const componentName = builderComponents[type] || "WForm";

  return reactive({ componentName, type, ...options });
}
