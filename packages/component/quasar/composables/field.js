import { merge, pick } from "lodash-es";
import { reactive } from "vue";
import { defaultComponentProps } from "./component";

const defaultFieldProps = {
  ...defaultComponentProps,
  name: {
    type: String,
    default: "",
  },
  label: {
    type: String,
    default: "",
  },
  hint: {
    type: String,
    default: "",
  },
};

export function makeFieldProps(replaceProps = {}) {
  return merge(defaultFieldProps, replaceProps);
}

export function useFieldAttrs(props) {
  return reactive(pick(props, Object.keys(defaultComponentProps)));
}

const defaultInputFieldProps = {
  placeholder: {
    type: String,
    default: "",
  },
};

export function makeInputFieldProps(replaceProps = {}) {
  return merge(defaultInputFieldProps, replaceProps);
}

export function useInputFieldAttrs(props) {
  return reactive(pick(props, Object.keys(defaultInputFieldProps)));
}
