---
title: 如何开发一个 node cli 工具
date: 2019-05-28
---

1. 首先要有一个文件夹。以 `~/tools/` 为例。

2. 创建一个 `package.json`。

    ```shell
    npm init -y
    ```

3. 创建 `index.js`，在开头写上 `#! /usr/bin/env node`。如下

    ```js
    #! /usr/bin/env node

    console.log(1);
    ```

4. 在 `package.json` 中添加 `bin` 字段。

    ```json
    {
        "bin": {
            "tools": "index.js"
        }
    }
    ```

5. `npm link`

6. 执行 `tools` 就可以看到输出 1 了。

如果想要删掉全局的 `tools`，用 `which tools` 找到对应文件，删掉即可。
