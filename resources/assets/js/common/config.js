const config = (window.G = {
  name: "WeiKit",
  baseUrl: window.location ? window.location.origin : "",
  api: {
    admin: {
      menu: "/admin/api/v1/menu",
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
  quasar: {
    id: "#app",
    options: {},
    appOptions: {},
  },
  vuetify: {
    id: "#app",
    options: {},
    appOptions: {},
  },
  ...(window.G || {}),
});

export default config;
