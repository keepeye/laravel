<?php namespace Keepeye\Laravel\View;

class FileViewFinder extends  \Illuminate\View\FileViewFinder {


    /**
     * 默认namespace
     *
     * @see FileViewFinder::setDefaultNamespace()
     * @var string
     */
    protected $defaultNamespace = '';


	/**
	 * 查找视图文件并返回绝对路径
	 *
	 * @param  string  $name
	 * @return string
	 */
	public function find($name)
	{
		if (isset($this->views[$name])) return $this->views[$name];

		if ($this->hasHintInformation($name = trim($name)))
		{
			return $this->views[$name] = $this->findNamedPathView($name);
		}

        if ($this->defaultNamespace != '') {
            $name = $this->defaultNamespace.self::HINT_PATH_DELIMITER.$name;
            return $this->views[$name] = $this->findNamedPathView($name);
        }

		return $this->views[$name] = $this->findInPaths($name, $this->paths);
	}


    /**
     * 设置默认命名空间
     * 可以使得之后所有普通视图路径加上默认的命名空间
     * 可以借此实现主题功能
     *
     * @param string $name
     */
    public function setDefaultNamespace($name,$hints="")
    {
        $this->defaultNamespace = $name;

        if ($hints != "") {
            $this->addNamespace($name,$hints);
        }
    }

    /**
     * 获取默认命名空间
     *
     * @return string
     */
    public function getDefaultNamespace()
    {
        return $this->defaultNamespace;
    }

}
