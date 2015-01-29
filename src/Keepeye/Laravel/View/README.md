###视图组件

扩展 `\Illuminate\View\ViewServiceProvider` 以及 `\Illuminate\View\FileViewFinder`，可实现模板主题功能。


###安装方法
在配置文件 `app/config/app.php` 里，找到 `providers` 数组，将

    'Illuminate\View\ViewServiceProvider',

改为：

    'Keepeye\Laravel\View\ViewServiceProvider',

###使用教程

View原有的方法不受影响，增加了setDefaultNamespace以及getDefaultNamespace方法。

通过 `View::getFinder()->setDefaultNamespace($theme,$path)` 可为所有视图路径默认添加一个命名空间，指定其目录路径，举例说明：

    function __construct()
    {
        View::getFinder()->setDefaultNamespace('default',app_path().'/views/default');
    }

那么当在该控制器方法中渲染视图时：

    function index()
    {
        return View::make('index.index');
    }

实际上等同于

    function index()
    {
        return View::make('default.index.index');
    }

也等同于

    function index()
    {
        View::addNamespace('default',app_path().'/views/default');
        return View::make('default::index.index');
    }

如果想设置一个已经注册的namespace为默认，那么第二个参数可以省略，如：

    function __construct()
    {
        View::getFinder()->setDefaultNamespace('default');//default已经在之前通过 addNamespace注册过了。
    }

设置了defaultNamespace，不光是控制器里的View::make受影响，在blade模板中的`@extends()`同样有效，这样我们可以实现`模板主题`功能,只要把`default`动态化即可。


觉得赞的话欢迎star、fork、pull request etc. :)