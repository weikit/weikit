import { reactive } from "vue";
import { merge, pick, tap } from "lodash-es";
import { useDialog } from "./dialog";
import {
  defaultComponentChildrenProps,
  defaultComponentDialogProps,
  defaultComponentProps,
} from "./props";

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

export function useComponentProps({
  replaceProps = {},

  hasChildren = false,
  hasDialog = false,
} = {}) {
  const componentProps = merge(
    {
      ...defaultComponentProps,
      ...(hasChildren ? defaultComponentChildrenProps : {}),
      ...(hasDialog ? defaultComponentDialogProps : {}),
    },
    replaceProps
  );

  const makeComponent = (props) => {
    const attrs = reactive({ ...props, dialog: undefined, dialogShow: false });

    if (hasChildren && props?.children.length) {
      attrs.children = props.children.map(useComponent);
    }

    const dialogMethods: any = {};
    if (hasDialog && props?.dialog) {
      attrs.dialog = useDialog(props.dialog);
      dialogMethods.showDialog = () => {
        attrs.dialogShow = true;
      };
    }

    return { attrs: reactive(attrs), ...dialogMethods };
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

export function useComponentChildren(props) {
  const children = props.children.map(useComponent);

  return { children: reactive(children) };
}
