<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Comment;
use App\Models\PostMedia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $books = Book::with('genres')->orderBy('id', 'desc')->paginate();
        return view('frontend.books.book', compact('books'));
    }

    public function edit_info()
    {
        return view('frontend.users.edit_info');
    }

    public function update_info(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email',
            'mobile'        => 'required|numeric',
            'bio'           => 'nullable|min:10',
            'receive_email' => 'required',
            'user_image'    => 'nullable|image|max:20000,mimes:jpeg,jpg,png'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']           = $request->name;
        $data['email']          = $request->email;
        $data['mobile']         = $request->mobile;
        $data['bio']            = $request->bio;
        $data['receive_email']  = $request->receive_email;

        if ($image = $request->file('user_image')) {
            if (auth()->user()->user_image != '') {
                if (File::exists('/assets/users/' . auth()->user()->user_image)) {
                    unlink('/assets/users/' . auth()->user()->user_image);
                }
            }
            $filename = Str::slug(auth()->user()->username) . '.' . $image->getClientOriginalExtension();
            $path = public_path('assets/users/' . $filename);
            Image::make($image->getRealPath())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $data['user_image'] = $filename;
        }

        $update = auth()->user()->update($data);

        if ($update) {
            return redirect()->back()->with([
                'message' => __('Frontend/general.updated_successfully'),
                'alert-type' => 'success',
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('Frontend/general.something_was_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password'  => 'required',
            'password'          => 'required|confirmed'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $update = $user->update([
                'password' => bcrypt($request->password),
            ]);

            if ($update) {
                return redirect()->back()->with([
                    'message' => __('Frontend/general.password_updated'),
                    'alert-type' => 'success',
                ]);
            } else {
                return redirect()->back()->with([
                    'message' => __('Frontend/general.something_was_wrong'),
                    'alert-type' => 'danger',
                ]);
            }
        } else {
            return redirect()->back()->with([
                'message' => __('Frontend/general.something_was_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }
}
