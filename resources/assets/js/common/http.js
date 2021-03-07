import axios from "axios";

import $config from "./config";

const $http = axios.create({
  timeout: 20000,
  baseURL: $config.baseUrl,
});

$http.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

export default $http;
