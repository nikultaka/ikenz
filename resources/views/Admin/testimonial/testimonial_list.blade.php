@extends('Admin.layouts.dashboard.main')

@section('content')
    
   <div id="content-header">
<!--    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>-->
    <h1>Testimonial List</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
            <h5>Testimonial Detail List Here </h5>
            <!--<button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#mydocumentModal">Add New Document</button>-->
             <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ins_tes" style="margin-bottom: 20px;">Create New</button>
<!--            <a href="addmember"> <span class="label label-info">Add Member</span></a>-->
          </div>
          <div class="widget-content ">
            <table class="table table-bordered table-striped with-check test-table">
              <thead>
                <tr>
                  
                  <th>ID</th>
                  <th>Customer</th>
                  <th>Feedback</th>
                  <th>User Photo</th>
                  <th>status</th>
                  <th>Created Date</th>
                  <th>Updated Date</th>
                  <th>Action</th>
                 
                </tr>
              </thead>
              <tbody>
                  
              </tbody>
            </table>
          </div>
        </div>
        
        
      </div>
    </div>
  </div>
@include('Admin.testimonial.testimonial')

@endsection