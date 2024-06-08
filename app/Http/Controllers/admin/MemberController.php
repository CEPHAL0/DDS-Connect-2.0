<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where("role", "moderator")->get();
        return view('admin.members.index', compact("members"));
    }

    public function create()
    {
        return view("admin.members.create");
    }

    public function store(MemberRequest $request)
    {
        $data = $request->validated();

        if ($request->has("profile_image")) {
            $image = $request->file("profile_image");
            $imageName = str_replace([" ", "."], "_", $data["username"]) . "_" . Carbon::now()->timestamp . "." . $image->getClientOriginalExtension();
            $request->file("profile_image")->storeAs("images/users", $imageName, "public");
        } else {
            $imageName = "default.jpg";
        }

        User::create([
            "name" => $data["name"],
            "username" => $data["username"],
            "email" => $data["email"],
            "profile_image_url" => $imageName,
            "password" => Hash::make("password"),
            "role" => "moderator"
        ]);

        return redirect(route("adminMembers.index"))->with("success", "Club Member added successfully");
    }

    public function edit(int $memberId)
    {
        $member = User::where("id", $memberId)->where("role", "moderator")->firstOrFail();
        return view('admin.members.edit', compact("member"));
    }

    public function update(MemberRequest $request, int $memberId)
    {
        $data = $request->validated();
        $member = User::findOrFail($memberId);

        if ($request->has("profile_image")) {
            $image = $request->file("profile_image");
            $imageName = str_replace([" ", "."], "_", $data["username"]) . "_" . Carbon::now()->timestamp . "." . $image->getClientOriginalExtension();
            $request->file("profile_image")->storeAs("images/users", $imageName, "public");

            if ($member->profile_image_url != 'default.jpg') {

                Storage::delete("public/images/users/" . $member->profile_image_url);
            }

            $member->update([
                "name" => $data["name"],
                "username" => $data["username"],
                "email" => $data["email"],
                "profile_image_url" => $imageName
            ]);
        } else {
            $member->update([
                "name" => $data["name"],
                "username" => $data["username"],
                "email" => $data["email"],
            ]);
        }
        return redirect(route("adminMembers.index"))->with("success", "Club Member updated successfully");
    }

    public function destroy(int $memberId)
    {
        $member = User::where("id", $memberId)->where("role", "moderator")->firstOrFail();

        if ($member->profile_image_url != "default.jpg") {
            Storage::delete("public/images/users/" . $member->profile_image_url);
        }


        $member->delete();

        return redirect(route("adminMembers.index"))->with("success", "Club Member Deleted successfully");

    }
}
