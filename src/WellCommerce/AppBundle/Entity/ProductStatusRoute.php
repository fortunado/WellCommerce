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

namespace WellCommerce\AppBundle\Entity;

use WellCommerce\AppBundle\Entity\Route;
use WellCommerce\AppBundle\Entity\RouteInterface;

/**
 * Class ProductStatusRoute
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ProductStatusRoute extends Route implements RouteInterface
{
    /**
     * @var ProductStatusInterface
     */
    protected $identifier;

    /**
     * @return string
     */
    public function getType()
    {
        return 'product_status';
    }
}