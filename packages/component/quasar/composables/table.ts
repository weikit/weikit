import { merge, pick } from "lodash-es";
import { reactive } from "vue";
import { defaultComponentProps } from "./component";

const defaultTableProps = {
  ...defaultComponentProps,
  columns: {
    type: Array,
    required: true,
    default: [],
  },
  rows: {
    type: Array,
    required: true,
    default: [],
  },
};

export function makeTableProps(replaceProps = {}) {
  return merge({}, defaultTableProps, replaceProps);
}

export function useTableAttrs(props) {
  return reactive(pick(props, Object.keys(defaultTableProps)));
}
