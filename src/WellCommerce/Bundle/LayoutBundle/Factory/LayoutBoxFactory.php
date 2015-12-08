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

namespace WellCommerce\Bundle\LayoutBundle\Factory;

use WellCommerce\Bundle\CoreBundle\Factory\AbstractFactory;
use WellCommerce\Bundle\LayoutBundle\Entity\LayoutBox;

/**
 * Class LayoutBoxFactory
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LayoutBoxFactory extends AbstractFactory
{
    /**
     * @return \WellCommerce\Bundle\LayoutBundle\Entity\LayoutBoxInterface
     */
    public function create()
    {
        $box = new LayoutBox();
        $box->setIdentifier('');

        return $box;
    }
}