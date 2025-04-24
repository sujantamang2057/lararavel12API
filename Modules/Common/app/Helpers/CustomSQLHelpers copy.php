
<?php
/**
 * Custom SQL Helper Functions
 * CustomSQLHelpers.php
 */

use Modules\Sys\app\Models\Access\User;

function getUserNameById($userId = null)
{
    return User::getSingleFieldData($userId, 'name');
}
