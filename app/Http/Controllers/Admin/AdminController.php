<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateRequest;
use App\Services\Admin\AdminService;

class AdminController extends Controller
{
    public function __construct(public AdminService $adminService)
    {
    }



}
