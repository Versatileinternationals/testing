<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainningStream;

class TrainningStreamController extends Controller
{
    public $route="trainning_stream";
    public $view ="TrainningStream";
    public $moduleName = 'Training Category';

    public function index()
    {        
        $moduleName = $this->moduleName;                
        $Streams = TrainningStream::orderBy('id','DESC')->get();  
        return view('admin/'.$this->view.'/index', compact('moduleName', 'Streams'));
    }

    public function create()
    {
        $moduleName = $this->moduleName;           
        return view('admin/'.$this->view.'/form', compact('moduleName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',     
            'status' => 'required',
          
        ]);  
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
       
       // $data['added_by'] = auth()->user()->id;
        
        $banner = TrainningStream::create($data);
       
        return redirect($this->route)->withStatus(__('Stream is added successfully.'));
    }
    
    public function edit($id)
    {
        $moduleName = $this->moduleName;  
        $Streams = TrainningStream::find(decrypt($id));     
      
        return view('admin/'.$this->view.'/_form', compact('moduleName', 'Streams'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',     
                   
            'status' => 'required',            
        ]);  
        $data = $request->all();  
        $data['name'] = ucfirst($request->name);   
        
        TrainningStream::find($id)->update($data);        
        return redirect($this->route)->withStatus(__('Stream is updated successfully.'));
    }
    public function delete($id){
        $moduleName = $this->moduleName;  
        $Streams = TrainningStream::find($id)->delete();
        return redirect($this->route)->withStatus(__('Stream is delete successfully.'));
    }
}
