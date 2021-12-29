<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>{{ config('app.name') }}</title>

      <script src="{{ asset('js/app.js') }}" defer></script>

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="{{ route('contacts.index') }}">{{ config('app.name') }}</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="/admin">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/contacts">Contacts</a>
                </li>

                  <li class="nav-item active">
                      <a class="nav-link" href="{{ route('group.index') }}">Groups <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/admin/logout">Logout</a>
                </li>

              </ul>

              <ul class="navbar-nav ml-auto">
               
                    
                                @csrf
                            </form>
                        </div>
                    </li>
            </ul>
              
          </div>
      </nav>

      @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Success!</h4>
                <p>{{ Session::get('success') }}</p>

                <button type="button" class="close" data-dismiss="alert aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (Session::has('errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Error!</h4>
                <p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </p>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

          <div class="container py-3">

            <div class="modal" tabindex="-1" role="dialog" id="editCategoryModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Group</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                      <div class="form-group">
                        <input type="text" name="name" class="form-control" value="" placeholder="Group Name" required>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                  </form>
              </div>
            </div>

          <div class="row">
            <div class="col-md-8">

              <div class="card">
                <div class="card-header">
                  <h3>Groups</h3>
                </div>
                <div class="card-body">
                  <ul class="list-group">
                    @foreach ($groups as $group)
                      <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                          {{ $group->name }}

                          <div class="button-group d-flex">
                            <button type="button" class="btn btn-sm btn-primary mr-1 edit-category" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $group->id }}" data-name="{{ $group->name }}">Edit</button>

                            <form action="{{ route('group.destroy', $group->id) }}" method="POST">
                              @csrf
                              @method('DELETE')

                              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                          </div>
                        </div>

                        @if ($group->children)
                          <ul class="list-group mt-2">
                            @foreach ($group->children as $child)
                              <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                  {{ $child->name }}

                                  <div class="button-group d-flex">
                                    <button type="button" class="btn btn-sm btn-primary mr-1 edit-category" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $child->id }}" data-name="{{ $child->name }}">Edit</button>

                                    <form action="{{ route('group.destroy', $child->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')

                                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                  </div>
                                </div>
                              </li>
                            @endforeach
                          </ul>
                        @endif
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h3>Create Group</h3>
                </div>

                <div class="card-body">
                  <form action="{{ route('group.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                      <select class="form-control" name="parent_id">
                        <option value="">Select Parent Group</option>

                        @foreach ($groups as $group)
                          <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Group Name" required>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

        <script type="text/javascript">
          $('.edit-category').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var url = "{{ url('group') }}/" + id;

            $('#editCategoryModal form').attr('action', url);
            $('#editCategoryModal form input[name="name"]').val(name);
          });
        </script>
    </body>
</html>

