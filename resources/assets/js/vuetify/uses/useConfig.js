import { computed } from "@vue/composition-api";
import config from "../../common/config";

export function useConfig() {
  return { config: computed(() => config) };
}
