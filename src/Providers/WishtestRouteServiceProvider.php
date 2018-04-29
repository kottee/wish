<?php
namespace Wishtest\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

/**
 * Class HelloWorldRouteServiceProvider
 * @package HelloWorld\Providers
 */
class WishtestRouteServiceProvider extends RouteServiceProvider
{
	/**
	 * @param Router $router
	 */
	public function map(Router $router)
	{
		$router->get('hello', 'Wishtest\Controllers\ContentController@sayHello');
		$router->get('test', 'Wishtest\Controllers\ContentController@sayHello');
	}

}
