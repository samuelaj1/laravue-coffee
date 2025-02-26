<?php
namespace App\Services;

class ApiResponse {
    public string $status;
    public string $message;
    public $extra;

    public function __construct($status, $message, $extra)
    {
        $this->message = $message;
        $this->status = $status;
        $this->extra =  $extra;
    }

    static public function failedResponse($message = "FAILED", $extra = null): ApiResponse
    {
        return new ApiResponse(false,$message,$extra);
    }

    static public function successResponse($message = "SUCCESS", $extra = null): ApiResponse
    {
        return new ApiResponse(true,$message,$extra);
    }

    static public function successResponseV2($extra = null, $message = "SUCCESS"): ApiResponse
    {
        return new ApiResponse(true,$message,$extra);
    }

}
