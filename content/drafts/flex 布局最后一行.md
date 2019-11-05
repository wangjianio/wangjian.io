今天看了下 flex 换行布局的最后一行对齐问题：

```html
<div class="parent">
    <div class="child"></div>
    <div class="child"></div>
    <div class="child"></div>
    <!-- .child * n -->
</div>
```

```css
.parent {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}
```

这样最后一行不满的时候是无法做到一一与上面的 div 对齐的。

