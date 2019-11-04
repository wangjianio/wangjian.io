---
title: 在 GitHub 贡献代码
date: 2019-11-04
description: 在 GitHub 贡献代码
---

假设你的 GitHub 账号为 username。

假设你对 git 的基本操作有所了解。


1. 找到你想提交代码的仓库，比如 https://github.com/facebook/react，在右上角找到 Fork 按钮，点一下，就会在你自己的账号下建立一个对应仓库的拷贝。

2. 接下来就可以把你自己账号下的仓库 clone 到本地了。

    ```shell
    git clone https://github.com/username/react.git
    ```

3. 基于主要分支（一般是 `master`）新建一个你自己的分支。

    ```shell
    git checkout -b your-branch
    ```

4. 在 `your-branch` 分支上面修改代码并提交。

5. 将 `your-branch` 分支推送到你的仓库后，你的 GitHub 页面上会有 Pull request 的提示。点击按钮根据提示就可以提交 PR 了。

6. 当源代码仓库有更新时，我们自己的仓库并不会同步更新。此时可以从原始仓库 pull 代码。

7. 首先增加 remote，理论上 `upstream` 部分是可以自由设定的，类似 `origin`，但一般此处使用 `upstream`。

    ```shell
    git remote add upstream https://github.com/facebook/react.git
    ```

8. 这个时候在 `master` 分支执行 `git pull upstream master` 就可以把原始仓库的最新提交拉取到本地了。需要再次发起 PR 时只需从最新的 master 分支上新建分支即可。

其他需要注意的事项：

1. 最好是每次从 master 分支新建分支提交代码，直接把代码提交到 master 分支会导致 pull 代码时有冲突，之后再发 PR 时会多出无用的 commit。


参考：

https://help.github.com/en/github/collaborating-with-issues-and-pull-requests/configuring-a-remote-for-a-fork