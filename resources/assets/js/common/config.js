const config = {
  name: "WeiKit",
  baseUrl: window.location ? window.location.origin : "",
  api: {
    admin: {
      menu: "/api/v1/admin/menu",
      auth: {
        login: "/api/v1/admin/login",
      },
    },
  },
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
  mountId: "#app",
  quasarOptions: {},
  vuetifyOptions: {},
  appOptions: {},

  ...(window.G || {}),
};

window.G = config;

export default config;
