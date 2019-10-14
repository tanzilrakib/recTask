@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show">{{ Session::get('message') }}
                    @guest
                        <br> To view list items please <a href="{{route('login')}}">login</a>.
                    @endguest
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" {{-- style="padding-top: 2px; padding-right:5px" --}}>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>
            @endif

            <h3 class="text-strong col-md-8">Info List</h3>
            <hr>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @foreach ($infoList as $info)
                
                <div class="card mb-3">
                  <div class="card-header">
                    <span class="float-left">Name: {{ $info->name }}</span><span class="float-right">ID: {{ $info->id }}</span>
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email: {{ $info->email }}</li>
                    <li class="list-group-item">Phone: {{ $info->phone }}</li>
                  </ul>
                </div>
            @endforeach
            
            {{ $infoList->links() }}

        </div>
    </div>
</div>
@endsection
