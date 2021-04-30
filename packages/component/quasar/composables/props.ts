export const defaultComponentProps = {
  id: {
    type: String,
    default: "",
  },
  classes: {
    type: [String, Array, Object],
    default: "",
  },
  styles: {
    type: [String, Array, Object],
    default: "",
  },
  extra: {
    type: Object,
    default: {},
  },
};

export const defaultComponentChildrenProps = {
  children: {
    type: Array,
    default: [],
  },
};

export const defaultComponentDialogProps = {
  dialog: {
    type: Object,
  },
};

export const defaultComponentTableProps = {
  url: {
    type: String,
    required: true,
  },
  columns: {
    type: Array,
    required: true,
    default: [],
  },
  pagination: {
    type: Object,
  },
};

export const defaultComponentFormProps = {
  action: {
    type: String,
    default: "",
  },
  method: {
    type: String,
    default: "POST",
  },
  messages: {
    type: Object,
    default: {},
  },
  children: {
    type: Array,
    default: [],
  },
};

export const defaultComponentFieldProps = {
  name: {
    type: String,
    default: "",
  },
  label: {
    type: String,
    default: "",
  },
  hint: {
    type: String,
    default: "",
  },
  value: {
    type: String,
    default: "",
  },
};

export const defaultComponentInputFieldProps = {
  type: {
    type: String,
    default: "text",
  },
  placeholder: {
    type: String,
    default: "",
  },
};
