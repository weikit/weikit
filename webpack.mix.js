const mix = require("laravel-mix");
let publicPath = "../public/backend";

if (__dirname.indexOf("/modules/") >= 0) {
  publicPath = "../../public/backend";
} else if (__dirname.indexOf("/vendor/") >= 0) {
  publicPath = "../../../public/backend";
}

mix
  .version()
  .setResourceRoot("../") // set resource path to /backend/
  .setPublicPath(publicPath)
  .disableSuccessNotifications()

  // @see https://github.com/JeffreyWay/laravel-mix/issues/2569#issuecomment-718251713
  .webpackConfig({
    module: {
      rules: [
        {
          test: /\.mjs$/i,
          resolve: { byDependency: { esm: { fullySpecified: false } } },
        },
      ],
    },
  });

if (!mix.inProduction()) {
  mix.sourceMaps();
}

mix
  .sass(
    __dirname + "/resources/assets/sass/common/index.scss",
    "css/common.css"
  )
  .extract({
    to: "vendor/common",
    test(mod) {
      const modules = [
        "axios",
        "lodash-es",
        "jquery",
        "@vue",
        "vue",
        "css-loader",
        "style-loader",
        "@babel",
        "vue3-sfc-loader",
      ];
      const name = mod.nameForCondition();

      return (
        /resources\/assets\/js\/common\//.test(name) ||
        !!modules.find(moduleName =>
          new RegExp(`/node_modules/${moduleName}/`).test(name)
        )
      );
    },
  })

  // Layui
  // .js(__dirname + "/resources/assets/js/layui/index.js", "js/layui.js")
  // .sass(__dirname + "/resources/assets/sass/layui/index.scss", "css/layui.css")
  //   .extract(["layui-src"], "vendor/layui"); // TODO layui-src extract 会影响其他js导致js不执行???

  // Bootstrap
  // .js(__dirname + "/resources/assets/js/bootstrap/index.js", "js/bootstrap.js")
  // .sass(
  //   __dirname + "/resources/assets/sass/bootstrap/index.scss",
  //   "css/bootstrap.css"
  // )
  // .extract(["datatables", "@popperjs", "bootstrap"], "vendor/bootstrap")

  // Vuetify
  // .js(__dirname + "/resources/assets/js/vuetify/index.js", "js/vuetify.js")
  // .sass(
  //   __dirname + "/resources/assets/sass/vuetify/index.scss",
  //   "css/vuetify.css"
  // )
  // .extract(["vuetify"], "vendor/vuetify")
  // .vue({ version: 3 })

  // Quasar
  .js(__dirname + "/resources/assets/js/quasar/index.js", "js/quasar.js")
  .sass(
    __dirname + "/resources/assets/sass/quasar/index.scss",
    "css/quasar.css"
  )
  .extract(["quasar"], "vendor/quasar")
  .vue({ version: 3 });
