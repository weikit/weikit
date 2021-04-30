import { reactive, ref, resolveComponent } from "vue";
import { useComponent } from "./component";

export function useDialog(props) {
  const dialog = useComponent(props.dialog);

  const dialogVisible = ref(false);

  const showDialog = function () {
    dialogVisible.value = true;
  };

  const hideDialog = function () {
    dialogVisible.value = false;
  };

  return { dialog, dialogVisible, showDialog, hideDialog };
}
