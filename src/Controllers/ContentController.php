<?php
namespace Wish\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use Plenty\Plugin\Log\Loggable;
use Plenty\Modules\Item\DataLayer\Contracts\ItemDataLayerRepositoryContract;

/**
 * Class ContentController
 * @package HelloWorld\Controllers
 */
class ContentController extends Controller
{
	use Loggable;
	/**
	 * @param Twig $twig
	 * @return string
	 */
	public function sayHelloT(Twig $twig):string
	{
		return $twig->render('Wish::content.hello');
	}
	
	public function sayHello(Twig $twig, ItemDataLayerRepositoryContract $itemRepository):string
    	{
		$itemColumns = [
			'itemDescription' => [				
				'name1',
				'description',
				'shortDescription',
				'technicalData',
				'keywords',
				'lang'				
			],
			'itemBase' => [				
				'id',
				'createDate',
				'lastUpdateTimestamp',
				'type',
				'variationCount',
				'producerId'				
			],
			'variationBase' => [
				'id',
				'limitOrderByStockSelect',
				'weightG',
				'lengthMm',
				'widthMm',
				'heightMm',
				'attributeValueSetId',
			],
			'variationRetailPrice' => [
				'price',
				'currency'
			],
			'variationImageList' => [
				'imageId',
				'type',
				'fileType',
				'path',
				'position',
				'attributeValueId',
				'cleanImageName'
			]
		];

		$itemFilter = [
		    'itemBase.isStoreSpecial' => [
			'shopAction' => [3]
		    ]
		];

		$itemParams = [
		    'language' => 'en'
		];

		$resultItems = $itemRepository
		    ->search($itemColumns, $itemFilter, $itemParams);

		$items = array();
		foreach ($resultItems as $item)
		{
		    $items[] = $item;
		}
		$templateData = array(
		    'resultCount' => $resultItems->count(),
		    'currentItems' => $items
		);
		$this->getLogger(__METHOD__)->error('Wish::itemRepository', $resultItems);
		return $twig->render('Wish::content.TopItems', $templateData);
    	}
}
