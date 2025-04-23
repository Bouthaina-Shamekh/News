<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        if(Config::get('fortify.guard') == 'publisherGuard'){
            Validator::make($input, [
                'email' => 'required|email|unique:publishers,email',
                'password' => 'same:confirm_password',
            ])->validate();
            $img =  $input['pic'];
            $attachments = $input['attachments'] ?? null;
            $imgPath = isset($img) && $img ? $img->store('uploads/publishers/images', 'public') : null;
            $attachmentsPath = isset($attachments) && $attachments ? $attachments->store('uploads/publishers/attachments', 'public') : null;
            $publisher = Publisher::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'password' => Hash::make($input['password']),
                'birth_of_date' => $input['barth_date'],
                'address' => $input['address'],
                'about' => $input['about'],
                'status' => 0,
                'visit' => 0,
                'image' => $imgPath,
                'attachments' => $attachmentsPath,
            ]);

            Auth::guard('publisherGuard')->login($publisher);
            return $publisher;
        }
        if(Config::get('fortify.guard') == 'web'){
            Admin::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                // 'avatar' => $avatar,
            ]);
        }
        return new User();
    }
}
