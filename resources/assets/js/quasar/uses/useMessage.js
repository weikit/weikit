import { Notify } from "quasar";
import { isObjectLike } from "lodash-es";

export function useNotify() {
  const showNotify = async (message) => {
    const data = isObjectLike(message) ? message : { message };

    Notify.create({
      message: "Unknown error",
      position: "top",
      ...data,
    });
  };

  return { showNotify };
}
