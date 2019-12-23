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

目前能想到的最好的解决方法就是在后面额外加多个只有宽度没有高度的 div，数量足够就可以保证最后一行按预期排列。

