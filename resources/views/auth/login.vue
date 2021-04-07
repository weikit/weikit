<template>
  <!-- <q-layout class="a">
    <q-page-container>
      <q-page class="flex flex-center"> -->
  <!-- <component :is="componentName" v-bind="componentOptions" /> -->
  <!-- </q-page>
    </q-page-container>
  </q-layout> -->
  <div class="a">123</div>
</template>

<script>
const { reactive, defineComponent, toRef, ref, watch } = Vue;
const { useLogin, useNotify, useComponent } = Uses;
const { useQuasar } = Quasar;
const { useI18n } = VueI18n;

export default defineComponent({
  //   props: {
  //     schema: Object,
  //   },
  setup(props) {
    //     const q = useQuasar();
    //     const { t } = useI18n();
    //     const { componentName, ...componentOptions } = useComponent(props.schema);
    //     console.log(componentName, componentOptions);
    //     const form = reactive({
    //       username: "",
    //       password: "",
    //       captcha_code: "",
    //       remember: false,
    //     });
    //     const captchaShow = ref(0);
    //     watch(
    //       () => form.password,
    //       () => (captchaShow.value = 1)
    //     );
    //     const { showNotify } = useNotify();
    //     const { login } = useLogin();
    //     const handleLogin = async () => {
    //       const user = await login({ data: form });
    //       showNotify(t("auth.login.success"));
    //       location.href = "{{ route('admin.dashboard') }}";
    //     };
    return {
      //       t,
      //       q,
      //       form,
      //       componentName,
      //       componentOptions,
      //       captchaShow,
      //       handleLogin,
      //       // captchaUrl,
      //       // updateCaptchaUrl
    };
  },
});
</script>

<style scoped>
a {
  background-image: linear-gradient(135deg, #7028e4, #e5b2ca);
}
</style>
