<?php

namespace App\Repositories;

use App\Vendor;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Sands\Asasi\Foundation\Repository\Exceptions\RepositoryException;

class VendorsRepository extends BaseRepository 
{
    public static function create(Model $model, $data, $params = [])
    {
        $userData = [
            'name' => $data['contact_name'],
            'email' => $data['contact_email'],
            'password' => bcrypt($data['password']),
        ];

        if ($user = User::create($userData)) {
            $model->fill($data);
            $model->fill($params);

            $model->user_id = $user->id;
            
            if (!$model->save()) {
                throw new RepositoryException('Creating ' . Model::class, $data);
            }
            if (method_exists(static::class, 'created')) {
                return forward_static_call_array([static::class, 'created'], func_get_args());
            }
            return $model;
        }

        return false;
    }
}
