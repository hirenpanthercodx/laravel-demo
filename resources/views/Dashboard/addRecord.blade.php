@extends('Layouts.app')

<div class='card'>
    <div class="d-flex">
        <button class='btn btn-outline-secondary mr-4' onClick="window.location.href='{{ url("/dashboard") }}'">Back</button>
        <h4 class='mb-0 d-flex align-items-center'>Insert Record | PHP CRUD Operations</h4>
    </div>
    <hr>
    <form method="post" action="{{ url(($editData ?? '') ? '/user/update' : '/user/store') }}">
        @csrf
        <div>
            <div class="d-flex">
                <div class="col-6 form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="id" name="id" value="{{$editData->id ?? ''}}" hidden/>
                    <input type="text" id="firstName" name="firstName" value="{{$editData->firstName ?? ''}}" class="form-control" placeholder="Enter First name" required/>
                </div>
                <div class="col-6 form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" class="form-control" name="lastName" value="{{$editData->lastName ?? ''}}" placeholder="Enter Last name" required/>
                </div>
            </div>
            <div  class="d-flex">
                <div class="col-6 form-group">
                    <label for="lasttName">Email</label>
                    <input type="text" id="email" class="form-control" name="email" value="{{$editData->email ?? ''}}" placeholder="Enter Email" required/>
                </div>
                <div class="col-6 form-group">
                    <label for="lasttName">Gender</label>
                    <div class="d-flex">
                        <div class="mr-3 form-check">
                            <input type="radio" id="male" class="form-check-input" name="gender" value="male" @if (($editData->gender ?? '') === 'male') checked @endif required/>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="female" class="form-check-input" name="gender" value="female" @if (($editData->gender ?? '') === 'female') checked @endif required/>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="col-6 form-group">
                    <label for="occupation">Occuption</label>
                    <select class="custom-select" id="occupation" name="occupation" required>
                        <option value="" @if (($editData->occupation ?? '') === '') selected @endif >Select</option>
                        <option value="job" @if (($editData->occupation ?? '') === 'job') selected @endif >Job</option>
                        <option value="business" @if (($editData->occupation ?? '') === 'business') selected @endif > Business</option>
                        <option value="other" @if (($editData->occupation ?? '') === 'other') selected @endif >Other</option>
                    </select>
                </div>
                <div class="col-6 form-group">
                    <label for="hobby">Hobby</label>
                    <div class="d-flex">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="reading" name="hobby[]" id="hobby" @if(in_array('reading', json_decode($editData->hobby ?? '' ) ?? [])) checked @endif>
                            <label class="form-check-label" for="reading">Reading</label>
                        </div>
                        <div class="form-check mx-3">
                            <input class="form-check-input" type="checkbox" value="music" name="hobby[]" id="hobby" @if(in_array('music', json_decode($editData->hobby ?? '') ?? [])) checked @endif>
                            <label class="form-check-label" for="music">Music</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="movie" name="hobby[]" id="hobby" @if(in_array('movie', json_decode($editData->hobby ?? '') ?? [])) checked @endif>
                            <label class="form-check-label" for="movie">Movie</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mr-4">
            <input type="submit" class='btn btn-primary' role="button" name="insert" value="Submit" />
        </div>
    </form>
</div>