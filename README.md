# zhi
##ONLY USE IN vritualBox(vagrant)
if sth wrong maybe caused by proxy setting:
```$xslt
git config http.proxy http://user:pwd@proxy:port
git config -l
```

remember https pwd:
```$xslt
git config credential.helper store
```

####INSTALLTION
```
1.composer install
2.npm install
3.git clont https://github.com/JellyBool/simple-ueditor.git 替换 public/vendor/ueditor 文件夹 在 config/ueditor.php 配置 disk 为 'public' 情况下，上传路径在：public/uploads/ 下，确认该目录存在并可写
4.5.4+ 请不要忘记 php artisan storage:link

```

####Tips

#####1.
```vue
E-20:
const that = this
```

