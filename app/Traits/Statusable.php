<?php
/**
 * Created by PhpStorm.
 * User: amirreza
 * Date: 6/14/19
 * Time: 5:15 PM
 */

namespace App\Traits;


trait Statusable
{
    public function isActive($object)
    {
        if ($object->status === 'active')
            return true;
        else
            return false;
    }

}