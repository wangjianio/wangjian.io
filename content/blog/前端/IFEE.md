---
title: IFEE
date: 2018-03-12
---


# IFEE（立即调用函数表达式）

https://developer.mozilla.org/en-US/docs/Glossary/IIFE

http://benalman.com/news/2010/11/immediately-invoked-function-expression/#iife

https://segmentfault.com/a/1190000003985390

Immediately Invoked Function Expression

我的理解：

通常调用函数的方法：

```javascript
// 使用函数表达式定义一个函数
const name = function() {
  console.log(1);
}

// 调用函数
name() // 1
```

IFEE 就是将定义函数与调用函数合并了：

通过上面的代码我们知道，`name` 的值为：

```javascript
function() {
  console.log(1);
}
```

调用函数 `name()` 就是：

```javascript
function() {
  console.log(1);
}()
```

但是这样语法有误啊，因为 function 关键词是声明函数的，关键词后面要有名字，所以这么写就直接报错了。

怎么解决呢？最常见的是加括号的方法：

```javascript
(function() {
  console.log(1);
})()
```

> 因为在Javascript里，圆括号不能**包含**声明。因为这点，当圆括号为了包裹函数碰上了 `function`关键词，它便知道将它作为一个函数表达式去解析而不是函数声明。

这样就声明一个匿名函数，然后第二对括号就像通常调用函数一样，调用了前面的函数。

这个匿名函数有独立的词法作用域，内部的变量不会污染外部环境。

## 变量访问与传入参数

通常调用函数时，函数内的语句可以访问函数外的变量，还可以传入参数：

```javascript
var num = 0;

function name(param) {
  console.log(num, param);
}

name(true); // 0 true
```

IFEE 也一样：

```javascript
// 访问外部变量
var num = 0;

(function () {
  console.log(num); // 0
})()
```

```javascript
// 传入参数
var bool = true;

(function (param) {
  console.log(param); // true
})(bool)
```

```javascript
// 混合
var num = 0;
var bool = true;

(function (param) {
  console.log(num, param); // 0 true
})(bool)
```

## 返回值

依然与通常的函数调用相同。

```javascript
// 通常
var name = function () {
  return 1;
}

var result = name();

console.log(result); // 1
```

```javascript
// IFEE
var result = (function () {
  return 1;
})();

console.log(result); // 1
```

```javascript
// 甚至可以少写一对括号，因为表达式内同样不可以有声明。
// 但是不要这么写！因为最后的两个括号非常容易被忽略。
var result = function () {
  return 1;
}();

console.log(result); // 1
```

## 写法汇总

```javascript
// 最常见的写法，返回 IFEE 执行的结果
(function(){/* code */})();

// 有返回结果的写法
var i = (function(){/* code */}());
var i = function(){/* code */}();
var i = true && function(){/* code */}();

// 如果不关心返回结果
0,function(){/* code */}();
!function(){/* code */}();
~function(){/* code */}();
-function(){/* code */}();
+function(){/* code */}();

// 不确定对性能的影响，虽然简洁，暂未研究
// 使用 Function 构造函数
new function(){/* code */}
// 如果需要传入参数
new function(){/* code */}()
// 不使用 new 
Function()();
```

