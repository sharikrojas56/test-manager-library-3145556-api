<?php

namespace App\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // Mock response for now - would use BookRepository
        return response()->json([
            'items' => [
                [
                    'id' => '11111111-1111-1111-1111-111111111111',
                    'title' => 'One Hundred Years of Solitude',
                    'author' => 'Gabriel García Márquez',
                    'isbn' => '9780307474728',
                    'category' => ['id' => '11111111-1111-4111-8111-111111111111', 'name' => 'Novel'],
                    'total_copies' => 4,
                    'available_copies' => 3,
                    'cover_key' => null,
                ]
            ],
            'page' => 1,
            'size' => 20,
            'total' => 1,
        ], 200);
    }

    public function show(string $id): JsonResponse
    {
        // Mock response
        return response()->json([
            'id' => $id,
            'title' => 'One Hundred Years of Solitude',
            'author' => 'Gabriel García Márquez',
            'isbn' => '9780307474728',
            'category' => ['id' => '11111111-1111-4111-8111-111111111111', 'name' => 'Novel'],
            'total_copies' => 4,
            'available_copies' => 3,
            'cover_key' => null,
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:250',
            'author' => 'required|string|max:200',
            'isbn' => 'required|string|size:13',
            'category_id' => 'required|uuid',
            'total_copies' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 'VALIDATION_ERROR',
                'message' => 'Validation failed',
                'details' => $validator->errors()->toArray(),
            ], 422);
        }

        // Mock created book
        return response()->json([
            'id' => '22222222-2222-2222-2222-222222222222',
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'isbn' => $request->input('isbn'),
            'category' => ['id' => $request->input('category_id'), 'name' => 'Novel'],
            'total_copies' => $request->input('total_copies'),
            'available_copies' => $request->input('total_copies'),
            'cover_key' => null,
        ], 201);
    }
}