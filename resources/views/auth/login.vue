<template>
  <q-layout>
    <q-page-container>
      <q-page class="flex flex-center">
        <component :is="component" v-bind="componentOptions" />
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script>
const { defineComponent } = Vue;
const { useComponent, useComponentEvent } = Uses;

export default defineComponent({
  props: {
    schema: Object,
  },
  setup(props) {
    const { component, ...componentOptions } = useComponent(props.schema);

    useComponentEvent(
      "form_submit",
      ({ data: { url = route("admin.dashboard.layout") } }) => {
        Inertia.locationVisit({ href: url });
      }
    );

    return {
      component,
      componentOptions,
    };
  },
});
</script>
