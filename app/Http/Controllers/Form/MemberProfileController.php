<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Models\Members;
use App\Models\Profiles;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class MemberProfileController extends Controller
{
    public function firstForm(Request $request, Members $member)
    {
        $this->validate($request, [
            'email' => 'unique:members'
        ]);

        try {
            $member = Members::create($request->all());
            return response()->json($member)->setStatusCode(201);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()])->setStatusCode(404);
        }
    }

    public function secondForm(Request $request, $id)
    {
        $input = $request->all();

        if ($request->hasFile('photo')) {
            $input['photo'] = $request->file('photo')->store('photo', 'public');
        }

        try {
            $member = Members::where('id', $id)->update($input);
            return response()->json($member)->setStatusCode(201)->withCookie(Cookie::forget('id'));
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()])->setStatusCode(404);
        }
    }

    public function getAllProfiles()
    {
        $allProfiles = Members::orderBy('id', 'desc')->where('hide', '0')->get();

        return response()->json([$allProfiles, 'msg' => 'OK']);
    }

    public function countProfiles()
    {
        $members = Members::where('hide', '0')->count();

        return response()->json([
            'count' => $members,
            'share' => [
                'text' => 'Check out thisMeetup with SoCal AngularJS!',
                'link' => url('/')
            ]
        ]);
    }
}
