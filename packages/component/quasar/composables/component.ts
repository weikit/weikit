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
    component: "WText",
  },
  link: {
    component: "WLink",
  },
  button: {
    component: "WButton",
  },
  form: {
    component: "WForm",
  },
  input: {
    component: "WInput",
  },
  checkbox: {
    component: "WCheckbox",
  },
  textarea: {
    component: "WTextarea",
  },
  select: {
    component: "WSelect",
  },
  radio: {
    component: "WRadio",
  },
  toggle: {
    component: "WToggle",
  },
  datePicker: {
    component: "WDatePicker",
  },
  timePicker: {
    component: "WTimePicker",
  },
  captcha: {
    component: "WCaptcha",
  },
  table: {
    component: "WTable",
  },
  tableColumn: {
    component: "WTableColumn",
  },
  card: {
    component: "WCard",
  },
  cardTitle: {
    component: "WCardTitle",
  },
  tabs: {
    component: "WTabs",
  },
  tab: {
    component: "WTab",
  },
  grid: {
    component: "WGrid",
  },
  dialog: {
    component: "WDialog",
  },
  detail: {
    component: "WDetail",
  },
  detailField: {
    component: "WDetailField",
  },
};

export function useComponent(options) {
  if (!components[options.component]) {
    throw new Error(
      `The key type '${options.component}' of component has not been implemented`
    );
  }

  return reactive({
    ...options,
    ...components[options.component],
  });
}

export function useComponentChildren(props) {
  const children = props.children.map(useComponent);

  return { children: reactive(children) };
}
