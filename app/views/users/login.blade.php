@section('content')
    {{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin')) }}
    <h2 class="form-signin-heading">Please Login</h2>

    {{ Form::text('email', null, array("class"=>"input-block-level form-control", "palceholder"=>"Email")) }}
    {{ Form::password('password', array("class"=>"input-block-level form-control", "placeholder"=>"Password")) }}
    {{ Form::submit('Login', array("class"=>"btn btn-primary btn-block")) }}

    {{ Form::close() }}
@stop
