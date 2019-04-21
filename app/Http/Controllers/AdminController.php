<?php

namespace App\Http\Controllers;

use App\User as User;
use Illuminate\Http\Request;
use App\Member as Member;
use App\Project as Projects;
use App\Research as Researches;
use App\Publication as Publications;
use App\Experience as Experience;
use App\Education as Education;
use App\Mail\memberRequestConfirmation;
use Illuminate\Support\Facades\Mail;
use App\External_author as ex_auth;

class AdminController extends Controller
{

    public function showIndex(){
        $Members = Member::where(['status' => 'Active'])->get();;
        $external_author = ex_auth::all();
        $User = User::with('member')->where(['status' => 'Pending'],['role' => 'Member'])->get();
        return view('admin.index',['members'=>$Members,'User' => $User ,'external_author'=>$external_author]);
    }

    public function memberList(){
        $members = Member::where(['status' =>'Active'])->get();
        return view('members.memberList',['members' =>$members]);
    }

    public function addMember(){
        return view('members.addMember');
    }

    public function store(Request $request){
        if($request->hasFile('image')){
            $this->validate($request, [
                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
        }

        $member = new Member();
        $member->firstName = $request->firstname;
        $member->lastName =  $request->lastname;
        $member->current_designation =  $request->currentDesignation;
        $member->organization = $request->currentInstitute;
        $member->email =  $request->email;
        $member->phone =  $request->contactNumber;
        $member->photo =  $imageName;
        $member->save();
        $member_id  = Member::select('member_id')->orderBy('member_id','desc')->first();

        $counterEdu = intval($request->counterEdu);
        for($i=1;$i <= $counterEdu;$i++ ){
            $education = new Education();
            $deg = "degree$i";
            if($request->$deg != "") $education->degree_name = $request->$deg;
            $ins = "graduationIns$i";
            if($request->$ins != "") $education->institute = $request->$ins;
            $year = "degreePassingYear$i";
            if($request->$year !="") $education->passing_year = $request->$year;

            if($request->$year != "" || $request->$ins != "" || $request->$deg != "" ){
                $education->member_id = $member_id->member_id;
                $education->save();
            }

        }

        $counterCar = intVal($request->counterCar);

        for($i=1;$i <= $counterCar;$i++ ){
            $experience = new Experience();
            $formerOrg = "formerOrg$i";
            if($request->$formerOrg =! "") $experience->organization_name = $request->$formerOrg;
            $formerOrgDesg = "formerOrgDesg$i";
            if($request->$formerOrgDesg != "") $experience->designation = $request->$formerOrgDesg;
            $formerOrgFrm = "formerOrgFrm$i";
            if($request->$formerOrgFrm =! "") $experience->start = $request->$formerOrgFrm;
            $formerOrgTo = "formerOrgTo$i";
            if($request->$formerOrgTo != "")$experience->end = $request->$formerOrgTo;
            if($request->$formerOrg =! "" || $request->$formerOrgDesg != "" || $request->$formerOrgFrm =! "" || $request->$formerOrgTo != "" ){
                $experience->member_id = $member_id->member_id;
                $experience->save();
            }

        }
        return redirect('/members');
    }

    public function updateMember(Request $request){
        $id = decrypt($request->id);
        $members = Member::find($id);
        return view('members.updateMember',['members' =>$members]);
    }

    public function memberProfile(Request $request){
        $id = decrypt($request->id);
        $MemberResearch = Member::find($id);
        $MemberResearch->Research->all();

        $MemberProject = Member::find($id);
        $MemberProject->Project->all();
        //echo json_encode($MemberProject);
        //return json_decode($MemberProject,true);
        $MemberPublication = Member::find($id);
        $MemberPublication->Publication->all();
        $MemberEducation = Member::find($id);
        $MemberEducation->Education->all();
        //echo json_encode($MemberEducation);
        $MemberExperience = Member::find($id);
        $MemberExperience->Experience->all();
        $member = Member::find($id);
        return view('members.memberProfile',['memberResearch' => $MemberResearch , 'memberProject' => $MemberProject , 'memberPublication' => $MemberPublication , 'MemberExperience'=>$MemberExperience, 'MemberEducation' =>$MemberEducation , 'member' => $member]);
    }

    public function update(Request $request){
        $id = decrypt($request->id);
        $members = Member::find($id);
        $members->firstName = $request->firstname;
        $members->lastName =  $request->lastname;
        $members->position =  $request->position;
        $members->email =  $request->email;
        $members->phone =  $request->phone;
        $members->address =  $request->address;
        $members->save();
        return redirect('/members');
    }

    public function delete(Request $request){
        $members = Member::find($request->id);
        $members->delete();
        return redirect('/members');
    }

    public function showMemberShipRequest(Request $request){
        $User = User::where(['status' => 'Pending'])->get();
        return view('admin.showMemberShipRequest',['User' => $User]);
    }

    public function acceptUser(Request $request){
        $User = User::find(decrypt($request->id));
        $User->status = 'Active';
        $User->save();
        $Member = Member::where(['email' => $User->email])->first();
        $Member->status ="Active";
        $Member->save();
        Mail::to($Member)->send(new memberRequestConfirmation($Member));
        return redirect()->back();
    }

    public function rejectUser(Request $request){
        $User = User::find(decrypt($request->id));
        $Member = Member::where(['email' => $User->email])->delete();
        $User->delete();
        return redirect()->back();
    }

    public function externalAuthorSynchronization(Request $request){
        $Ex_auth_publication = ex_auth:: with('publication')->find(decrypt($request->id));

        if($Ex_auth_publication->publication){
            foreach ($Ex_auth_publication->publication as $item){
            $Publication = Publications::find($item->publication_id);
            $member =Member::find($request->member_id);
            $member->Publication()->save($Publication);
            $Publication->External_author()->detach($Ex_auth_publication);
            $member->external_author = 'none';
            $member->save();
            }
        }
        $ex_auth = ex_auth::find(decrypt($request->id));
        $ex_auth->delete();
        $user = Member::find($request->member_id);
        $user->external_author = 'none';
        $user->save();
        return redirect()->back();
    }
}
