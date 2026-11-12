<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiSettingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $settings = $request->user()->settings()->firstOrCreate(['user_id' => $request->user()->id]);

        return response()->json(['data' => $settings]);
    }

    public function update(SettingsRequest $request): JsonResponse
    {
        $settings = $request->user()->settings()->firstOrCreate(['user_id' => $request->user()->id]);
        $settings->update($request->validated());

        return response()->json(['message' => 'Settings updated', 'data' => $settings]);
    }
}
