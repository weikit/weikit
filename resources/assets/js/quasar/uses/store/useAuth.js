import config from "../../../common/config";
import http from "../../../common/http";

export function useLogin({ url = config.api.admin.auth.login } = {}) {
  const login = async (data) => {
    const user = await http.post(url, data);

    return user;
  };

  return { login };
}
