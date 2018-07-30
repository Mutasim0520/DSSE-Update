<?php

namespace App\Http\Controllers;

use App\Member as Member;
use App\Project as Project;
use Illuminate\Http\Request;
use App\Experience as Experience;
use App\Education as Education;
use App\Publication as Publications;
use App\User as User;
use Auth;
use App\Social_account as Social;
use App\Keyword as Keyword;
use App\External_author as ex_auth;
use Session;

class UserController extends Controller
{
    public function up(){
        $ed = Education::all();
        foreach ($ed as $item){
            $a = Education::find($item->id);
            $a->degree_name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($item->degree_name)));
            $a->save();
        }
    }

    public function checkGraduation(Request $request){
        $RequestedItem =htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->degree)));
        $RegisteredItem = Education::where('degree_name',$RequestedItem)->first();
        $flag = "true";
        if($RegisteredItem) $flag = "false";
        echo $flag;
    }

    public function deleteProject(Request $request){
        $project = Project::where('project_id',$request->id)->first();
        $project->delete();
        Session::flash('ProjectDelete','Project successfully deleted');
        return redirect()->back();
    }

    public function deletePublication(Request $request){
        $publication = Publications::where('publication_id',$request->id)->first();
        $publication->delete();
        Session::flash('PublicationDelete','Item successfully deleted');
        return redirect()->back();
    }

    public function showUpdatePublicationForm(Request $request){
        $array = Member::where(['status'=>'Active'])->get();
        $keywords = Keyword::all();
        $projects = Project::all();
        $external_authors = ex_auth::all();
        $publication = Publications::with('external_author','member','project','keyword')->find($request->id);
        return view('user.updatePublication' , ['publication' => $publication,'external_authors' => $external_authors,'keywords'=>$keywords,'member' => $array ,'Project' =>$projects]);
    }

    public function showUpdateProjectForm(Request $request){
        $Project = Project::with('keyword')->find($request->id);
        $Project->Member->all();
        $array = Member::select('member_id','firstName','lastName')->where(['status'=>'Active'])->get();
        $keywords = Keyword::all();
        return view('user.updateProject',['project' => $Project , 'member' =>$array, 'keywords'=>$keywords]);
    }

    public function showIndex(){
        return view('user.index');
    }

    public function showMembers(){
        $members = Member::where(['status' =>'Active'])->get();
        return view('user.members',['members' => $members]);
    }

    public function showProjects(Request $request){
        $id = $request->id;
        if($id=="1"){
            $project = Project::where('fundStatus',1)->get();
            return view('user.projects',['Project' =>$project , 'id'=>$id]);
        }
        elseif ($id=="2"){
            $project = Project::where('fundStatus',0)->get();
            return view('user.projects',['Project' =>$project, 'id'=>$id]);
        }
        elseif ($id=="3"){
            $project = Project::where('status',1)->get();
            return view('user.projects',['Project' =>$project, 'id'=>$id]);
        }
        elseif ($id=="4"){
            $project = Project::where('status',0)->get();
            return view('user.projects',['Project' =>$project, 'id'=>$id]);
        }
        elseif($id=="5"){
            $project = Project::all();
            return view('user.projects',['Project' =>$project, 'id'=>$id]);
        }
    }

    public function showProfile(Request $request){
        $id = decrypt($request->id);
        $user = User::with('member')->find($id);

        $MemberProject = Member::find($user->member->member_id);
        $MemberProject->Project->all();
        $MemberPublication = Member::with('Publication')->find($user->member->member_id);

        $member = Member::with('social_account','education','experience')->where(['email'=>$user->email])->get();

        $paper_years = [];
        $project_years = [];

        foreach ($MemberPublication['publication'] as $item){
            $a = array_search(date('Y',strtotime($item['date'])),$paper_years);
            if($a == 'true' || $a){

            }else{
                array_push($paper_years,intval(date('Y',strtotime($item->date))));
            }
        }
        rsort($paper_years);

        foreach ($MemberProject['project'] as $item){
            $a = array_search(date('Y',strtotime($item['start_date'])),$project_years);
            if($a == 'true' || $a){

            }else{
                array_push($project_years,intval(date('Y',strtotime($item->start_date))));
            }
        }
        rsort($project_years);
        return view('user.personalProfile',['paper_years'=>$paper_years,'project_years'=>$project_years,'memberProject' => $MemberProject , 'memberPublication' => $MemberPublication ,'member' => $member]);
    }

    public function addEducation(Request $request){
        $user = User::find(Auth::user()->id);
        $Member = Member::where(['email'=>$user->email])->get();
        $education = new Education();
        $education->degree_name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->degree)));
        $education->institute = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->institute)));
        $education->passing_year = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->sessions)));
        $education->degree_subject = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->subject)));
        $education->thesis = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->thesis_title)));
        $education->supervisor = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->thesis_mentor)));
        $education->member_id = $Member[0]->member_id;
        $education->save();
        Session::flash('GraduationAdd','Graduation has been added successfully!');
        return redirect()->back();

    }

    public function showUpdateEducationForm(Request $request){
        $education = Education::where(['degree_name' => $request->degree])->first();
        return view('user.updateEducationForm',['education'=>$education]);
    }

    public function updateEducation(Request $request){
        $user = User::find(Auth::user()->id);
        $Member = Member::where(['email'=>$user->email])->get();
        $education = Education::where(['degree_name' => $request->degree])->first();
        $education->degree_name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->degree)));
        $education->institute = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->institute)));
        $education->passing_year = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->sessions)));
        $education->degree_subject = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->subject)));
        $education->thesis = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->thesis_title)));
        $education->supervisor = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->thesis_mentor)));
        $education->member_id = $Member[0]->member_id;
        $education->save();
        $id = encrypt($user->id);
        Session::flash('GraduationUpdate','Graduation has been updated successfully!');
        return redirect("/indivisual/profile/$id");

    }

    public function deleteEducation(Request $request){
        $education = Education::where(['degree_name' => $request->degree])->first();
        $education->delete();
        Session::flash('GraduationDelete','Graduation has been deleted successfully!');
        return redirect()->back();
    }

    public function addExperience(Request $request){
        $user = User::find(Auth::user()->id);
        $Member = Member::where(['email'=>$user->email])->get();
        $experience = new Experience();
        $experience->organization_name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->organization)));
        $experience->designation = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->designation)));
        $experience->duration = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->sessions)));
        $experience->member_id = $Member[0]->member_id;
        $experience->save();
        Session::flash('CareerAdd','Career has been added successfully!');
        return redirect()->back();

    }

    public function showUpdateCareerForm(Request $request){
        $experience = Experience::find($request->id);
        return view('user.updateCareerForm',['experience'=>$experience]);
    }

    public function updateCareer(Request $request){
        $user = User::find(Auth::user()->id);
        $Member = Member::where(['email'=>$user->email])->get();
        $experience = Experience::find($request->id);
        $experience->organization_name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->organization)));
        $experience->designation = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->designation)));
        $experience->duration = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->sessions)));
        $experience->member_id = $Member[0]->member_id;
        $experience->save();
        $id = encrypt($user->id);
        Session::flash('CareerUpdate','Career has been update successfully!');
        return redirect("/indivisual/profile/$id");

    }

    public function deleteCareer(Request $request){
        $experience = Experience::find($request->id);
        $experience->delete();
        Session::flash('CareerDelete','Career has been deleted successfully!');
        return redirect()->back();
    }

    public function addContact(Request $request){
        $user = User::find(Auth::user()->id);
        $Member = Member::where(['email'=>$user->email])->first();
        $Member->additional_email = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->ad_email)));
        $Member->address = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->address)));
        $Member->contact = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->contact)));
        $Member->save();
        $id = encrypt($user->id);
        Session::flash('ContactUpdate','Contact has been update successfully!');
        return redirect("/indivisual/profile/$id");
    }

    public function deleteContact(){
        $user = User::find(Auth::user()->id);
        $Member = Member::where(['email'=>$user->email])->first();
        $Member->additional_email = "";
        $Member->address = "";
        $Member->contact = "";
        $Member->save();
        $id = encrypt($user->id);
        Session::flash('ContactDelete','Contact has been delete successfully!');
        return redirect("/indivisual/profile/$id");
    }

    public function uploadPP(Request $request){
        if($request->hasFile('file')){
            $this->validate($request, [
                'file' => 'mimes:jpeg,png,jpg,gif,svg|max:10048',
            ]);
            $imageName = time().'.'.$request->file->getClientOriginalExtension();
            $request->file->move(public_path('images'), $imageName);
            $user = Auth::user();

            $Member = Member::where(['email'=>$user->email])->first();
            $Member->photo = $imageName;
            $Member->save();
            return redirect()->back();
        }
    }

    public function updateUserInfo(Request $request){
       $user = Auth::user();
        $Member = Member::where(['email'=>$user->email])->first();
        $Member->firstName = $request->first_name;
        $Member->lastName = $request->last_name;
        $Member->current_designation = $request->designation;
        $Member->organization = $request->work_place;
        $Member->save();
        return redirect()->back();
    }

    public function addSocialLink(Request $request){
        $user  = Auth::user();
        $member = Member::where(['email' =>$user->email])->first();
        $social_account = new Social();
        $social_account->name = $request->account_type;
        $social_account->url = trim($request->url);
        $social_account->member_id = $member->member_id;
        $social_account->save();
        return redirect()->back();
    }

    public function addPublicationName(Request $request){
        $user = Auth::user();
        $member = Member::where(['email' =>$user->email])->first();
        $member->publication_name = $request->publication_name;
        $member->save();
        return redirect()->back();
    }

}
