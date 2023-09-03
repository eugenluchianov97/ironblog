<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Post\IndexResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $usersCount = User::all()->count();
            $postsCount = Post::all()->count();
            $categoriesCount = Category::all()->count();
            $tagsCount = Tag::all()->count();
            return response()->json([
                'status' => true,
                'message' => 'Get Successfully',
                "posts" => $postsCount,
                "users" => $usersCount,
                "tags" => $tagsCount,
                "categories" => $categoriesCount,
            ], 200);
        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
