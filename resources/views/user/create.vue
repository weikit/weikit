<template>
    <div class="q-pa-md">
        <component :is="componentName" v-bind="componentOptions" />
    </div>
</template>

<script>
import { defineComponent } from 'vue';
const { useComponent } = Uses;

export default defineComponent({
    props: {
        schema: Object,
    },
    setup(props) {
        const { componentName, ...componentOptions } = useComponent(props.schema);
        return {
            componentName,
            componentOptions,
        };
    },
});
</script>
