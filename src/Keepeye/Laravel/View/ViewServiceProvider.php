<?php namespace Keepeye\Laravel\View;


class ViewServiceProvider extends \Illuminate\View\ViewServiceProvider {


	/**
	 * 注册改进的FileViewFinder
	 *
	 * @return void
	 */
	public function registerViewFinder()
	{
		$this->app->bindShared('view.finder', function($app)
		{
			$paths = $app['config']['view.paths'];
			return new FileViewFinder($app['files'], $paths);
		});
	}



}
