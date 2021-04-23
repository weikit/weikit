import { merge, pick } from "lodash-es";
import { reactive } from "vue";
import { defaultComponentProps, useChildrenAttrs } from "./component";
import { useComponentHttp } from "./http";
import { Model as BaseModel } from "vue-api-query";

const defaultTableProps = {
  ...defaultComponentProps,
  url: {
    type: String,
    required: true,
  },
  columns: {
    type: Array,
    required: true,
    default: [],
  },
  pagination: {
    type: Object,
  },
};

export function makeTableProps(replaceProps = {}) {
  return merge({}, defaultTableProps, replaceProps);
}

export function useTableAttrs(props) {
  return reactive({
    ...pick(props, Object.keys(defaultComponentProps)),
    ...useTableColumnsAttrs(props),
    ...useTableDataAttrs(props),
  });
}

export function useTableColumnsAttrs(props) {
  const columns = props.columns.map(useTableColumnAttrs);

  const atts = {
    columns,
  };

  return reactive(atts);
}

export function useTableColumnAttrs(props) {
  const attrs = props.key == "action" ? useChildrenAttrs(props) : {};
  return reactive({
    field: (row) => row[props.name],
    format: (val) => `${val}`,
    align: "center",

    ...props,
    ...attrs,
  });
}

export function useTableDataAttrs(props) {
  const atts = {
    loading: false,
    rows: [],
    pagination: {
      sortBy: "desc",
      descending: false,
      page: 1,
      rowsPerPage: 15,
      rowsNumber: 0,
    },
  };

  return reactive(atts);
}

let useTableCallback;
export function setTable(callback: Function) {
  useTableCallback = callback;
}

export function useTable(props) {
  const http = useComponentHttp();

  const attrs = useTableAttrs(props);

  if (useTableCallback) useTableCallback(attrs, { http });

  const url = props.url || "";

  const Search = class extends BaseModel {
    baseURL() {
      return props.url;
    }
    // Implement a default request method
    request(config) {
      return http.request(config);
    }
    // TODO fix '/' slash 301 Moved Permanently
    resource() {
      return "";
    }
  };

  const request = async ({ filter, pagination }) => {
    const { sortBy, descending, page, rowsPerPage } = pagination || {};
    const req = new Search();

    if (sortBy) {
      req.orderBy(`${descending ? "-" : ""}${sortBy}`);
    }

    if (rowsPerPage) {
      req.limit(rowsPerPage);
    }

    if (page) {
      req.page(page);
    }

    return req.get() as any;
  };

  const loadData = async (search: any = {}) => {
    try {
      attrs.loading = true;
      const { data, current_page, per_page, total } = await request(search);

      attrs.rows = data;
      attrs.pagination.page = current_page;
      attrs.pagination.rowsPerPage = per_page;
      attrs.pagination.rowsNumber = total;
      attrs.pagination.sortBy = search.pagination.sortBy;
      attrs.pagination.descending = search.pagination.descending;
    } finally {
      attrs.loading = false;
    }
  };

  return { attrs, loadData };
}
