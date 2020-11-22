---
title: 一次 js 并行串行的思考
date: 2018-12-06
---


原文：一次js并行串行的思考 - [https://lxzjj.github.io/2017/10/29/一次js并行串行的思考/](https://lxzjj.github.io/2017/10/29/一次js并行串行的思考/)

几天前，组里有同事抛出一个问题：假设给定一组url，要求尽可能快得加载，然后按照顺序打印出结果，用js如何实现？

这个问题其实很简单，大家很快就给定了简单的思路：

1. 因为要求尽可能快，所以要并行加载
2. 因为要求按顺序打印结果，那么就要串行输出

按照思路，要如何优雅地实现这个效果呢？

组里大家给出的实现方式差别很大，因为我最近看的函数式编程比较多，当时马上就想到通过 promise 和 reduce 来完成。

这里将问题简化一下，请求url的异步任务换成简单地输出数字，当时给出的代码是这样：

```js
let makePromise = (value) => {
  console.log("sync", value)
  return new Promise(resolve => {
    setTimeout(() => {
      console.log("async", value)
      resolve(value)
    }, Math.random() * 1000)
  })
}
let print = (value) => {
  console.log("print", value)
  return value
}
let values = [1, 2, 3, 4]
let promises = values.map(value => makePromise(value)) // 这里就已经开始并行加载
let parallelPromises = promises.reduce(
  (current, next) => current.then(() => next.then(print)),
  Promise.resolve()
)
parallelPromises
  .then(() => console.log("done"))
  .catch(() => console.log("failed"))
```

上面的代码输出结果如下：

![输出结果](../images/result.png)

_实际输出结果受到 `Math.random` 的随机影响，但是 print 输出一定是按顺序的_

上面的代码里面，当我们调用 `map` 将数字映射成 `promise` 数组时，实际上就实现了并行加载。然后我们使用 `reduce` 以及 `promise.then` 的特性，强制要求输出必须在前一个 `promise` 完成后再执行，就实现了串行输出。