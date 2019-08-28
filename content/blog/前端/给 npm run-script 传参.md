---
title: 给 npm run-script 传参
date: 2018-12-06
---

参考：https://github.com/npm/npm/pull/5518#issuecomment-312459196

```json
{
  "print": "f(){ echo Hello $1! && echo Bye $2! ;};f",
  "test": "npm run print -- world stranger"
}
```

```bash
$ npm test -s # -s is to suppress npm messages for this example
Hello world!
Bye stranger!
```