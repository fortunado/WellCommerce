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

namespace WellCommerce\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use WellCommerce\AdminBundle\Entity\UserGroupInterface;
use WellCommerce\AdminBundle\Entity\UserGroupPermission;
use WellCommerce\AppBundle\DataFixtures\AbstractDataFixture;

/**
 * Class LoadUserData
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LoadUserData extends AbstractDataFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $role = $this->container->get('role.factory')->create();
        $role->setName('admin');
        $role->setRole('ROLE_ADMIN');
        $manager->persist($role);

        $group = $this->container->get('user_group.factory')->create();
        $group->setName('Administration');
        $group->setPermissions($this->getPermissions($group));
        $manager->persist($group);

        $user = $this->container->get('user.factory')->create();
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setUsername('admin');
        $user->setEmail('admin@domain.org');
        $user->setEnabled(1);
        $password = password_hash('admin', PASSWORD_BCRYPT, ['cost' => 12]);
        $user->setPassword($password);
        $user->addRole($role);
        $user->getGroups()->add($group);
        $manager->persist($user);

        $manager->flush();
    }

    protected function getPermissions(UserGroupInterface $group)
    {
        $collection = new ArrayCollection();
        foreach ($this->container->get('router')->getRouteCollection()->all() as $name => $route) {
            if ($route->hasOption('require_admin_permission')) {
                $permission = new UserGroupPermission();
                $permission->setEnabled(true);
                $permission->setName($route->getOption('require_admin_permission'));
                $permission->setGroup($group);
                $collection->add($permission);
            }
        }

        return $collection;
    }
}
