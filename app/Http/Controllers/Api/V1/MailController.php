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
    use ApiResponse,ExceptionHandler
    ;
  public function sendSampleMail(Request $request)
  {
    $recipient = $request->input('email', 'patelsujal266@gmail.com');
    Mail::to($recipient)->send(new SampleMail());
    return $this->successResponse(null, 'Sample mail sent successfully.');
  }
}