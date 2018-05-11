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
        //return $publication;
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
        //echo json_encode($MemberProject);
        //return json_decode($MemberProject,true);
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

        return view('user.personalProfile',['paper_years'=>$paper_years,'project_years'=>$project_years,'memberProject' => $MemberProject , 'memberPublication' => $MemberPublication ,'member' => $member]);
    }

//    public function showProfile(Request $request){
//        $user = User::find(decrypt($request->id));
//        $Member = Member::with('social_account','publication','project','education','experience')->where(['email'=>$user->email])->get();
//        //return $Member;
//        return view('user.personalProfile',['member' => $Member]);
//    }

    public function addEducation(Request $request){
        $user = User::find(Auth::user()->id);
        $Member = Member::where(['email'=>$user->email])->get();
        $education = new Education();
        $education->degree_name = $request->degree;
        $education->institute = $request->institute;
        $education->passing_year = $request->sessions;
        $education->degree_subject = $request->subject;
        $education->thesis = $request->thesis_title;
        $education->supervisor = $request->thesis_mentor;
        $education->member_id = $Member[0]->member_id;
        $education->save();
        return redirect()->back();

    }

    public function addExperience(Request $request){
        $user = User::find(Auth::user()->id);
        $Member = Member::where(['email'=>$user->email])->get();
        $experience = new Experience();
        $experience->organization_name = $request->organization;
        $experience->designation = $request->designation;
        $experience->duration = $request->sessions;
        $experience->member_id = $Member[0]->member_id;
        $experience->save();
        return redirect()->back();

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
