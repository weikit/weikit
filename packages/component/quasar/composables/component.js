import { reactive } from "vue";
import { merge, pick } from "lodash-es";

export const components = {
  form: "WForm",
  button: "WButton",
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
  captcha: "WCaptcha",

  card: "WCard",
  cardTitle: "WCardTitle",

  tabs: "WTabs",
  tab: "WTab",

  grid: "WGrid",
};

export function useComponent(options) {
  const key = options.key;

  if (!components[key]) {
    throw new Error(
      `The key type '${key}' of component has not been implemented`
    );
  }

  options.componentName = components[key];

  return reactive(options);
}

export const defaultComponentProps = {
  id: {
    type: String,
    default: "",
  },
  classes: {
    type: [String, Array, Object],
    default: "",
  },
  styles: {
    type: [String, Array, Object],
    default: "",
  },
  extra: {
    type: Object,
    default: {},
  },
};

export function makeComponentProps(replaceProps = {}) {
  return merge({}, defaultComponentProps, replaceProps);
}

export function useComponentAttrs(props) {
  return reactive(pick(props, Object.keys(defaultComponentProps)));
}

export function makeChildrenProps() {
  return {
    children: {
      type: Array,
      default: [],
    },
  };
}

export function useChildrenAttrs(props) {
  const children = props.children.map(useComponent);

  return reactive({ children });
}
