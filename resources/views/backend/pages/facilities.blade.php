@extends('backend.master')

@section('master-panel')
<div class="pageheader-title float-left">Facilities Panel</div>
 <div class="pageheader-title float-right"><a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></a></div>
@endsection
@section('content')
<!--facilities list search start-->
<div class="card">
  <div class="card-header">
   	<i class="fas fa-list"></i> Facilities Filtering
  </div>
  <div class="card-body">
    <form>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputCity">Facilities name</label>
      <input type="text" class="form-control" id="facilitiesname" placeholder="facilities name">
    </div>
    
    <div class="form-group col-md-4">
      <label for="inputState">Status</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>active</option>
        <option>inactive</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <button type="submit" class="btn btn-primary" style="margin-top: 24px;
    border-radius: 7px;"><i class="fas fa-search"></i>Search</button>
    </div>
  </div>
  
</form>
  </div>
</div><!--facilities list search end-->

<!--facilities list show start-->
<div class="card">
  
  <div class="card-body">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th>Sl/No</th>
      <th>Name</th>
      <th>Icon</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($facilities as $key=>$facility)
    <tr>
      <th>{{$facility->id}}</th>
      <td>{{$facility->name}}</td>
      <td>{{$facility->icon}}</td>
      <td>
      	<a href="#" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>
      	<a href="#" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
  </div>
</div>
<!--facilities list show end-->
@endsection


<!--Facilities Modal start-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Facilities</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('facilities.create')}}" enctype="multipart/form-data" onsubmit="return ValidationEvent()">
         @csrf()
      <div class="modal-body">
        
          <div class="form-group">
            <label for="facilities">Facilities Name</label>
            <input type="text" class="form-control" id="facilities" placeholder="facilities">
            <strong class="text-danger"></strong>
          </div>
          <div class="form-group">
            <label for="icon">Icon</label>
            <input type="file" class="form-control" id="icon">
            <strong class="text-danger"></strong>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
              <select id="status" class="form-control">
                <option selected>Choose...</option>
                <option>Active</option>
                <option>Inactive</option>
              </select>
              <strong class="text-danger"></strong>
          </div>
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-sm" id="facilities-add">Add</button>
      </div>
       </form>
    </div>
  </div>
</div>
<!--Facilities Modal end-->
<script type="text/javascript">
    function ValidationEvent() {
        // Storing Field Values In Variables
        var name = document.getElementById("name").value;
        var icon = document.getElementById("icon").value;
        var status = document.getElementById("status").value;
        // Regular Expression For Email
      if (name=='') {
       alert("required name"); return false;}
      else if(icon==''){alert("required icon"); return false;}
      else if(status==''){alert("required status"); return false;}
      else{return true;}

        }
</script>