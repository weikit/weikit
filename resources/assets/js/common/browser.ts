import * as Vue from "vue";
import * as Lodash from "lodash-es";
import jQuery from "jquery";
import * as Weikit from "./weikit";

(window as any).Vue = Vue;
(window as any).Weikit = Weikit;
(window as any).jQuery = (window as any).$ = jQuery;
(window as any).Lodash = (window as any)._ = Lodash;
