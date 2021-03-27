<template>
  <q-card>
    <q-tabs :id="id" :class="className" v-model="currentTab">
      <q-tab
        :key="index"
        v-for="({ componentName, ...componentOptions }, index) in children"
        :k="componentName"
        v-bind="componentOptions"
      ></q-tab>
    </q-tabs>

    <q-separator />

    {{ currentTab }}

    <q-tab-panels :id="id" :class="className" v-model="currentTab">
      <component
        :key="index"
        v-for="({ componentName, ...componentOptions }, index) in children"
        :is="componentName"
        v-bind="componentOptions"
      ></component>
    </q-tab-panels>
  </q-card>
</template>

<script>
import { defineComponent, reactive, ref } from "vue";
import { useComponent } from "../../uses";

export default defineComponent({
  props: {
    id: String,
    className: String,
    children: Array,
  },
  setup({ id, className, children }) {
    const currentTab = ref("tab1");

    const switchTab = tab => {
      currentTab.value = tab;
    };

    return {
      currentTab,
      switchTab,

      ...reactive({
        id,
        className,
        children: children
          .map(tab => {
            if (tab.type != "tab") {
              throw new Error("Tabs only allow Tab to be child components");
            }
            return tab;
          })
          .map(useComponent),
      }),
    };
  },
});
</script>
