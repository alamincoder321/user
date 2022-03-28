<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>edit profile page - Bootdey.com</title>
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
        <div class="row">
          <div class="col mb-3">
            <div class="card">
              <div class="card-body">
                <div class="e-profile">
                  <div class="row">
                    <div class="col-12 col-sm-auto mb-3">
                      <div class="mx-auto" style="width: 140px;">
                        <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                          @if($user->image)
                          <img width="140" height="140" src="{{asset($user->image)}}">
                          @else
                          <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                      <div class="text-center text-sm-left mb-2 mb-sm-0">
                        <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{$user->name}}</h4>
                        <p class="mb-0">{{$user->username}}</p>
                        <div class="text-muted"><small>Last seen {{Carbon\Carbon::parse($user->lastseen)->diffForHumans()}}</small></div>
                        <form class="form" action="{{route('update')}}" method="POST" enctype="multipart/form-data" novalidate="">
                          @csrf
                          <div class="mt-2">
                            <button class="btn btn-primary" type="button">
                              <i class="fa fa-fw fa-camera"></i>
                              <span><input type="file" name="image"></span>
                            </button>
                          </div>
                      </div>
                      <div class="text-center text-sm-right">
                        <span class="badge badge-secondary">administrator</span>
                        <div class="text-muted"><small>Joined {{$user->date}}</small></div>
                      </div>
                    </div>
                  </div>
                  <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="" class="active nav-link">Profile</a></li>
                  </ul>
                  <div class="tab-content pt-3">
                    <div class="tab-pane active">

                      <div class="row">
                        <div class="col">
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Full Name</label>
                                <input class="form-control" type="text" name="name" placeholder="{{$user->name}}" value="{{$user->name}}">
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
                                <input class="form-control" type="text" name="email" value="{{$user->email}}">
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
                          {{-- <div class="row">
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
                                <label>New Password</label>
                                <input class="form-control" name="password" type="password">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                <input class="form-control" name="confirm_password" type="password">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <input type="hidden" name="date" value="{{$user->date}}">
                      <input type="hidden" name="id" value="{{Auth::id()}}">
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
          </div>

          @if(Auth::id()==$user->id)
          <div class="col-12 col-md-3 mb-3">
            <div class="card mb-3">
              <div class="card-body">
                <div class="px-xl-3">
                  <a class="btn btn-block btn-secondary" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </div>
            </div>
          </div>
          @else
          @endif
        </div>

      </div>
    </div>
  </div>

  <style type="text/css">
    body {
      margin-top: 20px;
      background: #f8f8f8
    }
  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  {!! Toastr::message() !!}
  <script type="text/javascript">
    @if(count($errors) > 0)
    @foreach($errors - > all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif
  </script>
</body>

</html>