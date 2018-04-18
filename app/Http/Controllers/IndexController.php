<?php

namespace App\Http\Controllers;

use App\Member as Member;
use App\Project as Project;
use Illuminate\Http\Request;
use App\Experience as Experience;
use App\Education as Education;
use App\Project as Projects;
use App\Publication as Publications;
use App\Keyword as Keyword;
use App\Event as Events;
use App\Supporting_document as SD;
use Response;
use App\User as User;

class IndexController extends Controller
{
    public function download(Request $request)
    {
        // Check if file exists in app/storage/file folder
        //return $request->filename;
        $file_path = storage_path() .'/app/public/uploaded_documents/'. $request->filename;
        if (file_exists($file_path))
        {
            // Send Download
            return Response::download($file_path,$request->filename, [
                'Content-Length: '. filesize($file_path)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }

    public function showIndex(){
        $projects = Projects::all();
        $publications = Publications::all()->take(6);
        $member = Member::where(['status'=>'Active'])->get();
        return view('user.index',['projects'=>$projects, 'publications'=>$publications, 'members'=>$member]);
    }

    public function showMembers(){
        $members = Member::with('social_account')->where(['status' =>'Active'])->paginate(6);
        return view('user.members',['members' => $members]);
    }

    public function showAllPublication(){
        $Publications = Publications::with('member')->orderBy('publication_id','DESC')->paginate(10);
        return view('user.publications',['Publications' =>$Publications, 'type'=> 'All']);

    }

    public function showProjects(Request $request){
        $id = $request->id;
        if($id=="1"){
            $project = Project::where('fundStatus',1)->orderBy('project_id','DESC')->paginate(10);
            return view('user.projects',['Project' =>$project , 'id'=>$id]);
        }
        elseif ($id=="2"){
            $project = Project::where('fundStatus',0)->orderBy('project_id','DESC')->paginate(10);
            return view('user.projects',['Project' =>$project, 'id'=>$id]);
        }
        elseif ($id=="3"){
            $project = Project::where('status',1)->orderBy('project_id','DESC')->paginate(10);
            return view('user.projects',['Project' =>$project, 'id'=>$id]);
        }
        elseif ($id=="4"){
            $project = Project::where('status',0)->orderBy('project_id','DESC')->paginate(10);
            return view('user.projects',['Project' =>$project, 'id'=>$id]);
        }
        elseif($id=="5"){
            $project = Project::orderBy('project_id','DESC')->paginate(10);
            return view('user.projects',['Project' =>$project, 'id'=>$id]);
        }
    }

    public function showMemberProfile(Request $request){
        $id = decrypt($request->id);
        $MemberProject = Member::find($id);
        $MemberProject->Project->all();
        $MemberPublication = Member::with('Publication')->find($id);

        $MemberEducation = Member::find($id);
        $MemberEducation->Education->all();
        $MemberExperience = Member::find($id);
        $MemberExperience->Experience->all();
        $MemberSocialAccount = Member::with('social_account')->find($id);
        $member = Member::find($id);
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
            $a = array_search(date('Y',strtotime($item['finish_date'])),$project_years);
            if($a == 'true' || $a){

            }else{
                array_push($project_years,intval(date('Y',strtotime($item->finish_date))));
            }
        }
        rsort($project_years);

        return view('user.memberProfile',['paper_years'=>$paper_years,'project_years'=>$project_years,'social_accounts'=>$MemberSocialAccount,'memberProject' => $MemberProject , 'memberPublication' => $MemberPublication , 'MemberExperience'=>$MemberExperience, 'MemberEducation' =>$MemberEducation , 'member' => $member]);

    }

    public function showPublications(Request $request){
        $Publications = Publications::with('member')
            ->where(['publication_type' => $request->type])
            ->orderBy('publication_id','DESC')
            ->paginate(10);
        return view('user.publications',['Publications' =>$Publications,'type'=>$request->type]);
    }

    public function showIndivisualPublication(Request $request){
        $Publication = Publications::with('member','keyword','project','external_author')->find(decrypt($request->id));
        return view('user.indivisualPublication',['Publications' => $Publication]);
    }

    public function showTagWiseResult(Request $request){
        $Result = Keyword::with(['publication' => function ($query) {
            return $query->orderBy('publication_id','DESC');
        },'project' => function ($query) {
            return $query->orderBy('project_id','DESC');
        }])->find(decrypt($request->id));
        return view('user.tagWiseRsult',['Result'=>$Result]);
    }

    public function showIndivisualProject(Request $request){
        $Project = Projects::with('member','keyword','publication')->find(decrypt($request->id));
        //return json_encode($Project);
        return view('user.indivisualProject',['Project' => $Project]);
    }

    public function showPublisherWiseResult(Request $request){
        $Result = Publications::where(['publisher'=>$request->name])
            ->orWhere(['conference_name'=>$request->name])
            ->orderBy('publication_id','DESC')
            ->paginate(10);
        return view('user.publisherWiseRsult',['Result'=>$Result]);
    }

    public function showConferenceWiseResult(Request $request){
        $Result = Publications::where(['conference_name'=>$request->name])->orderBy('publication_id','DESC')->paginate(10);
        return view('user.publisherWiseRsult',['Result'=>$Result]);
    }

    public function showJournalWiseResult(Request $request){
        $Result = Publications::where(['journal_name'=>$request->name])->orderBy('publication_id','DESC')->paginate(10);
        return view('user.journalWiseRsult',['Result'=>$Result]);
    }

    public function showEvents(){
        $Events = Events::orderBy('id','desc')->get();
        return view('user.events' ,['events' => $Events]);
    }

    public function showSupportingDocs(Request $request){
        $documents = SD::with('member','project','publication')->where(['type'=>$request->name])->paginate(10);
        return view('user.supportingDoc',['Documents' => $documents,'type' =>$request->name]);
    }

    public function checkEmail(Request $request){
        $check = sizeof(User::where(['email' => $request->email])->get());
        if ($check>0) $check = "false";
        else $check = "true";
        return $check;
    }
}
