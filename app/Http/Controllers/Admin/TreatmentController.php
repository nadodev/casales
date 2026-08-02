<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class TreatmentController extends Controller {
 public function index(){return view('admin.treatments.index',['items'=>Treatment::orderBy('sort_order')->get()]);}
 public function create(){return view('admin.treatments.form',['item'=>new Treatment]);}
 public function store(Request $r){Treatment::create($this->data($r));return redirect()->route('admin.treatments.index')->with('success','Tratamento cadastrado.');}
 public function edit(Treatment $treatment){return view('admin.treatments.form',['item'=>$treatment]);}
 public function update(Request $r,Treatment $treatment){$treatment->update($this->data($r,$treatment));return redirect()->route('admin.treatments.index')->with('success','Tratamento atualizado.');}
 public function destroy(Treatment $treatment){$treatment->delete();return back()->with('success','Tratamento removido.');}
 private function data(Request $r,?Treatment $item=null):array{$d=$r->validate(['name'=>'required|max:120','slug'=>['required','max:140','alpha_dash',Rule::unique('treatments')->ignore($item)],'category'=>'required|max:80','excerpt'=>'required|max:500','description'=>'required','benefits_text'=>'nullable','sort_order'=>'nullable|integer|min:0','is_active'=>'nullable|boolean']);$d['benefits']=array_values(array_filter(array_map('trim',preg_split('/\r\n|\r|\n/',$d['benefits_text']??''))));unset($d['benefits_text']);$d['is_active']=$r->boolean('is_active');return $d;}
}
