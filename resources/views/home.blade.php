<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>bs4 crud users - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row flex-lg-nowrap">
  <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
    <div class="card p-3">
      <div class="e-navlist e-navlist--active-bg">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link px-2 active" href="{{route('profile',Auth::id())}}"><i class="fa fa-fw fa-bar-chart mr-1"></i><span>Profile</span></a></li>
          <li class="nav-item"><a class="nav-link px-2" href="{{route('home')}}"><i class="fa fa-fw fa-th mr-1"></i><span>User CRUD</span></a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="e-tabs mb-3 px-3">
      <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" href="#">Users</a></li>
      </ul>
    </div>

    <div class="row flex-lg-nowrap">
      <div class="col mb-3">
        <div class="e-panel card">
          <div class="card-body">
            <div class="card-title">
              <h6 class="mr-2"><span>Users</span><small class="px-1">Be a wise leader</small></h6>
            </div>
            <div class="e-table">
              <div class="table-responsive table-lg mt-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="align-top">
                        <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0">
                          <input type="checkbox" class="custom-control-input" id="all-items">
                          <label class="custom-control-label" for="all-items"></label>
                        </div>
                      </th>
                      <th>Photo</th>
                      <th class="max-width">Name</th>
                      <th class="sortable">Date</th>
                      <th> </th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(count($users))
                    @foreach($users as $user)
                    <tr>
                      <td class="align-middle">
                        <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                          <input type="checkbox" class="custom-control-input" {{$user->isOnline()?'checked':''}} id="item-1{{$user->id}}">
                          <label class="custom-control-label" for="item-1{{$user->id}}"></label>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <div class="bg-light d-inline-flex justify-content-center align-items-center align-top" style="width: 35px; height: 35px; border-radius: 3px;">
                            @if($user->image)
                                <img width="35" height="35" src="{{asset($user->image)}}">
                            @else
                                <i class="fa fa-fw fa-photo" style="opacity: 0.8;"></i>
                            @endif
                        </div>
                      </td>
                      <td class="text-nowrap align-middle">{{$user->name}}</td>
                      <td class="text-nowrap align-middle"><span>{{$user->date}}</span></td>
                      <td class="text-center align-middle">
                        @if($user->status == 1)
                            <i onClick="activate('{{$user->id}}');" style="cursor:pointer;" class="fa fa-fw text-secondary cursor-pointer fa-toggle-on"></i>
                        @else
                            <i onClick="inactivate('{{$user->id}}');" style="cursor:pointer;" class="fa fa-fw text-secondary cursor-pointer fa-toggle-off"></i>
                        @endif

                      </td>
                      <td class="text-center align-middle">
                        <div class="btn-group align-top">
                            <a href="{{route('profile',$user->id)}}" class="btn btn-sm btn-outline-secondary badge" type="button" >View</a>
                            <button class="btn btn-sm btn-outline-secondary badge" type="button" data-toggle="modal" data-target="#user-form-modal-edit{{$user->id}}">Edit</button>
                            @if(Auth::id()==$user->id)
                            @else

                              <a href="javascript:;" data-id="{{$user->id}}" class="btn btn-sm btn-outline-secondary badge swal-confirm"><i class="fa fa-trash"></i></a>
                                  <form action="{{route ('destroy', $user->id)}}" id="delete{{$user->id}}" method="POST">
                                    @csrf
                                    @method('HEAD')                    
                                  </form>
                            @endif
                        </div>
                      </td>
                    </tr>



    <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal-edit{{$user->id}}">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit User</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="py-1">
              <form class="form" novalidate="" action="{{route('update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Full Name</label>
                          <input class="form-control" type="text" name="name" value="{{$user->name}}">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label>Username</label>
                          <input class="form-control" type="text" name="username" value="{{$user->username}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Email</label>
                          <input class="form-control" name="email" type="text" value="{{$user->email}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col mb-3">
                        <div class="form-group">
                          <label>About</label>
                          <textarea class="form-control" name="bio" rows="5">{{$user->bio}}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-6 mb-3">
                    <div class="mb-2"><b>Change Password</b></div>
{{--                     <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Current Password</label>
                          <input class="form-control" type="password" name="current_password">
                        </div>
                      </div>
                    </div> --}}
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Password</label>
                          <input class="form-control" name="password" type="password">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label>Confirm Password<span class="d-none d-xl-inline">Password</span></label>
                          <input class="form-control" name="confirm_password" type="password"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="date" value="{{$user->date}}">
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="hidden" name="old" value="{{$user->image}}">
                <div class="row">
                  <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
                    
                    @endforeach
                    @else
                        <div class="m-auto text-primary">No data in this record</div>
                    @endif
                  </tbody>
                </table>
              </div>
              <div class="d-flex justify-content-center">
                <ul class="pagination mt-3 mb-0">
{{--                   <li class="disabled page-item"><a href="#" class="page-link">‹</a></li>
                  <li class="active page-item"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">4</a></li>
                  <li class="page-item"><a href="#" class="page-link">5</a></li>
                  <li class="page-item"><a href="#" class="page-link">›</a></li>
                  <li class="page-item"><a href="#" class="page-link">»</a></li> --}}
                  {{ $users->links() }}
                   
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-3 mb-3">
        <div class="card">
          <div class="card-body">
            <div class="text-center px-xl-3">
              <button class="btn btn-success btn-block" type="button" data-toggle="modal" data-target="#user-form-modal">New User</button>
            </div>
            <hr class="my-3">
            <div class="e-navlist e-navlist--active-bold">
              <ul class="nav">
                <li class="nav-item active"><a href="" class="nav-link"><span>All</span>&nbsp;<small>/ {{count($users)}}</small></a></li>
                <li class="nav-item"><a href="" class="nav-link"><span>Active</span>&nbsp;<small>/ {{count($active)}}</small></a></li>
                <li class="nav-item"><a href="" class="nav-link"><span>Selected</span>&nbsp;<small>/</small></a></li>
              </ul>
            </div>
            <hr class="my-3">
            <div>
              <div class="form-group">
                <label>Date from - to:</label>
                <div>
                  <input id="dates-range" class="form-control flatpickr-input" placeholder="01 Dec 17 - 27 Jan 18" type="text" readonly="readonly">
                </div>
              </div>
        <form class="ajax" method="POST">
            @csrf
              <div class="form-group">
                <label>Search by Name:</label>
                <div><input class="form-control w-100 name" type="text" placeholder="Name"></div>
              </div>
            </div>
            <hr class="my-3">
            <div class="">
              <label>Status:</label>
              <div class="px-2">
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" name="userstatus" id="users-status-disabled" value="0">
                  <label class="custom-control-label" for="users-status-disabled">Disabled</label>
                </div>
              </div>
              <div class="px-2">
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" name="userstatus" id="users-status-active" value="1">
                  <label class="custom-control-label" for="users-status-active">Active</label>
                </div>
              </div>
              <div class="px-2">
                <div class="custom-control custom-radio">
                  <input type="radio" value="all" class="custom-control-input" name="userstatus" id="users-status-any">
                  <label class="custom-control-label" for="users-status-any">Any</label>
                </div>
              </div>
            </div>
            <hr class="my-3">
            <div class="text-center px-xl-3">
              <button class="btn btn-primary btn-block" type="submit" >Search</button>
            </div>
        </form>
          </div>
        </div>
      </div>
    </div>

    <!-- User Form Modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create User</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="py-1">
              <form class="form" novalidate="" action="{{route('store')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Full Name</label>
                          <input class="form-control" type="text" name="name" placeholder="fullname">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label>Username</label>
                          <input class="form-control" type="text" name="username" placeholder="username">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Email</label>
                          <input class="form-control" name="email" type="text" placeholder="email">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col mb-3">
                        <div class="form-group">
                          <label>About</label>
                          <textarea class="form-control" name="bio" rows="5" placeholder="Bio Data"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-6 mb-3">
                    <div class="mb-2"><b>Change Password</b></div>
{{--                     <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Current Password</label>
                          <input class="form-control" type="password" placeholder="••••••">
                        </div>
                      </div>
                    </div> --}}
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Password</label>
                          <input class="form-control" name="password" type="password">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label>Confirm Password<span class="d-none d-xl-inline">Password</span></label>
                          <input class="form-control" name="confirm_password" type="password"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Save User</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<style type="text/css">
body{
    margin-top:20px;
    background:#f8f8f8
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}

<script type="text/javascript">

    function activate(val){
        url = "{{route('inactivate')}}";
        $.get(url, {val}, function(data){
            swal("InActive data!");
            window.location.reload();
        });

    };

    function inactivate(val){          
        
        url = "{{route('activate')}}";
        $.get(url, {val}, function(data){
            swal("Active data!");
            window.location.reload();
        });
    };


    $('form.ajax').submit(function(e){
        e.preventDefault();

        var radio = $(':radio:checked').val();
        var name = $('.name').val();
        var url = "{{route('usernamewise')}}";
        $.get(url, {radio,name}, function(data){
            $('.table').html(data);
        });
    });

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>

  <!-- sweet alert cdn -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    $('.swal-confirm').click(function(){
        let id = $(this).data('id');
        swal({
          title: "Are you sure?",
          text: "delete this data!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Poof! Your imaginary file has been deleted!", {
              icon: "success",
            });
            $('#delete'+id).submit();
          }
        });
    });
  </script>

</body>
</html>