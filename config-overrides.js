const { injectBabelPlugin } = require('react-app-rewired');
const rewireLess = require('react-app-rewire-less');

module.exports = function override(config, env) {
  // config = injectBabelPlugin(['import', { libraryName: 'antd', style: 'css' }], config);
  // config = rewireLess(config, env);
  config = injectBabelPlugin(['import', { libraryName: 'antd', style: true }], config);
  config = rewireLess.withLoaderOptions({
    modifyVars: {
      "@font-size-base": "14px",
      "@font-size-lg": "16px",
      "@font-size-sm": "12px",
    },
  })(config, env);
  return config;
};