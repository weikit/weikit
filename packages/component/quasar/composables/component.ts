import { reactive } from "vue";
import { merge, pick } from "lodash-es";

export const components = {
  link: {
    componentName: "WLink",
  },
  button: {
    componentName: "WButton",
  },
  form: {
    componentName: "WForm",
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
  dialog: {
    componentName: "WDialog",
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

export const defaultComponentChildrenProps = {
  children: {
    type: Array,
    default: [],
  },
};

export function useComponentProps({
  replaceProps = {},
  hasChildren = false,
} = {}) {
  const componentProps = merge(
    {
      ...(hasChildren ? defaultComponentChildrenProps : {}),
      ...defaultComponentProps,
    },
    replaceProps
  );

  const makeComponent = (props) => {
    const attrs = reactive(pick(props, Object.keys(componentProps)));

    if (attrs?.children.length) {
      attrs.children = props.children.map(useComponent);
    }

    return attrs;
  };

  return { componentProps, makeComponent };
}

// export function makeComponentProps(replaceProps = {}) {
//   return merge({}, defaultComponentProps, replaceProps);
// }

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
