<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Member as Members;
use App\Publication as Publications;
use Session;
use App\Google;
use App\Keyword as Keyword;
use App\Project as Projects;
use Auth;
use App\Supporting_document as Documents;
use App\External_author as ex_auth;

class PublicationController extends Controller
{

    public function show(){
        $Publications = Publications::all();
        return view('publications.publicationsList',['Publications' => $Publications]);
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

    public function addPublication(){
        $array = Members::where(['status'=>'Active'])->get();
        $keywords = Keyword::all();
        $projects = Projects::all();
        $external_authors = ex_auth::all();
        //print_r($research);
        if(Auth::guard('admin')->check()){
            return view('publications.addPublication',['keywords'=>$keywords,'member' => $array ,'Project' =>$projects]);
        }
        elseif(Auth::guard('web')->check()){
            if(Auth::user()->role == 'Member'){
                return view('user.addPublication',['external_authors' => $external_authors,'keywords'=>$keywords,'member' => $array ,'Project' =>$projects]);
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
        if($request->ajax())
        {
            $Publication  = new Publications();
            $Publication-> name = trim($request->publication_name);
            $Publication-> publication_type = $request->publication_type;
            $Publication->abstract = $request->abstract;
            if($request->publication_type == 'book'){
                $Publication->book_addition = trim($request->book_adition);
                $Publication->date = $request->book_date;
                $Publication->publisher = trim($request->book_publisher);
                $Publication->page = trim($request->book_page);
                $Publication->book_section = trim($request->book_section);
                $Publication->book_chapter_name = trim($request->book_chapter_name);
                $Publication->book_chapter = trim($request->book_chapter);
            }
            elseif($request->publication_type == 'journal'){
                $Publication->volume = $request->journal_volume;
                $Publication->page = $request->journal_page;
                $Publication->date = $request->journal_date;
                $Publication->publisher = trim($request->journal_publisher);
                $Publication->journal_name = trim($request->journal_name);

            }
            elseif($request->publication_type == 'conference'){
                $Publication->page = $request->conf_page;
                $Publication->date = $request->conf_date;
                $Publication->conference_name = trim($request->conf_publisher);
            }
            elseif($request->publication_type == 'thesis'){
                $Publication->supervisor = $request->thesis_supervisor;
                $Publication->page = $request->thesis_page;
                $Publication->date = $request->thesis_date;
                $Publication->university = trim($request->thesis_university);

            }

            $Publication->project_status = $request->project_status;
            if($request->project_status == '1'){
                $Publication->project_id = $request->project_name;
            }
            $Publication->fund_amount = $request->fund_amount;
            $Publication->fund_organization = $request->fund_ins;
            $Publication->affiliated_institute = trim($request->aff_ins_name);
            $Publication->dataset_file = $request->dataset_path;
            $Publication->dataset_url = $request->dataset_link;
            $Publication->src_code_file = $request->src_code_path;
            $Publication->src_code_url = $request-> src_code_link;
            $Publication->paper_path = $request->paper_path;
            $Publication->paper_url = $request->document_link;
            $Publication->save();

            $keywords = $request->keywords;
            $newKeywords = $request->new_keywords;
            $external_authors = $request->external_author;
            $new_external_authors = $request->additional_authors;

            $author = $request->author;

            $publication_id  = Publications::select('publication_id')->orderBy('publication_id','desc')->first();

            if($request->src_code_path != 'null'){
                $user = Auth::user();
                $member =Members::where(['email' => $user->email])->first();
                $Document = new Documents();
                $Document->member_id =$member->member_id ;
                $Document->publication_id = $publication_id->publication_id;
                $Document->belongs_to = 'publication';
                $Document->type = 'src';
                $Document->save();
            }

            if($request->dataset_path != 'null'){
                $user = Auth::user();
                $member =Members::where(['email' => $user->email])->first();
                $Document = new Documents();
                $Document->member_id =$member->member_id ;
                $Document->publication_id = $publication_id->publication_id;
                $Document->belongs_to = 'publication';
                $Document->type = 'dataset';
                $Document->save();
            }

            if($request->projrct_status == "1"){
                $Project = Projects::find($request->project_name);
                $Project->publication()->save($publication_id);
            }

            if($author){
                foreach ($author as $item){
                    $mem_id = $item;
                    $Member = Members::find($mem_id);
                    $Member->Publication()->save($publication_id);
                }
            }

            if($keywords){
                foreach ($keywords as $item){
                    $id = Keyword::where(['name' =>strtoupper($item)])->first();
                    $keyword = Keyword::find($id->id);
                    $keyword->Publication()->save($publication_id);
                }
            }

            if($newKeywords){
                foreach ($newKeywords as $item){
                    $id = Keyword::where(['name' =>strtoupper($item)])->first();
                    $keyword = Keyword::find($id->id);
                    $keyword->Publication()->save($publication_id);
                }
            }

            if($external_authors){
                foreach ($external_authors as $item){
                    $ex_auth = ex_auth::find($item);
                    $ex_auth->Publication()->save($publication_id);
                }
            }

            if($new_external_authors){
                foreach ($new_external_authors as $item){
                    $id = ex_auth::where(['name' =>ucwords($item)])->first();
                    $ex_auth = ex_auth::find($id->id);
                    $ex_auth->Publication()->save($publication_id);
                }
            }

            Session::flash('PublicationAdd','New publication has been added successully!');
            echo ("good job all has been done");

        }
        else{
            echo "not ajax";
        }
    }

    public function storeFile(Request $request){
        if($request->ajax()){
            if($request->file('file')){
                $this->validate($request, [
                    'file'=> 'required|mimes:docx,doc,pdf|max:80000',
                ]);

                $fileName = time().'.'.$request->file('file')->getClientOriginalExtension();
                $path = $request->file('file')->storeAs('uploaded_documents',$fileName,'public');
                echo $fileName;
            }
            else{
                return redirect()->back();
            }
        }
        else return redirect()->back();
    }

    public function updatePublication(Request $request){
        $array = Members::where(['status'=>'Active'])->get();
        $keywords = Keyword::all();
        $projects = Projects::all();
        $external_authors = ex_auth::all();
        $publication = Publications::with('external_author','member','project','keyword')->find(decrypt($request->id));
        return view('publications.updatePublication' , ['publication' => $publication,'external_authors' => $external_authors,'keywords'=>$keywords,'member' => $array ,'Project' =>$projects]);
    }

    public function update (Request $request){
        if($request->ajax()){
            $author = $request->author;
            $Publication  = Publications::find(decrypt($request->id));
            $Publication-> name = trim($request->publication_name);
            $Publication-> publication_type = $request->publication_type;
            $Publication->abstract = $request->abstract;
            if($request->publication_type == 'book'){
                $Publication->book_addition = trim($request->book_adition);
                $Publication->date = $request->book_date;
                $Publication->publisher = trim($request->book_publisher);
                $Publication->page = trim($request->book_page);
                $Publication->book_section = trim($request->book_section);
                $Publication->book_chapter_name = trim($request->book_chapter_name);
                $Publication->book_chapter = trim($request->book_chapter);
            }
            elseif($request->publication_type == 'journal'){
                $Publication->volume = $request->journal_volume;
                $Publication->page = $request->journal_page;
                $Publication->date = $request->journal_date;
                $Publication->publisher = trim($request->journal_publisher);
                $Publication->journal_name = trim($request->journal_name);

            }
            elseif($request->publication_type == 'conference'){
                $Publication->page = $request->conf_page;
                $Publication->date = $request->conf_date;
                $Publication->conference_name = trim($request->conf_publisher);
            }
            elseif($request->publication_type == 'thesis'){
                $Publication->supervisor = $request->thesis_supervisor;
                $Publication->page = $request->thesis_page;
                $Publication->date = $request->thesis_date;
                $Publication->university = trim($request->thesis_university);

            }

            $Publication->project_status = $request->project_status;
            if($request->project_status == '1'){
                $Publication->project_id = $request->project_name;
            }
            $Publication->fund_amount = $request->fund_amount;
            $Publication->fund_organization = $request->fund_ins;
            $Publication->affiliated_institute = trim($request->aff_ins_name);
            $Publication->dataset_file = $request->dataset_path;
            $Publication->dataset_url = $request->dataset_link;
            $Publication->src_code_file = $request->src_code_path;
            $Publication->src_code_url = $request-> src_code_link;
            $Publication->paper_path = $request->paper_path;
            $Publication->paper_url = $request->document_link;
            $Publication->save();
            if($author){
                $mem_id = array();
                foreach ($author as $item){
                    array_push($mem_id,$item);
                }
                print_r($mem_id);
                $Publication->Member()->sync($mem_id);
            }
            if($request->src_code_path != 'null'){
                $user = Auth::user();
                $member =Members::where(['email' => $user->email])->first();
                $Document = new Documents();
                $Document->member_id =$member->member_id ;
                $Document->publication_id = $publication_id->publication_id;
                $Document->belongs_to = 'publication';
                $Document->type = 'src';
                $Document->save();
            }

            if($request->dataset_path != 'null'){
                $user = Auth::user();
                $member =Members::where(['email' => $user->email])->first();
                $Document = new Documents();
                $Document->member_id =$member->member_id ;
                $Document->publication_id = $publication_id->publication_id;
                $Document->belongs_to = 'publication';
                $Document->type = 'dataset';
                $Document->save();
            }

            $keywords = $request->keywords;
            $newKeywords = $request->new_keywords;
            $external_authors = $request->external_author;
            $new_external_authors = $request->additional_authors;

            if($keywords){
                $keywords_array = [];
                foreach ($keywords as $item){
                    $keyword_id = Keyword::where('name',$item)->first();
                    array_push($keywords_array,$keyword_id['id']);
                }
                $Publication->Keyword()->sync($keywords_array);
            }
            if(sizeof($newKeywords)>0){
                foreach ($newKeywords as $item){
                    $id = Keyword::where(['name' =>strtoupper($item)])->first();
                    $keyword = Keyword::find($id->id);
                    $keyword->Publication()->save($Publication);
                }
            }

            if($external_authors){
                $ext_auth_array = [];
                foreach ($external_authors as $item){
                    $ex_auth = ex_auth::find($item);
                    array_push($ext_auth_array,$ex_auth['id']);
                }
                $Publication->External_author()->sync($ext_auth_array);
            }

            if($new_external_authors){
                foreach ($new_external_authors as $item){
                    $id = ex_auth::where(['name' =>ucwords($item)])->first();
                    $ex_auth = ex_auth::find($id->id);
                    $ex_auth->Publication()->save($Publication);
                }
            }
            Session::flash('PublicationUpdate','Publication has been updated successully!');
        }
    }

    public function publicationDetail(Request $request){
        $Publication = Publications::with('member','keyword','project','external_author')->find(decrypt($request->id));
        return view('publications.publicationDetail',['Publications' => $Publication]);
    }

    public function storeKeyword(Request $request){
        if($request->ajax()){
            $newKeywords = $request->keywords;
            foreach ($newKeywords as $item) {
                $ar = Keyword::where(['name'=>strtoupper($item)])->get();
                if(sizeof($ar)>0){
                    continue;
                }
                else{
                    $keyword = new Keyword();
                    $keyword->name = strtoupper($item);
                    $keyword->save();
                }
            }
            echo "done";
        }
        else return redirect()->back();
    }

    public function storeExternalAuthor(Request $request){
        if($request->ajax()){
            $newExternalAuthors = $request->external_authors;
            foreach ($newExternalAuthors as $item) {
                $ar = ex_auth::where(['name'=>ucwords($item)])->get();
                if(sizeof($ar)>0){
                    continue;
                }
                else{
                    $ex_auth = new ex_auth();
                    $ex_auth->name = ucwords(trim($item));
                    $ex_auth->save();
                }
            }
            echo "done";
        }
        else return redirect()->back();
    }

    public function delete(Request $request){
        $pub = Publications::find(decrypt($request->id));
        $pub->delete();
        return redirect()->back();
    }
}
