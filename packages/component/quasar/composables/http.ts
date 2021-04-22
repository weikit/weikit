import { AxiosInstance } from "axios";

let http: AxiosInstance;
export function setComponentHttp(httpInstance: AxiosInstance) {
  http = httpInstance;
}

export function useComponentHttp(): AxiosInstance {
  return http;
}
