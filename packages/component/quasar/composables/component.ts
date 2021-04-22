import { reactive } from "vue";
import { merge, pick } from "lodash-es";

export const components = {
  form: {
    componentName: "WForm",
  },
  button: {
    componentName: "WButton",
  },
  text: {
    componentName: "WInput",
  },
  number: {
    componentName: "WInput",
  },
  email: {
    componentName: "WInput",
  },
  password: {
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
