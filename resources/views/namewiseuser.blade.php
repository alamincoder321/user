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