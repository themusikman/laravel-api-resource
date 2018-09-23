<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\ServiceRequest; //model
use App\Http\Resources\ServiceRequest as ServiceRequestResource; //resource

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //Get Service Requests
      $servicerequest = ServiceRequest::paginate(15);

      //Return collection of requests as resource
      return ServiceRequestResource::collection($servicerequest);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $servicerequest = $request->isMethod('put')
        ? ServiceRequest::findOrFail($request->request_id)
        : new ServiceRequest;

      $servicerequest->request_id = $request->input('request_id');
      $servicerequest->request_name = $request->input('name');
      $servicerequest->user_id = $request->input('user_id');

      if($servicerequest->save()){
        return new ServiceRequestResource($servicerequest);
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //get service request
      $servicerequest = ServiceRequest::findOrFail($id);

      //return single service request in a resource
      return new ServiceRequestResource($servicerequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $servicerequest = ServiceRequest::findOrFail($id);

      if($servicerequest->delete()) {
        return new ServiceRequestResource($servicerequest);
      } else {
        return [];
      }
    }
}
