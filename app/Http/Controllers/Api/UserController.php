<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function register(Request $request ){
    
$validated=$request->validate(['name'=>'required|string|max:225',
'email'=>'required|email|unique:users',
'password'=>'required']);
$user=User::create(['name'=>$validated['name'],
'email'=>$validated['email'],
'password'=>$validated['password']]);
$token=$user->createToken($validated['name']);
return response()->json([
    'message' => "Utilisateur enregistré avec succès",
    'data' => $user,
    'token' => $token->plainTextToken
]);


   } 
   public function login(Request $request ){
      $validated=$request->validate([
'email'=>'required|email|exists:users',
'password'=>'required']);

$user=User::where('email',$request->email)->first();
if (!$user || !Hash::check($request->password, $user->password)) {
   return response()->json([
       'message' => 'Identifiants invalides'
   ]);
};
$token=$user->createToken($user['name']);
return response()->json([
    'message' => "Utilisateur connecté avec succès",
    'data' => $user,
    'token' => $token->plainTextToken
]);




   }
   public function logout(Request $request ){

      $request->user()->tokens()->delete();
      return "you are logout";
   }




}
