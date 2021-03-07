import { computed } from "vue";
import config from "../../common/config";

export function useConfig() {
  return { config: computed(() => config) };
}
