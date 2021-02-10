@extends(auth()->user()->admin ||auth()->user()->print_vendor ||auth()->user()->delivery_vendor ?'layouts.admin_layout': 'layouts.user_layout')
@section('content')
    <div class="container-fluid px-lg-4 mb-5">
        <form id="form_id" name="form_id" method="post" action="/see_full_conversation">
            @csrf
            <input type="hidden" name="other_id" id="other_id" value="{{$data}}">
            <button type="submit" name="search_submit"></button>
        </form>
    </div>

@endsection



@section('extra_js')
    <script>
        window.onload = function(){
            document.forms['form_id'].submit();
        }
    </script>
@endsection
