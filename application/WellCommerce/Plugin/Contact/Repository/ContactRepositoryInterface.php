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

namespace WellCommerce\Plugin\Contact\Repository;

/**
 * Interface ContactRepositoryInterface
 *
 * @package WellCommerce\Plugin\Contact\Repository
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface ContactRepositoryInterface
{
    const PRE_DELETE_EVENT  = 'contact.repository.pre_delete';
    const POST_DELETE_EVENT = 'contact.repository.post_delete';
    const PRE_SAVE_EVENT    = 'contact.repository.pre_save';
    const POST_SAVE_EVENT   = 'contact.repository.post_save';

    /**
     * Returns all contacts as a collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Returns a contact model
     *
     * @param $id
     *
     * @return \WellCommerce\Plugin\Contact\Model\Contact
     */
    public function find($id);

    /**
     * Adds or updates a contact
     *
     * @param array $data
     * @param null  $id
     *
     * @return mixed
     */
    public function save(array $data, $id = null);

    /**
     * Deletes a contact
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id);

    /**
     * Returns Collection as ke-value pairs ready to use in selects
     *
     * @return mixed
     */
    public function getAllContactToSelect();
}