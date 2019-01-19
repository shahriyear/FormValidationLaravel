<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Laravel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


        <script src="{{asset('/js/jquery.validate.min.js')}}"></script>
        <script src="{{asset('/js/additional-methods.min.js')}}"></script>

        {{--<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">--}}

    </head>


    <body>

    <div class="row-fluid" style="margin-top: 25px">
        <div class="container">
           <div class="col-md-8">
               @if(Session::has('message'))
               <div class="alert alert-success">
                   {{ Session::get('message') }}
               </div>
               @endif
                   @if($errors->any())
                       <div class="alert alert-danger">
                          <ul>
                              @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                       </div>
                   @endif
               <form id="dataForm" action="{{ route('data') }}" method="post">
                    @csrf
                   <div class="form-group row">
                       <label for="name" class="col-sm-4 col-form-label">Name</label>
                       <div class="col-sm-8">
                           <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Name">
                       </div>
                   </div>

                   <div class="form-group row">
                       <label for="email" class="col-sm-4 col-form-label">Email</label>
                       <div class="col-sm-8">
                           <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Email">
                       </div>
                   </div>

                   <div class="form-group row">
                       <label for="username" class="col-sm-4 col-form-label">Username</label>
                       <div class="col-sm-8">
                           <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="username" placeholder="Username">
                       </div>
                   </div>

                   <div class="form-group row">
                       <label for="password" class="col-sm-4 col-form-label">Password</label>
                       <div class="col-sm-8">
                           <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                       </div>
                   </div>

                   <div class="form-group row">
                       <label for="password_confirmation" class="col-sm-4 col-form-label">Confirm Password</label>
                       <div class="col-sm-8">
                           <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                       </div>
                   </div>

                   <div class="form-group row">
                       <div class="col-sm-8 offset-4">
                           <input type="submit" value="Save" class="btn btn-primary">
                           {{--<button type="submit" class="btn btn-primary">Save</button>--}}
                       </div>
                   </div>
               </form>
           </div>
        </div>
    </div>


    <script>
       $(document).ready(function () {

           {{--$("#email").on('keyup',function () {--}}
               {{--var email = $(this).val();--}}
                {{--$.ajax({--}}
                    {{--url:'/isEmail',--}}
                    {{--type:'post',--}}
                    {{--data:{--}}
                        {{--_token:"{{ csrf_token() }}",--}}
                        {{--email:email--}}
                    {{--},--}}
                    {{--success:function (data) {--}}
                        {{--console.log(data);--}}
                    {{--}--}}
                {{--});--}}
           {{--});--}}


           $("#dataForm").validate({
               rules:{
                 name:"required",
                  email:{
                     required:true,
                      email: true,
                      remote:{
                         url:"/isEmail",
                          type:"post",
                          data:{
                              _token: $('meta[name="csrf-token"]').attr('content'),
                              email: function() {
                                  return $( "#email" ).val();
                              }
                          }
                      }
                  },
                   username:"required",
                   password:"required",
                   password_confirmation:{
                        required:true,
                       equalTo:"#password"
                   }
               },
               messages:{
                   email:{
                       required:"Email is requried!",
                       email:"Please Enter a Valid E-Mail Address!",
                       remote: "Email Already Used!"
                   }
               },
               // submitHandler: function (form) {
               //     console.log("Submitted!");
               //     form.submit();
               // }
           });
       });

    </script>
    </body>
</html>
