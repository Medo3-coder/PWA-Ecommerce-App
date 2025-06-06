<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\StoreRequest;
use App\Models\Contact;
use App\Traits\ResponseTrait;

class ContactController extends Controller {
    use ResponseTrait;


    public function postContact(StoreRequest $request) {
        // $user = auth('api')->user();
        // if ($user) {

        //     $contact = Contact::create($request->validated() + ['user_id' => $user->id]);
        // }
        $contact = Contact::create($request->validated());

        return response()->json([
            'message' => "Contact details submitted successfully",
            'contact' => $contact,
        ], 201);

    }
}
