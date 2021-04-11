import api from "./api";
const config = {
  name: "WeiKit",
  baseUrl: window.location ? window.location.origin : "",
  api,
  defaultPaginationData: {
    data: [],
    total: 0,
    from: 0,
    to: 0,
    path: null,
    per_page: 15,
    current_page: 0,
    last_page: 1,
    first_page_url: null,
    last_page_url: null,
    next_page_url: null,
    prev_page_url: null,
    has_next_page: true,
  },
  id: "#app",
  quasarOptions: {},
  vuetifyOptions: {},
  appOptions: {},

  ...((window as any).G || {}),
};

(window as any).G = config;

export default config;
