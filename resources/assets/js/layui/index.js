import "layui-src/src/layui";
import "layui-src/src/lay/all";
import "layui-src/src/lay/modules/jquery";
import "./boot/browser";

window.jQuery = window.$ = layui.$; // jQuery优先加载到全局

const loadedCss = [
  "layui.css",
  "modules/laydate/default/laydate.css",
  "modules/layer/default/layer.css",
  "modules/code.css",
];
const { addcss, use } = layui;
layui.addcss = function (filename, fn, ...args) {
  // 核心模块css已在外部加载, 内部做已加载处理
  if (loadedCss.find((file) => filename.indexOf(file) == 0)) {
    typeof fn === "function" && setTimeout(fn, 100);
    return this;
  }

  return addcss.apply(this, [filename, fn, ...args]);
};

// 排除mobile和jquery两个模块
const files = require.context(
  "layui-src/src/lay/modules",
  false,
  /^(?!.*(?:mobile.js|jquery.js$)).*\.js$/i
);
files.keys().forEach((key) => files(key));

layui.use = function (...args) {
  // layui.all模式下 use是同步模式. 调整保持异步模式
  setTimeout(() => use.apply(this, args));
  return this;
};

// ajax 基础设定
$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
  },

  error: window.$errorHandler
    ? (jqXHR, textStatus, errorMsg) => {
        // 模拟 axios错误
        $errorHandler({
          response: {
            data: jqXHR.responseJSON,
          },
        });
      }
    : undefined,
});
