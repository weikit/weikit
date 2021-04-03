import { ref } from "vue";

export function useCaptcha({ url }) {
  const captchaUrl = ref(url);
  const updateCaptchaUrl = () => {
    captchaUrl.value = `${url}&t=${new Date().getTime()}`;
  };

  return { captchaUrl, updateCaptchaUrl };
}
