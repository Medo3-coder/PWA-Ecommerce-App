<?php

namespace App\Traits;

trait ResponseTrait {

    public function response($key, $msg, $data = [], $additionalData = [], $includePage = false) {
        $reponse = [
            'key' => (string) $key,
            'msg' => (string) $msg,
        ];

        // Add unread notifications count if requested and user is authenticated
        if ($key === 'success' && request()->has('count_notifications') && auth()->check()) {
            $response['count_notifications'] = auth()->user()->notifications()->unread()->count();
        }

        // Merge any additional data into the response
        if (!empty($additionalData)) {
            $reponse = array_merge($reponse, $additionalData);
        }

        // Include the data in the response if applicable
        if (!empty($data) && in_array($key, ['success', 'needActive', 'exception'])) {
            $reponse['data'] = $data;
        }

        return response()->json($reponse);

    }

    public function successReturn($msg = '', $data = [], $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([

            // 'user_status' => auth('api')->user() ? auth('api')->user()->status : '',
            'msg'         => $msg,
            'key'         => 'success',
            'code'        => $code,
            'data'        => $data,
        ]);

    }

    public function successData($data) {
        return $this->response('success', $data);
    }
}
