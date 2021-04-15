import { reactive } from "vue";
import config from "../../common/config";

export function useConfig() {
  return { config: reactive(config) };
}
