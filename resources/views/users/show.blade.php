 @extends('layouts.admin')

 @section('content')
     <div class="bg-light p-4 rounded">
         <h1>{{ ucfirst($user->name) }}</h1>
         <div class="lead">

         </div>

         <div class="container mt-4">
             @empty(!$user->image)
                 <img loading="lazy" src="{{ Storage::url($user->image) }}" height="60" width="47"></img>
             @endempty

             <table class="table table-striped">
                 <thead>
                     <th scope="col">field name</th>
                     <th scope="col">value</th>
                 </thead>
                 <tbody>
                     <tr>
                         <td>
                             <h5>ID</h5>
                         </td>
                         <td>
                             <h6>{{ $user->id }}</h6>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <h5>name</h5>
                         </td>
                         <td>
                             <h6>{{ $user->name }}</h6>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <h5>email</h5>
                         </td>
                         <td>
                             <h6>{{ $user->email }}</h6>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <h5>telephone</h5>
                         </td>
                         <td>
                             <h6>{{ $user->telephone ?? 'null' }}</h6>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <h5>role id (role)</h5>
                         </td>
                         <td>
                             <h6>{{ $user->role_id }} ({{ $user['role']->name }})</h6>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             <h5>foto url</h5>
                         </td>
                         <td>
                             <h6>{{ $user->image ?? 'null' }}</h6>
                         </td>
                     </tr>

                 </tbody>
             </table>
         </div>

     </div>
     <div class="mt-4">
         <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
         {{-- <a href="{{ route('users.index') }}" class="btn btn-info">Back</a> --}}
         <a href="{{ URL::previous() }}" class="btn btn-info">Back</a>
     </div>
 @endsection
