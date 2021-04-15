import "../../common/browser";
import * as Quasar from "quasar";
import * as VueI18n from "vue-i18n";
import * as Uses from "../composables";
import { Inertia } from "@inertiajs/inertia";

(window as any).Uses = Uses;
(window as any).Quasar = Quasar;
(window as any).VueI18n = VueI18n;
(window as any).Inertia = Inertia;
