<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function homePageAdmin()
    {
        return view('admin.index', [
            'profiles_count' => Members::count()
        ]);
    }

    public function listMembers()
    {
        return view('admin.list_member', [
            'profiles' => Members::all()
        ]);
    }

    public function changeHideField($id)
    {
        $member = Members::find($id);
        if ($member->hide == 1) {
            $member->hide = 0;
        } else {
            $member->hide = 1;
        }

        $member->save();

        return redirect()->back()->withSuccess('Field "HIDE" was successfully changed');
    }

    public function destroy($id)
    {
        Members::find($id)->delete();

        return redirect()->back()->withSuccess('Deletion was successful');
    }

    public function edit($id)
    {
        return view('admin.edit_member', [
            'member' => Members::find($id),
            'countries' => Country::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'company' => 'max:100',
            'position' => 'max:100',
            'aboutMe' => 'max:500',
            'photo' => 'mimes:png,jpg|image',
            'firstName' => 'required|max:100',
            'lastName' => 'required|max:100',
            'birthdate' => 'required|date|before:now',
            'reportSubject' => 'required|max:100',
            'countryId' => 'required',
            'email' => 'required|regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
            'phone' => 'required'
        ]);

        $member = Members::where('id', $id);

        $input = $request->all();
        // $input = array_slice($input, 2);

        if ($request->hasFile('photo')) {
            $input['photo'] = $request->file('photo')->store('photo', 'public');
        } else {
            $input['photo'] = $member->value('photo');
        }

        $member->update($input);

        return redirect()->back()->withSuccess('Member was successfully updated');
    }

    public function deletePhoto($id)
    {
        $member = Members::find($id);

        if ($member->photo == null) {
            return redirect()->back()->withErrors('Photo has not been installed');
        }

        $member->photo = null;
        $member->save();
        return redirect()->back()->withSuccess('Photo was successfully deleted');
    }
}
