# WP-BeeBiu
始于18年9月22日，一个基于wordpress（以主题形式）的图片漫画or视频整理网站，类似漫画站，整个开发周期大约持续1个多月，纯属心血来潮，因双11发货太忙而完全搁置，后续有打算继续，但有一个始料未及的坑，当我尝试测试视频站的时候发现一个异常严重的问题，chrome浏览器无法通过简单手段调用外部播放器来播放，那么播放mkv等视频就无法外挂字幕，而且纯靠网页解码是不现实的，就是因为这个问题让我一度失去继续开发下去的动力，最后（似乎只能转码）这就违背了初衷。

一晃又是半年，想着那天可能nas又挂了，干脆先放出来，虽说还是原型状态，漫画这块基本完善，因涉及好几个语言，加上开发前我只是有一点点html+css基础，php+js等这些完全是边学边用，代码大多数基于c++思维可能有些怪怪的。

开发环境，且只考虑chrome兼容，不保证低版本兼容
chrome V70
php 7
mysql 8.0
wordpress 4.9
windows server


安装使用方法
1、将文件夹丢进wordpress主题目录wordpress\wp-content\themes
2、other/beebiu_json.php 该文件为快速生成信息，可手动输入
  手动输入格式为: 
  （有两种方式，一种静态数据[直接生成静态数据]，一种动态读取[根据物理路径枚举文件夹下所有文件然后显示，需要权限]，一般建议静态）
  
  
{
“server_folder”:”服务器端图像文件夹名称 子路径”,
“server_path”:”服务器端图像文件物理路径 根路径”,
“web_spath”:”图片网站地址子目录”,
“web_rpath”:”图片网站地址根目录”, 
“web_img”:”首页主图”
}

动态只需添加目录即可 C:/Users/Administrator/Desktop/imgs/
静态可用 beebiu_json.php 快速生成

  动态实例
 {
“server_folder”:”imgs”,
“server_path”:”C:/Users/Administrator/Desktop/”,
“web_spath”:”img/”,
“web_rpath”:”http://192.168.1.1/”,
“web_img”:”001.jpg”
}
  静态实例
 {
“server_folder”:”imgs”,
“server_path”:”C:/Users/Administrator/Desktop/”,
“web_spath”:”img/”,
“web_rpath”:”http://192.168.1.1/”,
“web_img”:”001f.jpg”,
“web_list”:[“001f.jpg”,”002f.jpg”,”003f.jpg”,”004f.jpg”,”005f.jpg”,”006f.jpg”,”007f.jpg”,”008f.jpg”,”009f.jpg”,”010f.jpg”,”011f.jpg”,”012f.jpg”,”013f.jpg”,”014f.jpg”,”015f.jpg”,”016f.jpg”]
}


3、wordpress后台添加文章，填入其中之一的数据即可，没错就那么简单

4、测试使用

最后，因为没有linux开发经验，而且自己的nas也是windows系统，开发目的主要是不在破坏文件目录结构的情况下可以将漫画，照片，还有视频快速归类，且可以远程访问，这是最终目的，由于开发过程受阻，不确定后续是否会继续
