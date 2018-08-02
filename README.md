# phpTest
a PHP+sqlserver2012 project


第一次尝试使用PHP+sqlserver2012来完成对数据库的增、删、改、查，因为sqlserver不支持PHP直接连接，需要借助sqlserver扩展来进行，下面我将具体步骤猎取出来：
  首先PHP5.6并未提供链接sqlserver的扩展,需要到微软下载相应版本的PHP链接sqlserver的驱动扩展,php5.6对应的是
  · Version 3.2 supports PHP 5.6, 5.5, and 5.4 on Windows
  https://www.microsoft.com/en-us/download/details.aspx?id=20098
  
  放到php文件夹下/ext扩展文件夹里.并在php.ini中将扩展启用,我的是5.6 线程安全版本

php.ini中增加

extension=php_pdo_sqlsrv_56_ts.dll 

extension=php_sqlsrv_56_ts.dll 

但是由于微软提供的扩展只支持32位PHP版本的,可是我的是64位.....怎么办?

还好有国外大牛解决了这个问题,提供php64位版本的扩展,热心的小伙伴已经提供了分享http://pan.baidu.com/s/1dDIRpJF

好,这个问题解决了,phpinfo里面也有了sqlsrv的信息,但是,还是连不上,查资料后得知我的服务器程序和数据库并不在一起...并且程序服务器并没有装sqlserver
如果需要连接sqlserver还需要在程序服务器上安装一个 SQL Server 2012 Native Client (我的sqlserver数据库是 sqlserver2012)...好吧,装上之后终于连
接上了
  
