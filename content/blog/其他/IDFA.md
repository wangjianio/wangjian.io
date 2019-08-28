---
title: IDFA
date: 2018-08-28
---



### IDFA

advertisingIdentifier

https://developer.apple.com/documentation/adsupport/asidentifiermanager/1614151-advertisingidentifier

UUID 格式，iOS 10 及以上，如果用户限制了广告追踪，则返回 `00000000-0000-0000-0000-000000000000`

可关闭也可手动重置，在设置->隐私->广告中

### UDID

Unique Device Identifier

### IDFV

identifierForVendor

https://developer.apple.com/documentation/uikit/uidevice/1620059-identifierforvendor

Vendor 信息来自 App Store。如非 App Store 应用则为 reverse-DNS。

同设备、同 Vendor 下应用为同一 ID，删除此 Vendor 下全部应用后重置。

iOS 6：使用前两部分。

iOS 7+：使用除最后一部分。

### UUID

Universally Unique Identifier

### MAC

### ADID

Advertising ID

http://www.androiddocs.com/google/play-services/id.html

### IMEI

http://www.morlab.cn/article/2008/0724/article_1320.html