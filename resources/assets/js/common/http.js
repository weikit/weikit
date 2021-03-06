import axios from "axios";

import $config from "./config";

const $http = axios.create({
  timeout: 20000,
  baseURL: $config.baseUrl,
  withCredentials: true,
});

const headers = {
  "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
  "X-Requested-With": "XMLHttpRequest",
};

$http.defaults.headers.common = {
  ...headers,
  ...$http.defaults.headers.common,
};

export default $http;
