<?php 
namespace App\Traits;

Trait HttpResponses{

protected function succes($data , $message = null,$code = 200)
{
   return response()->json([
    'statut'    => 'Bien Appliqué',
    'message'   => $message,
    'data'      => $data
   ],$code);
}

protected function error($data , $message = null,$code)
{
   return response()->json([
    'statut'    => 'Email ou mot de passe incorecte',
    'message'   => $message,
    'data'      => $data
   ],$code);
}




}