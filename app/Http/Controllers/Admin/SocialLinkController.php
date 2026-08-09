<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
class SocialLinkController extends Controller {
 public function index(){return view('admin.social-links.index',['items'=>SocialLink::orderBy('sort_order')->get()]);}
 public function create(){return view('admin.social-links.form',['item'=>new SocialLink]);}
 public function store(Request $r){SocialLink::create($this->data($r));return redirect()->route('admin.social-links.index')->with('success','Rede social cadastrada.');}
 public function edit(SocialLink $social_link){return view('admin.social-links.form',['item'=>$social_link]);}
 public function update(Request $r,SocialLink $social_link){$social_link->update($this->data($r));return redirect()->route('admin.social-links.index')->with('success','Rede social atualizada.');}
 public function destroy(SocialLink $social_link){$social_link->delete();return back()->with('success','Rede social removida.');}
 private function data(Request $r):array
 {
  $isWhatsApp=strtolower(trim((string)$r->input('platform')))==='whatsapp';
  $d=$r->validate([
   'platform'=>'required|max:60',
   'label'=>'required|max:100',
   'phone'=>[$isWhatsApp?'required':'nullable','string','max:30',...($isWhatsApp?['regex:/^(?:\D*\d){10,15}\D*$/']:[])],
   'url'=>[$isWhatsApp?'nullable':'required','nullable','url:http,https','max:500'],
   'sort_order'=>'nullable|integer|min:0',
   'is_active'=>'nullable|boolean'
  ]);
  $d['platform']=trim($d['platform']);
  $d['label']=trim($d['label']);
  if($isWhatsApp){
   $phone=preg_replace('/\D+/','',$d['phone']);
   $d['phone']=$phone;
   $d['url']='https://wa.me/'.$phone;
  }else{$d['phone']=null;}
  $d['sort_order']=$d['sort_order']??0;
  $d['is_active']=$r->boolean('is_active');
  return $d;
 }
}
