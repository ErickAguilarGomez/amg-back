<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;


class ClientRepository
{
    public function getAll()
    {
        return DB::select('CALL get_clients_data()');
    }

    public function findById($id)
    {
        return DB::select('CALL get_user_byid(?)',[$id]);
    }

    public function deleteById($id)
    {
        return DB::select('CALL delete_client(?)',[$id]);
    }

    public function updateUser($request)
    {   
        $data=[
            $request->id,
            $request->name,
            $request->email,
            $request->phone,
        ];

         $result=DB::select('CALL update_user(?,?,?,?)',$data);
         return $result;
    }

    public function createUser($name, $email,$phone)
    {
        return DB::select('CALL create_client(?,?,?)',[$name, $email,$phone]);
    }

};

