<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\CatalogBundle\Controller\Box;

use WellCommerce\AppBundle\Controller\Box\AbstractBoxController;
use WellCommerce\AppBundle\Controller\Box\BoxControllerInterface;
use WellCommerce\LayoutBundle\Collection\LayoutBoxSettingsCollection;

/**
 * Class ProductShowcaseBoxController
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ProductShowcaseBoxController extends AbstractBoxController implements BoxControllerInterface
{
    /**
     * @var \WellCommerce\CatalogBundle\Manager\Front\ProductStatusManager
     */
    protected $manager;
    
    /**
     * {@inheritdoc}
     */
    public function indexAction(LayoutBoxSettingsCollection $boxSettings)
    {
        $categories = $this->get('category.dataset.front')->getResult('array', [
            'limit'     => 5,
            'order_by'  => 'name',
            'order_dir' => 'asc'
        ]);

        foreach ($categories['rows'] as &$category) {
            $category['dataset'] = $this->manager->getShowcaseCategoryProducts($category['id'], $boxSettings->getParam('status'));
        }

        return $this->displayTemplate('index', [
            'showcase' => $categories,
        ]);
    }
}
