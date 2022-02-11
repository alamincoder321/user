<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Image;
use File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::latest()->paginate(15);
        $active = User::where('status', 1)->latest()->get();
        return view('home', compact('users', 'active'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profile', compact('user'));
    }


    public function store(Request $request)
    {

        if ($request->password==$request->confirm_password) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|unique:users',
                'username' => 'required',
                'password' => 'required',
            ]);

            $user = new User;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->bio = $request->bio;
            $user->date = date('d M Y');
            $user->password = Hash::make($request->password);
            $user->save();

            Toastr::success('User added successfully');
            return back(); 
        }else{
            Toastr::error('Both Password not match');
            return back();
        }

    }

    public function update(Request $request)
    {

        if ($request->hasFile('image')) {

            if ($request->password==$request->confirm_password) {
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,'.$request->id,
                    'username' => 'required',
                    'password' => 'required',
                ]);

                $old = $request->old;

                if(File::exists($old)){
                    File::delete($old);
                }

                $image = $request->file('image');
                $filename = time().".". $image->getClientOriginalExtension();

                Image::make($image)->resize(140,140)->save(public_path('image/user/'.$filename));
                $url ="public/image/user/".$filename;

                $user = User::findOrFail($request->id);
                $user->name = $request->name;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->bio = $request->bio;
                $user->date = $request->date;
                $user->image = $url;
                $user->password = Hash::make($request->password);
                $user->update();

                Toastr::success('User update successfully');
                return back(); 
            }else{
                Toastr::error('Both Password not match');
                return back();
            }              
        }else{

            if ($request->password==$request->confirm_password) {
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required|unique:users,email,'.$request->id,
                    'username' => 'required',
                    'password' => 'required',
                ]);

                $user = User::findOrFail($request->id);
                $user->name = $request->name;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->bio = $request->bio;
                $user->date = $request->date;
                $user->image = $request->old;
                $user->password = Hash::make($request->password);
                $user->update();

                Toastr::success('User update successfully');
                return back(); 
            }else{
                Toastr::error('Both Password not match');
                return back();
            }
        }
    }

    public function inactivate(Request $request)
    {
        $id = $request->val;

        User::where('id',$id)->update(['status'=>0]);
        return back();
    }

    public function activate(Request $request)
    {
        $id = $request->val;

        User::where('id',$id)->update(['status'=>1]);
        return back();
    }


    public function usernamewise(Request $request)
    {
        $status = $request->radio;
        $name = ucwords($request->name);

        if ($status=='all') {
            $users = User::where('name', $name)->latest()->get();
            return view('namewiseuser', compact('users'));
        }else{
            $users = User::where('name', $name)->where('status',$status)->latest()->get();
            return view('namewiseuser', compact('users'));
        }
    }


    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        Toastr::error('User delete successfully');
        return back(); 
    }
}
