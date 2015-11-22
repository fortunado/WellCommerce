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

namespace WellCommerce\CmsBundle\Entity;

use Knp\DoctrineBehaviors\Model\Translatable\Translation;
use WellCommerce\CommonBundle\Entity\Behaviours\RoutableTrait;
use WellCommerce\CommonBundle\Entity\RoutableSubjectInterface;
use WellCommerce\CommonBundle\Entity\LocaleAwareInterface;
use WellCommerce\AppBundle\Entity\Meta;

/**
 * Class PageTranslation
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class PageTranslation implements RoutableSubjectInterface, LocaleAwareInterface
{
    use Translation;
    use RoutableTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var PageRoute
     */
    protected $route;

    /**
     * @var Meta
     */
    protected $meta;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meta = new Meta();
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Meta
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param Meta $meta
     */
    public function setMeta(Meta $meta)
    {
        $this->meta = $meta;
    }

    /**
     * @return PageRoute|\WellCommerce\CommonBundle\Entity\RouteInterface
     */
    public function getRouteEntity()
    {
        return new PageRoute();
    }
}
