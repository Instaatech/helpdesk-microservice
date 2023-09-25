<?php 
namespace App\Contracts;


interface UserContract extends BaseContract
{
    public function assignedToUser(int $category_id);
}