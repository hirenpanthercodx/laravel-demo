@extends('Layouts.app')
{{-- @section('content') --}}
<div class="bodyMain">
    <div class="main"> 
        <form method="post" action="{{ url('/user/register') }}">
            @csrf
            <h3>Welcome to ELEOS</h3> 
            <h6>Please sign-up to your account</h6> 
            <div class="my-3">
                <label for="email">Email </label> 
                <input type="text" 
                    class="form-control"
                    name="email" 
                    placeholder="Enter your email" required
                > 
            </div>
            <div>
                <label for="password">Password</label> 
                <input type="password"
                    class="form-control"
                    name="password" 
                    placeholder="Enter your Password" required
                > 
            </div>
            <div class='my-3'>
                <label for="role">Role</label>
                <select class="custom-select" name="role" required>
                    <option value="">Select</option>
                    <option value="admin">Admin</option>
                    <option value="employee">Employee</option>
                </select>
            </div>
            <div class='my-3'>
                <label >Role Permissions</label>
                <div class='d-flex'>
                    <span class='form-check'>
                        <input type='checkbox' class="form-check-input" value="view" id='permission' name='permission[]' />
                        <label for="view">View</label>
                    </span>
                    <span class='mx-3 form-check'>
                        <input type='checkbox' class="form-check-input" value="create" id='permission' name='permission[]' />
                        <label for="create">Create</label>
                    </span>
                    <span class='mr-3 form-check'>
                        <input type='checkbox' class="form-check-input" value="update" id='permission' name='permission[]' />
                        <label for="update">Update</label>
                    </span>
                    <span class='form-check'>
                        <input type='checkbox' class="form-check-input" value="delete" id='permission' name='permission[]' />
                        <label for="delete">Delete</label>
                    </span>
                </div>
                {{-- <span class="text-danger"><?php echo $permissionErr;?></span> --}}
            </div>
            <div class="mb-2"> 
                <input type="submit" role="button" name="register" class="btn btn-success w-100" value="Register" />
            </div> 
        </form>
    </div>  
</div>
{{-- @endsection --}}