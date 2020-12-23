@php 
$status_msg = "";
$status_css = "";

if (session()->has("success")) {
    $status_msg = session()->get("success");
    $status_css = "alert-success";
}

if (session()->has("error")) {
    $status_msg = session()->get("error");
    $status_css = "alert-danger";
}
@endphp

@if($status_msg != "")
<div class="alert {{ $status_css }} alert-dismissible fade show mb-2" role="alert">
  {!! $status_msg !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mb-2">
        Oops, please check that :
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif