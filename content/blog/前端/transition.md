---
title: transition - CSS
date: 2019-05-25
---

**以下相关说明忽略 inherit, initial, unset 等值。**

# transition

transition 一共有 5 个。

- `transition`
- `transition-delay`
- `transition-duration`
- `transition-property`
- `transition-timing-function`

## `transition`

其中 `transition` 是其他四个属性的简写。中间用空格分隔。

四个属性的顺序没有要求。第一个时间表示 `duration`，第二个时间表示 `delay`，`property` 和 `timing-function` 分别取另外两个值。

如下等等的写法都是合法的：

```css
{
    transition: width 1s ease 2000ms;
    transition: width 1s ease;
    transition: 1s 2s ease width;
    transition: 1s;
    transition: width;
    transition: width ease;

    /* 虽然没什么用，但是合法 */
    transition: abc ease 1s 1s;
    transition: abc 1s 1s;     
}
```

但如果写了 4 个值以上，或者其中两个字符串都是无效的 `timing-function`，那么整个 `transition` 属性都会失效。

```css
{
    /* 以下写法均不合法 */
    transition: width ease 1s 2s 1s;
    transition: abc def 1s 2s;
}
```

一般情况下按照 `property` `duration` `timing-function` `delay` 的顺序写比较好。

如有多条过渡效果，用 `,` 分隔，需要注意如果其中任何一部分语法有误，那么整条 `transition` 都将失效。多余的 `,` 也不可以出现。

```css
{
    /* 多条写法 */
    transition: width ease 1s, height ease 2s;

    /* 语法有误，width 相关的效果也将失效 */
    transition: width ease 1s, height 2s 1s 1s;
}
```

## `transition-property`

有 `none` 和 `all` 两个关键词。

## `transition-duration`

`duration` 表示整个过渡效果持续的时间。

合法值只有两种：`0s` 和 `2.5ms`，可以是小数，必须有单位，即使是 0。

`duration` 要求时间为非负数。

## `transition-delay`

`delay` 表示过渡开始前的延时。

合法值同 `duration`，但允许为负值。

`transition: width 3s 1s` 过渡会在 1s 后开始，然后 3s 动画，共 4s。

`transition: width 3s -1s` 过渡会立即从 1s 处开始，2s 后结束。

## `transition-timing-function`