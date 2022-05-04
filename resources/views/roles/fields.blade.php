<!-- {!! Form::label('name', 'Name:') !!} {!! Form::label('guard_name', 'Guard Name:') !!} -->
<div class="form-group col-sm-6">
    <label class="form-control-label" for="name">{{__('messages.Name')}} :</label>
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    <label class="form-control-label" for="guard_name">{{__('messages.Guard Name')}} :</label>
    {!! Form::text('guard_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>