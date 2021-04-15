import http from "../../../common/http";
import { readonly, ref } from "vue";
import { useConfig } from "../useConfig";

export function useUser() {
  const { config } = useConfig();
  const user = ref(null);

  const loadUser = async ({
    url = config.api.auth.user,
    force = false,
  } = {}) => {
    if (!user.value || force) {
      const res = await http.get(url);
      setUser(res.data);
    }
  };

  const setUser = async (data) => {
    user.value = data;
  };

  return { user: readonly(user), loadUser, setUser };
}
