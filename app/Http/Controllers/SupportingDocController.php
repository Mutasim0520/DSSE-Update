<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Member as Member;
use App\Supporting_document as SD;
use Auth;

class SupportingDocController extends Controller
{
    public function showSupportingDocs(Request $request){
        $documents = SD::with('member','project','publication')->where(['type'=>$request->name])->paginate(10);
        //return $documents;
        if(Auth::guard('admin')->check()){
            return view('supportingDocuments.supportingDocumentList',['Documents' => $documents]);
        }
        else{
            return view('user.supportingDoc',['Documents' => $documents,'type' =>$request->name]);
        }
    }

    public function addSupportingDocs(){
        $Members = Member::where(['status' =>'Active'])->get();
        if(Auth::guard('admin')->check()){
            return view('supportingDocuments.addSupportingDocuments',['Members'=>$Members]);
        }
        elseif (Auth::guard('web')->check()){
            if(Auth::user()->role == 'Member'){
                return view('user.addSupportingDocuments',['Members'=>$Members]);
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect()->back();
        }
    }

    public function storeSupportingDocs(Request $request){
        if($request->file('file')){
            $this->validate($request, [
                'file'=> 'required|mimes:docx,doc,pdf|max:10048',
            ]);

            $fileName = time().'.'.$request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('uploaded_documents',$fileName);
        }
        $Document = new SD();
        $Document->title = $request->title;
        $Document->url = $request->url;
        $Document->purpose = $request->purpose;
        $Document->file = $fileName;
        if(Auth::guard('admin')->check()){
            $Document->member_id = $request->doc_owner;
        }
        else{
            $Document->member_id = Auth::user()->id;
        }
        $Document->type = $request->doc_type;
        $Document->save();
        return redirect(url("/admin/sd/$request->doc_type"));
    }

    public function deleteSupportingDoc (Request $request){
        if($request->ajax()){
            $Document = SD::find($request->id)->delete();
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
}
