@if($errors->any())
    <div class="alert alert-danger m-t-40">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
        <h3 class="text-danger"><i class="fa fa-exclamation-triangle pr-3"></i>Error</h3>
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif