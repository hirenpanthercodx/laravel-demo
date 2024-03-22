@extends('Layouts.app')

<div class='card'>
    <div class='d-flex justify-content-between my-3'>
        <h4 class='d-flex align-items-center mb-0'>Admin Dashboard</h4>
        <div class='d-flex'>
            <div class='mr-2'>
                <button type="button" class='btn btn-success' onClick="window.location.href='{{ url("/dashboard/addRecord") }}'">Add Record</button>
            </div>
            <div>
                <button class='btn btn-danger' onClick="window.location.href='{{ url("/logout") }}'">Log Out</button>
            </div>
        </div>
    </div>
    <div>
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
                                <div class='mr-2'>
                                    <a class='btn btn-primary btn-sm' role="button" name="update" onClick="window.location.href='{{ url("/dashboard/edit/$item->id") }}'">Edit</a>  
                                </div>
                                <div>
                                    <form method='POST'>
                                        <input type=hidden name=id >
                                        <input type="submit" class='btn btn-danger btn-sm' role="button" name="insert" value="Delete" />
                                    </form>                               
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>  
</div> 