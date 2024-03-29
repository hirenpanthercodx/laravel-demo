@extends('Layouts.app')

@section('admin_dashboard') 
    <div class='card m-0' style="height: 98vh">
        <div class='d-flex justify-content-between my-3'>
            <h4 class='d-flex align-items-center mb-0'>Admin Dashboard</h4>
            <div class='d-flex'>
                <div class='mr-2'>
                    @if (in_array('create', json_decode(session('auth_user')->permisssion)))
                        <button type="button" class='btn btn-success' onClick="window.location.href='{{ url("/admin/addRecord") }}'">Add Record</button>
                    @endif
                </div>
                <div>
                    <button class='btn btn-danger' onClick="window.location.href='{{ url("/logout") }}'">Log Out</button>
                </div>
            </div>
        </div>

        @if (in_array('view', json_decode(session('auth_user')->permisssion)))
            <div class="table-responsive">
                <table class="table">
                    <thead class='thead-light'>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>LastName</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Occuption</th>
                            <th>Hobby</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listingData as $item)    
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->firstName}}</td>
                                <td>{{$item->lastName}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->gender}}</td>
                                <td>{{$item->occupation}}</td>
                                <td>
                                    @foreach(json_decode($item->hobby) as $hobbys)
                                        {{ $hobbys. (count(json_decode($item->hobby))-1 > $loop->index ? ', ' : '') }}
                                    @endforeach
                                </td>
                                <td>
                                    <div class='d-flex'>
                                        @if (in_array('update', json_decode(session('auth_user')->permisssion)))
                                            <div class='mr-2'>
                                                <a class='btn btn-primary btn-sm' role="button" name="update" onClick="window.location.href='{{ url("/admin/edit/$item->id") }}'">Edit</a>  
                                            </div>
                                        @endif
                                        @if (in_array('delete', json_decode(session('auth_user')->permisssion)))
                                            <div>
                                                {{-- <input type=hidden name=id > --}}
                                                {{-- <button class='btn btn-danger btn-sm' onclick="window.location.href='{{ url('admin/user/delete/'. $item->id) }}'">Delete</button>                               --}}
                                                <a class='btn btn-danger text-black btn-sm' onclick="deleteButton({{$item->id}})">Delete</a>                              
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $listingData->links() }}
            </div>  
        @endif
    </div> 

    <x-delete-model url="/admin/user/delete" nameField="deleteUserId" modelId="deleteUserModel" header="User" />

    @if (session('create_user'))
        <script>
            toastr.success('{{ session('create_user') }}');
        </script>
    @elseif(session('create_error_user'))
        <script>
            toastr.error('{{ session('create_error_user') }}');
        </script>
    @elseif(session('update_user'))
        <script>
            toastr.success('{{ session('update_user') }}');
        </script>
    @elseif(session('update_error_user'))
        <script>
            toastr.error('{{ session('update_error_user') }}');
        </script>
    @elseif(session('delete_user'))
        <script>
            toastr.success('{{ session('delete_user') }}');
        </script>
    @elseif(session('delete_error_user'))
        <script>
            toastr.error('{{ session('delete_error_user') }}');
        </script>
    @endif

@endsection