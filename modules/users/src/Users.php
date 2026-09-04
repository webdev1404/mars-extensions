<?php
/**
* The Users Class
* @package Mars
*/

namespace Modules\Users;

use Mars\Items;

/**
 * The Users Class
 * Encapsulates methods for working with users
 */
class Users extends Items
{
    /**
     * @internal
     */
    protected static string $table = 'users';

    /**
     * @internal
     */
    protected static string $id_field = 'id';

    /**
     * @internal
     */
    protected static string $class = User::class;

    /**
     * Loads a list of users based on the provided parameters
     * @param string $filter The filter to apply to the list of users
     * @param string|null $order_by The field to order the list by
     * @param string|null $order The order direction (ASC or DESC)
     * @param int $page The page number for pagination
     * @param int $per_page The number of users to display per page
     * @return static
     */
    public function loadList(string $filter = '', string $order_by = '', string $order = '', int $page = 0, int $per_page = 30) : static
    {
        $sql = $this->db->getSql()->select($this->fields)->from($this->getTable());
        if ($filter) {
            $sql->where(['username' => ['operator' => 'like', 'value' => $filter]]);
            $sql->orWhere(['email' => ['operator' => 'like', 'value' => $filter]]);
        }
        if ($order_by) {
            $sql->orderBy($order_by, $order);
        }
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $sql->limit($per_page, $offset);
        }

        return $this->loadBySql($sql);
    }

    /**
     * Loads a user by their username
     * @param array $usernames The usernames to search for
     * @return static
     */
    public function loadUsernames(array $usernames) : static
    {
        $sql = $this->db->getSql()->select($this->fields)->from($this->getTable());
        $sql->where(['username' => $usernames]);

        return $this->loadBySql($sql);
    }
}
