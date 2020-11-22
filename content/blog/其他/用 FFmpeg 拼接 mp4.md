---
title: 用 FFmpeg 拼接 mp4
date: 2018-08-05
---


首先在一个文件内写入文件列表，

如：filelist

```
file '1.mp4'
file '2.mp4'
file '3.mp4'
```

然后执行

```bash
ffmpeg -f concat -i filelist -c copy output.mp4
```



参考资料：

https://blog.csdn.net/doublefi123/article/details/47276739