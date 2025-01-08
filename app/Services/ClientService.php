<?php
namespace App\Services;

use App\Repositories\ClientRepository;
use Exception;
use Log;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getAllClients(){
        try {
            $clients = $this->clientRepository->getAll();

            if (empty($clients)) { 
                return response()->json(['message' => "No hay clientes"], 404);
            }

            foreach ($clients as $client) {
                    $client->transtactions = json_decode($client->transtactions);
            }
            return response()->json(['data' => $clients], 200);

        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    public function getClientByID($id)
    {
        try {
            $client = $this->clientRepository->findById($id);

            if (empty($client)) {
                return response()->json(['message' => "No existe cliente"], 404);
            }

            return response()->json(['data' => $client], 200); 

        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    public function deleteClient($id)
    {
        try {
            $client = $this->clientRepository->findById($id);
            if (empty($client)) {
                return response()->json(['message' => "No existe cliente"], 404);
            }
            $client = $this->clientRepository->deleteById($id);
            return response()->json(['response' => "eliminado de manera exitosa"], 200);

        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    public function updateClient($request)
    {
        try {
            $client = $this->clientRepository->updateUser($request);
            return response()->json(['response' => "Usuario  Actualizado de manera exitosa"], 200);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    public function createClient($name, $email,$phone)
    {
        try {
            if (!isset($name) || empty($name) || empty($email)  || empty($phone)) {
                return response()->json(['message' => "Todos los datos deben estar Existentes"], 404);
            }
            $client = $this->clientRepository->createUser($name, $email,$phone);
            return response()->json(['response' => "Usuario  $name Creado de manera exitosa"], 200);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

}
