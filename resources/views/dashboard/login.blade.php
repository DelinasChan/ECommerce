登入
@if(Session::has('error'))
 <a>{{ Session::get('error') }}</a>
@endif
