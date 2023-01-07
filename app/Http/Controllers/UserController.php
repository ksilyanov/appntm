<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(): View
    {
        $user = Auth::user();

        return view('user.show', [
            'user' => $user,
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $user->name = $request->name;

            $res = $user->save();
            if (!$res) {
                throw new Exception('User saving error');
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }

        return response()->json([
            'success' => true,
            'name' => $user->name
        ]);
    }
}
