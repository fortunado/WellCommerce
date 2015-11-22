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

namespace WellCommerce\SalesBundle\DataFixtures\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use WellCommerce\AppBundle\DataFixtures\AbstractDataFixture;
use WellCommerce\SalesBundle\Entity\PaymentMethod;

/**
 * Class LoadPaymentData
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LoadPaymentMethodData extends AbstractDataFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $shippingMethods = new ArrayCollection();
        $shippingMethods->add($this->getReference('shipping_method_fedex'));
        $shippingMethods->add($this->getReference('shipping_method_ups'));

        $cod = new PaymentMethod();
        $cod->setEnabled(1);
        $cod->setHierarchy(0);
        $cod->setProcessor('cod');
        $cod->translate('en')->setName('Cash on delivery');
        $cod->setShippingMethods($shippingMethods);
        $cod->setDefaultOrderStatus($this->getReference('default_order_status'));
        $cod->mergeNewTranslations();
        $manager->persist($cod);

        $bankTransfer = new PaymentMethod();
        $bankTransfer->setEnabled(1);
        $bankTransfer->setHierarchy(0);
        $bankTransfer->setProcessor('bank_transfer');
        $bankTransfer->translate('en')->setName('Bank transfer');
        $bankTransfer->setShippingMethods($shippingMethods);
        $bankTransfer->setDefaultOrderStatus($this->getReference('default_order_status'));
        $bankTransfer->mergeNewTranslations();
        $manager->persist($bankTransfer);

        $manager->flush();
    }
}
