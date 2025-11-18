<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Traits\ExceptionHandler;
use Illuminate\Http\Request;
use App\Mail\SampleMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    use ApiResponse,ExceptionHandler;


  public function sendCategoryCreatedMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'category_name' => 'required|string',
        ]);

        $categoryData = [
            'name' => $request->input('category_name'),
        ];

        Mail::to($request->input('email'))->send(new SampleMail((object)$categoryData));

        return $this->successResponse(null, 'Sample email sent successfully.');
    }
}