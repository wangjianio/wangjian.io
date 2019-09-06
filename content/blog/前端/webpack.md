---
title: webpack alias 和 VS Code 的配合
date: 2019-07-04
---

```js
// webpack.config.js
module.exports = {
    resolve: {
        alias: {
            '@': path.join(__dirname, 'src'),
        }
    }
}
```


```json
// jsconfig.json
{
    "compilerOptions": {
        "baseUrl": ".",
        "paths": {
            "@/*": ["./src/*"]
        }
    }
}
```

webpack alias 可从 jsconfig 中取
