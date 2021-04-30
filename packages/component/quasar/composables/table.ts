import { reactive, ref } from "vue";
import { useComponent } from "./component";
import { useComponentHttp } from "./http";
import { Model as BaseModel } from "vue-api-query";

export function useTableColumns(props) {
  const columns = props.columns.map(useTableColumn);

  return { columns: reactive(columns) };
}

export function useTableColumn(props) {
  const attrs = props.key == "action" ? props.children.map(useComponent) : {};
  return reactive({
    field: (row) => row[props.name],
    format: (val) => `${val}`,
    align: "center",

    ...props,
    ...attrs,
  });
}

let useTableCallback;
export function setTable(callback: Function) {
  useTableCallback = callback;
}

export function useTable(props) {
  const http = useComponentHttp();

  if (useTableCallback) useTableCallback(props, { http });

  const url = props.url || "";

  const Search = class extends BaseModel {
    baseURL() {
      return url;
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
  const loading = ref(false);
  const pagination = reactive({
    rows: [],
    sortBy: "desc",
    descending: false,
    page: 1,
    rowsPerPage: 15,
    rowsNumber: 0,
  });

  const loadData = async (search: any = {}) => {
    try {
      loading.value = true;
      const { data, current_page, per_page, total } = await request(search);

      pagination.rows = data;
      pagination.page = current_page;
      pagination.rowsPerPage = per_page;
      pagination.rowsNumber = total;
      pagination.sortBy = search.pagination.sortBy;
      pagination.descending = search.pagination.descending;
    } finally {
      loading.value = false;
    }
  };

  return { loading, pagination, loadData };
}
