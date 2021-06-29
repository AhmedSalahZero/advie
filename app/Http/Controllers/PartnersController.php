<?php

namespace App\Http\Controllers;

use App\Partners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PartnersController extends Controller
{

    public function index()
    {
        return view('backend.partners.index')->with('partners',Partners::paginate(10));
    }


    public function create()
    {
        return view('backend.partners.form');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),$this->rules(),$this->messages());
        if($validator->fails())
        {
            return redirect()->back()->with('fail',$validator->errors()->first());
        }
        $image = $request->image->store('/partners','public');
        Partners::create(array_merge($request->only(['name','position']),['image'=>$image]));
        return redirect()->back()->with('success','Partner has been inserted');



    }


    public function show($id)
    {
        //
    }


    public function edit(Partners $Partner)
    {

        return view('backend.partners.form')->with('partner',$Partner);
    }


    public function update(Request $request, Partners $Partner)
    {
        $validator = Validator::make($request->all(),$this->updateRules(),$this->messages());
        if($validator->fails())
        {
            return redirect()->back()->with('fail',$validator->errors()->first());
        }
        if($request->has('image'))
        {

            if(file_exists('storage/'.$Partner->image))
                unlink('storage/'.$Partner->image);
           $image =  $request->image->store('/partners','public');

        }
        else{
            $image = $Partner->image ;
        }

        $data = array_merge($request->only(['position','name']),['image'=>$image]);
        $Partner->update($data);
        return redirect()->route('partners.index')->with('success','partner data has been updated');

    }


    public function destroy(Partners $Partner)
    {
        $this->deleteImageIfExist($Partner->image);
        $Partner->delete();
        return redirect()->back()->with('success','section has been deleted') ;
    }
    protected function deleteImageIfExist($image)
    {
        if(file_exists('storage/'.$image))
            unlink('storage/'.$image);
    }
    protected function rules(){
        return [
            'name.en'=>'required',
            'name.ar'=>'required',
            'position.en'=>'required',
            'position.ar'=>'required',
            'image'=>'required|mimes:jpg,jpeg,bmp,png',
        ];

    }
    protected function messages(){
        return [

            'name.en.required'=>'You have to insert English Name ',
            'name.ar.required'=>'You have to insert Arabic Name ',
            'position.ar.required'=>'You have to insert Arabic Position ',
            'position.en.required'=>'You have to insert English Position ',
            'position.required'=>'You have to insert English Position ',
            'image.required'=>'You have to insert The partner Image ',
            'image.mimes'=>'This type is not supported',
        ];
    }
    protected function updateRules(){
        return [
            'name.en'=>'required',
            'name.ar'=>'required',
            'position.en'=>'required',
            'position.ar'=>'required',
            'image'=>'mimes:jpg,jpeg,bmp,png',
        ];

    }
}
