<template>
  <q-layout>
    <q-page-container>
      <q-page class="flex flex-center">
        <component :is="componentName" v-bind="componentOptions" />
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
const { defineComponent, provide } = Vue;
const { useComponent } = Uses;

export default defineComponent({
  props: {
    schema: Object,
  },
  setup(props) {
    const { componentName, ...componentOptions } = useComponent(props.schema);

    return {
      t,
      q,
      form,
      componentName,
      componentOptions,
      captchaShow,
      handleLogin,
      // captchaUrl,
      // updateCaptchaUrl
    };
  },
});
</script>
