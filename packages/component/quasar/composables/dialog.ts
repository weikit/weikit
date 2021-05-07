import { ref } from "vue";
import { useComponent } from "./component";

export function useDialog(props) {
  const dialog = useComponent(props.dialog);

  const dialogVisible = ref(false);

  const showDialog = (e) => {
    dialogVisible.value = true;
  };

  const hideDialog = (e) => {
    dialogVisible.value = false;
  };

  return { dialog, dialogVisible, showDialog, hideDialog };
}
