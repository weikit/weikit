import { ref } from "vue";
import { useComponent } from "./component";

export function useDialog(props) {
  const dialog = useComponent(props.dialog);

  const dialogVisible = ref(false);

  const showDialog = function () {
    dialogVisible.value = true;

    return false;
  };

  const hideDialog = function () {
    dialogVisible.value = false;

    return false;
  };

  return { dialog, dialogVisible, showDialog, hideDialog };
}
