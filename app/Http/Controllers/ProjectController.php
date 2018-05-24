<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project as Project;
use App\Member as Members;
use Session;
use App\Keyword as Keyword;
use Auth;
use App\Supporting_document as Documents;

class ProjectController extends Controller
{
    public function show(Request $request){
        $id = $request->id;
        if($id=="1"){
            $project = Project::where('fundStatus',1)->get();
            return view('projects.projectList',['project' =>$project , 'id'=>$id]);
        }
        elseif ($id=="2"){
            $project = Project::where('fundStatus',0)->get();
            return view('projects.projectList',['project' =>$project, 'id'=>$id]);
        }
        elseif ($id=="3"){
            $project = Project::where('status',1)->get();
            return view('projects.projectList',['project' =>$project, 'id'=>$id]);
        }
        elseif ($id=="4"){
            $project = Project::where('status',0)->get();
            return view('projects.projectList',['project' =>$project, 'id'=>$id]);
        }
        elseif($id=="5"){
            $project = Project::all();
            return view('projects.projectList',['project' =>$project, 'id'=>$id]);
        }

    }

    public function checkProject(Request $request){
        $RequestedProject = $request->projectname;
        $RegisteredProject = Project::all();
        $flag = "true";
        foreach ($RegisteredProject as $item){
           if( $item['name'] == $RequestedProject){
               $flag = "false";
               break;
           }
        }
        echo $flag;
    }

    public function membreLister(){
        $Member = Members::select('member_id','firstName','lastName')->where(['status'=>'Active'])->get();
        $array = array();
        foreach ($Member as $value){
            $label = $value->firstName . ' ' .$value->lastName;
            $id = $value->member_id;
            $array[] = array("value"=>$id,"text"=>$label);
        }
        return $array;
    }

    public function addProject(){
        $array = Members::select('member_id','firstName','lastName')->where(['status'=>'Active'])->get();
        $keywords = Keyword::all();
        if(Auth::guard('web')->check()){
            if(Auth::user()->role == 'Member'){
                return view('user.addProject', ['member' =>$array, 'keywords'=>$keywords]);
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect()->back();
        }
    }

    public function addProjectAdmin(){
        $array = Members::select('member_id','firstName','lastName')->where(['status'=>'Active'])->get();
        $keywords = Keyword::all();
        if(Auth::guard('admin')->check()){
            return view('projects.addProject', ['member' =>$array, 'keywords'=>$keywords]);
        }
        else{
            return redirect()->back();
        }
    }

    public function addProjectFromPublication(){
        $array = Members::select('member_id','firstName','lastName')->where(['status'=>'Active'])->get();
        $keywords = Keyword::all();
        if(Auth::guard('admin')->check()){
            return view('projects.addProject', ['member' =>$array, 'keywords'=>$keywords]);
        }
        elseif (Auth::guard('web')->check()){
            if(Auth::user()->role == 'Member'){
                return view('user.addProjectFromPublication', ['member' =>$array, 'keywords'=>$keywords]);
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect()->back();
        }
    }

    public function store(Request $request){
        if($request->ajax()){
            $Project = new Project();
            $Project->name = $request->projectName;
            $Project->description =  $request->description;
            $Project->status = $request->complete;
            $Project->fundStatus = $request->fund;
            $Project->fundingOrganization = $request->fundOrganization;
            $Project->fundAmount = $request->fundAmount;
            $Project->start_date = $request->startDate;
            $Project->finish_date = $request->finishDate;
            $Project->src_code_path = $request->src_code_path;
            $Project->src_code_url = $request->src_code_url;
            $Project->srs_path = $request->srs_path;
            $Project->srs_url = $request->srs_url;

            $Project->save();

            $project_id  = Project::select('project_id')->orderBy('project_id','desc')->first();
            if($request->src_code_path != 'null'){
                $user = Auth::user();
                $member =Members::where(['email' => $user->email])->first();
                $Document = new Documents();
                $Document->member_id =$member->member_id ;
                $Document->project_id = $project_id->project_id;
                $Document->belongs_to = 'project';
                $Document->type = 'src';
                $Document->save();

            }
            if($request->srs_path != 'null'){
                $user = Auth::user();
                $member =Members::where(['email' => $user->email])->first();
                $Document = new Documents();
                $Document->member_id =$member->member_id ;
                $Document->project_id = $project_id->project_id;
                $Document->belongs_to = 'project';
                $Document->type = 'srs';
                $Document->save();

            }

            $projectManager = $request->projectManager;
            $member = $request->member;
            if($projectManager){
                foreach ($projectManager as $role1){
                    $Member = Members::find($role1);
                    $Member->Project()->save($project_id,['role' => "Project Manager"]);
                }
            }
            if($member){
                foreach ($member as $role2){
                    $Member = Members::find($role2);
                    $Member->Project()->save($project_id,['role' => "Project Member"]);
                }
            }
            $keywords = $request->keywords;
            $newKeywords = $request->new_keywords;
            if($keywords){
                foreach ($keywords as $item){
                    $id = Keyword::where(['name' =>strtoupper($item)])->first();
                    $keyword = Keyword::find($id->id);
                    $keyword->Project()->save($project_id);
                }
            }
            if(sizeof($newKeywords)>0){
                foreach ($newKeywords as $item){
                    $id = Keyword::where(['name' =>strtoupper($item)])->first();
                    $keyword = Keyword::find($id->id);
                    $keyword->Project()->save($project_id);
                }
            }

            Session::flash('ProjectAdd','New project has been added successully!');
        }
        else {
            $projectManager = $request->projectManager;
            $member = $request->member;
            var_dump($projectManager);
            var_dump($member);
            echo "not ajax";
        }
    }

    public function projectDescription(Request $request){

        $Project = Project::with('member','keyword','publication')->find(decrypt($request->id));
        //echo json_encode($Project);
        return view('Projects.projectDetail',['Project' => $Project]);
    }

    public function updateProject(Request $request){
        $Project = Project::with('keyword')->find(decrypt($request->id));
        $Project->Member->all();
        $array = Members::select('member_id','firstName','lastName')->where(['status'=>'Active'])->get();
        $keywords = Keyword::all();
        return view('Projects.updateProject',['project' => $Project , 'member' =>$array, 'keywords'=>$keywords]);
    }

    public function update(Request $request){
        if($request->ajax()){
            $Project = Project::find(decrypt($request->id));
            $Project->name = $request->projectName;
            $Project->description =  $request->description;
            $Project->status = $request->complete;
            $Project->fundStatus = $request->fund;
            $Project->fundingOrganization = $request->fundOrganization;
            $Project->fundAmount = $request->fundAmount;
            $Project->start_date = $request->startDate;
            $Project->finish_date = $request->finishDate;
            $Project->src_code_url = $request->src_code_url;
            if($request->src_code_path != "null"){
                $Project->src_code_path = $request->src_code_path;
            }
            if($request->srs_path != "null"){
                $Project->srs_path = $request->srs_path;
            }
            $Project->srs_url = $request->srs_url;
            $Project->save();

            $projectManager = $request->projectManager;
            $member = $request->member;

            $conf = intval(sizeof($projectManager))+intval(sizeof($member));
            if($conf>=2){
                foreach ($projectManager as $role1){
                    $MemberArray[$role1] = ['role' => "Project Manager"];
                }
                foreach ($member as $role2){
                    $MemberArray[$role2] = ['role' => "Project Member"];
                }
                $Project->Member()->sync($MemberArray);
            }

            if($request->src_code_path != 'null'){
                $user = Auth::user();
                $member =Members::where(['email' => $user->email])->first();
                $Document = new Documents();
                $Document->member_id =$member->member_id ;
                $Document->project_id = $Project->project_id;
                $Document->belongs_to = 'project';
                $Document->type = 'src';
                $Document->save();

            }
            if($request->srs_path != 'null'){
                $user = Auth::user();
                $member =Members::where(['email' => $user->email])->first();
                $Document = new Documents();
                $Document->member_id =$member->member_id ;
                $Document->project_id = $Project>project_id;
                $Document->belongs_to = 'project';
                $Document->type = 'srs';
                $Document->save();

            }
            $keywords = $request->keywords;
            $newKeywords = $request->new_keywords;
            if($keywords){
                $keywords_array = [];
                foreach ($keywords as $item){
                    $keyword_id = Keyword::where('name',$item)->first();
                    array_push($keywords_array,$keyword_id['id']);
                }
                $Project->Keyword()->sync($keywords_array);
            }
            if(sizeof($newKeywords)>0){
                foreach ($newKeywords as $item){
                    $id = Keyword::where(['name' =>strtoupper($item)])->first();
                    $keyword = Keyword::find($id->id);
                    $keyword->Project()->save($Project>project_id);
                }
            }
            Session::flash('ProjectUpdate','Project has been updated successully!');
        }
    }

    public function delete(Request $request){
        echo $request->id;
       $Project = Project::find(decrypt($request->id));
//        $Project->Member->all();
//        $Project->Member()->detach($request->id);
        $Project->delete();
        Session::flash('ProjectDelete','Project has been deleted successully!');
        return redirect('/admin/projectlist/5');
    }

    public function onGoingProject(){
        $Project = Project::where('status',0)->get();
        return view('Projects.onGoingProject',['project' => $Project,'status'=>0 , 'fund' => ""]);
    }

    public function completeProject(){
        $Project = Project::where('status',1)->get();
        return view('Projects.onGoingProject',['project' => $Project,'status'=>1 , 'fund' => ""]);
    }

    public function fundedProject(){
        $Project = Project::where('fundStatus',1)->get();
        return view('Projects.onGoingProject',['project' => $Project,'status'=> "", 'fund' => 1]);
    }

    public function nonFundedProject(){
        $Project = Project::where('fundStatus',0)->get();
        return view('Projects.onGoingProject',['project' => $Project,'status'=>"" , 'fund' => 0]);
    }

}
