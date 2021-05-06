import { reactive } from "vue";
import { merge, pick, tap } from "lodash-es";
import { useDialog } from "./dialog";
import {
  defaultComponentChildrenProps,
  defaultComponentDialogProps,
  defaultComponentProps,
} from "./props";

export const components = {
  text: {
    componentName: "WText",
  },
  link: {
    componentName: "WLink",
  },
  button: {
    componentName: "WButton",
  },
  form: {
    componentName: "WForm",
  },
  input: {
    componentName: "WInput",
  },
  checkbox: {
    componentName: "WCheckbox",
  },
  textarea: {
    componentName: "WTextarea",
  },
  select: {
    componentName: "WSelect",
  },
  radio: {
    componentName: "WRadio",
  },
  toggle: {
    componentName: "WToggle",
  },
  datePicker: {
    componentName: "WDatePicker",
  },
  timePicker: {
    componentName: "WTimePicker",
  },
  captcha: {
    componentName: "WCaptcha",
  },
  table: {
    componentName: "WTable",
  },
  tableColumn: {
    componentName: "WTableColumn",
  },
  card: {
    componentName: "WCard",
  },
  cardTitle: {
    componentName: "WCardTitle",
  },
  tabs: {
    componentName: "WTabs",
  },
  tab: {
    componentName: "WTab",
  },
  grid: {
    componentName: "WGrid",
  },
  dialog: {
    componentName: "WDialog",
  },
  detail: {
    componentName: "WDetail",
  },
  detailField: {
    componentName: "WDetailField",
  },
};

export function useComponent(options) {
  if (!components[options.key]) {
    throw new Error(
      `The key type '${options.key}' of component has not been implemented`
    );
  }

  return reactive({
    ...options,
    ...components[options.key],
  });
}

export function useComponentChildren(props) {
  const children = props.children.map(useComponent);

  return { children: reactive(children) };
}
