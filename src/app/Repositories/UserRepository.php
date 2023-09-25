<?php 
namespace App\Repositories;

use App\Contracts\UserContract;

class UserRepository extends BaseRepository implements UserContract
{
    public function assignedToUser(int $category_id)
    {
        $user = $this->model->where('category_id',$category_id)->pluck('id')->toArray();
        shuffle($user);
        
        return $user[rand(0,(count($user)-1))];
    }
}