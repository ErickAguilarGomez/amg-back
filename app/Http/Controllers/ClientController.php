<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientService; 

class ClientController extends Controller
{
    protected $clientService;
    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function getAllClients()
    {
        return $this->clientService->getAllClients(); 
    }

    public function getDataByID($id)
    {
        return $this->clientService->getClientByID($id);
    }

    public function deleteDataByID($id)
    {   
        
        return $this->clientService->deleteClient($id);
    }

    public function updateByData(Request $request)
    {    
        $id = $request->id;
        $name = $request->name; 
        $email = $request->email;
        $phone = $request->phone;
        return $this->clientService->updateClient($request);
    }

    public function createByData(Request $request)
    {    
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        return $this->clientService->createClient($name,$email,$phone);
    }
}
