<!-- {!! Form::label('name', 'Name:') !!} {!! Form::label('guard_name', 'Guard Name:') !!}-->
<div class="col-sm-12">
    <label class="form-control-label" for="name">{{__('messages.Name')}} :</label>
    {{ $permission->name }}
</div>

<div class="col-sm-12">
    <label class="form-control-label" for="guard_name">{{__('messages.Guard Name')}} :</label>
    {{ $permission->guard_name }}
</div>

