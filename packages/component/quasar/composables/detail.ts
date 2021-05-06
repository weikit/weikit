import { reactive } from "vue";
import { useComponent } from "./component";

export function useDetailFields(props) {
  const fields = props.fields.map(useDetailField);

  return { fields: reactive(fields) };
}

export function useDetailField(props) {
  return useComponent(props);
}
