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

export function useLogin() {
  const { config } = useConfig();
  const { setUser } = useUser();

  const login = async ({ url = config.api.auth.login, data }) => {
    const res = await http.post(url, data);
    setUser(res.data);
  };

  return { login };
}
