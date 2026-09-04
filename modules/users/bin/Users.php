<?php

namespace Modules\Users\Bin;

use Mars\Bin\Base;
use Modules\Users\User;
use Modules\Users\Users as UsersList;

class Users extends Base
{
    public protected(set) string $title = 'Users';

    public protected(set) string $root = 'users';

    public protected(set) array $commands = [
        'list'           => 'list',
        'create'         => 'create',
        'enable'         => 'enable',
        'disable'        => 'disable',
        'activate'       => 'activate',
        'deactivate'     => 'deactivate',
        'update'         => 'update',
        'delete'         => 'delete',
        'delete:expired-tokens' => 'deleteExpiredTokens'
    ];
    
    public protected(set) array $command_descriptions = [
        'list'           => 'Lists all users',
        'create'         => 'Creates a new user',
        'enable'         => 'Enables a user',
        'disable'        => 'Disables a user',
        'activate'       => 'Activates a user',
        'deactivate'     => 'Deactivates a user',
        'update'         => 'Updates an existing user',
        'delete'         => 'Deletes a user',
        'delete:expired-tokens' => 'Deletes all expired login tokens. Should be run periodically to clean up the database.'
    ];

    public protected(set) array $command_help = [
        'list'   => 'Usage: list [--filter=<filter>] [--orderby=<orderby>] [--order=<order>]  [<page>] [<per_page>]',
        'create' => 'Usage: create',
        'enable' => 'Usage: enable [--id] [<user> <user> ...]',
        'disable' => 'Usage: disable [--id] [<user> <user> ...]',
        'activate' => 'Usage: activate [--id] [<user> <user> ...]',
        'deactivate' => 'Usage: deactivate [--id] [<user> <user> ...]',
        'update' => 'Usage: update [--id] [<user> <user> ...]',
        'delete' => 'Usage: delete [--id] [<user> <user> ...]',
        'delete:expired-tokens' => 'Usage: delete:expired-tokens'
    ];

    /**
     * @internal
     */
    protected static array $validation_error_strings = [
        'username' => ['req' => 'users:register.err.username', 'username' => 'users:register.err.username.invalid'],
        'email' => ['req' => 'users:register.err.email', 'email' => 'users:register.err.email.invalid'],
        'password_clean' => ['req' => 'users:register.err.password', 'password' => 'users:register.err.password.invalid'],
        'agreement' => ['req' => 'users:register.err.agreement'],
    ];

    /**
     * Lists all users
     */
    public function list()
    {
        $page = $this->app->cli->getParam(1, 0, 'int');
        $per_page = $this->app->cli->getParam(2, 30, 'int');

        $options = $this->app->cli->get([
            'filter' => 'string',
            'orderby' => ['id', 'username', 'email', 'status', 'activated'],
            'order' => ['asc', 'desc'],
        ]);

        $users = new UsersList;
        $users->loadList($options['filter'], (string)$options['orderby'], (string)$options['order'], $page, $per_page);
        if (!count($users)) {
            $this->print('No users found.');
            return;
        }

        $data = $users->getArray(['id', 'username', 'email', 'status', 'activated'], false);

        //format the data for display
        $data = array_map(function ($row) {
            $row[3] = $row[3] ? 'Enabled' : 'Disabled';
            $row[4] = $row[4] ? 'Yes' : 'No';

            return $row;
        }, $data);
        
        $this->printTable(['ID', 'Username', 'Email', 'Status', 'Activated'], $data);

        if ($page) {
            $this->print("Page: {$page} | Per Page: {$per_page}");
        }
    }

    /**
     * Creates a new user
     */
    public function create()
    {
        $user = new User;
        $user->setValidationErrorStrings(self::$validation_error_strings);
        $user->activated = 1;
        $user->username = $this->app->cli->ask('Enter username: ');
        $user->email = $this->app->cli->ask('Enter email: ');
        $user->password_clean = $this->app->cli->ask('Enter password: ', password: true);

        if ($user->save()) {
            $this->done('User created successfully.');
        } else {
            $this->errors($user->errors);
        }
    }

    /**
     * Enables a user or multiple users
     */
    public function enable()
    {
        $this->setStatus(1);

        $this->done('The user(s) have been enabled successfully.');
    }

    /**
     * Disables a user or multiple users
     */
    public function disable()
    {
        $this->setStatus(0);

        $this->done('The user(s) have been disabled successfully.');
    }

    /**
     * Sets the status of a user or multiple users
     * @param int $status The status to set (1 for enabled, 0 for disabled)
     */
    protected function setStatus(int $status)
    {
        $users = $this->getUsers();
        foreach ($users as $user) {
            $this->print("Updating user '{$user->username}'...");

            $user->status = $status;

            if (!$user->save()) {
                $this->errors($user->errors);
            }
        }
    }

    /**
     * Activates a user or multiple users
     */
    public function activate()
    {
        $this->setActivation(1);

        $this->done('The user(s) have been activated successfully.');
    }

    /**
     * Deactivates a user or multiple users
     */
    public function deactivate()
    {
        $this->setActivation(0);

        $this->done('The user(s) have been deactivated successfully.');
    }

    /**
     * Sets the activation status of a user or multiple users
     * @param int $activated The activation status to set (1 for activated, 0 for deactivated)
     */
    protected function setActivation(int $activated)
    {
        $users = $this->getUsers();
        foreach ($users as $user) {
            $this->print("Updating user '{$user->username}'...");

            $user->activated = $activated;

            if (!$user->save()) {
                $this->errors($user->errors);
            }
        }
    }

    /**
     * Returns a users list based on the provided parameters. Throws an exception if any user is not found.
     * @return UsersList The users list
     * @throws \Exception If any user is not found
     */
    protected function getUsers() : UsersList
    {
        $users_list = $this->app->cli->getParams();
        if (!$users_list) {
            throw new \Exception("User ID or username not specified.");
        }

        $use_ids = $this->app->cli->has('id');

        $users = new UsersList;

        if ($use_ids) {
            $users->loadIds($users_list);
        } else {
            $users->loadUsernames($users_list);
        }

        if (count($users) != count($users_list)) {
            $key = $use_ids ? 'id' : 'username';

            $users_array = array_column($users->get(), $key);
            foreach ($users_list as $user) {
                if (!in_array($user, $users_array)) {
                    $error = $use_ids ? "User with ID '$user' not found." : "User with username '$user' not found.";
                    throw new \Exception($error);
                }
            }
        }

        return $users;
    }

    /**
     * Updates a user or multiple users
     */
    public function update()
    {
        $users = $this->getUsers();
        foreach ($users as $user) {
            $this->print("Updating user '{$user->username}'...");


            $username = $this->app->cli->ask('Enter new username (leave blank to keep current): ');
            $email = $this->app->cli->ask('Enter new email (leave blank to keep current): ');
            $password = $this->app->cli->ask('Enter new password (leave blank to keep current): ', password: true);

            if ($username) {
                $user->username = $username;
            }
            if ($email) {
                $user->email = $email;
            }
            if ($password) {
                $user->password_clean = $password;
            }

            $user->setValidationErrorStrings(self::$validation_error_strings);

            if (!$user->save()) {
                $this->errors($user->errors);
            }
        }

        $this->done('The user(s) have been updated successfully.');
    }

    /**
     * Deletes a user or multiple users
     */
    public function delete()
    {
        if ($this->askImportant("Are you sure you want to delete the selected user(s)?\nThis action cannot be undone. (yes/no)") !== 'yes') {
            return;
        }

        $this->printLn();

        $users = $this->getUsers();
        foreach ($users as $user) {
            $this->print("Deleting user '{$user->username}'...");

            if (!$user->delete()) {
                $this->errors($user->errors);
            }
        }

        $this->done('The user(s) have been deleted successfully.');
    }

    /**
     * Deletes all expired tokens
     */
    public function deleteExpiredTokens()
    {
        $this->app->db->query("DELETE FROM `users_activation_tokens` WHERE `expires_at` < UNIX_TIMESTAMP()");
        $this->app->db->query("DELETE FROM `users_login_tokens` WHERE `expires_at` < UNIX_TIMESTAMP()");
        $this->app->db->query("DELETE FROM `users_password_reset_tokens` WHERE `expires_at` < UNIX_TIMESTAMP()");
        $this->app->db->query("DELETE FROM `users_email_update_tokens` WHERE `expires_at` < UNIX_TIMESTAMP()");

        $this->done('Expired tokens deleted successfully.');
    }
}
