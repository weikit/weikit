import {
  defineAsyncComponent,
  defineComponent as defineVueComponent,
  ref,
  watch,
  isRef,
  toRaw,
} from "vue";

const MAIN_COMPONENT_NAME = "main";

let watchingComponent = {};

export function hookComponent({ name = MAIN_COMPONENT_NAME } = {}) {
  // notice: first component must be registered before app create

  if (watchingComponent[name]) {
    // hook sync page component
    const component = watchingComponent[name];
    delete watchingComponent[name];

    return component;
  } else {
    // hook async page component
    return defineAsyncComponent({
      loader: async () => {
        return new Promise((resolve, reject) => {
          watchingComponent[name] = ref(null);
          // TODO  stop when watchingPage[name] has been replaced
          const stop = watch(() => {
            if (watchingComponent[name].value) {
              const component = toRaw(watchingComponent[name]);
              if (typeof component === "object") {
                // stop(); // stop watch
                resolve(component);
              } else {
                reject(new Error("Load page component failed"));
              }
            }
          });
        });
      },
    });
  }
}

export function defineComponent(options, { name = MAIN_COMPONENT_NAME } = {}) {
  const component = defineVueComponent(options);

  if (isRef(watchingComponent[name])) {
    // register sync page component when it is not hooked
    watchingComponent[name].value = component;
  } else {
    // register async page component when is hooked
    watchingComponent[name] = component;
  }

  return component;
}
