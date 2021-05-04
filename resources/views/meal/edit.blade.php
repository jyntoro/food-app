@extends('layouts.main')

@section('title')
    Editing {{ $meal->name }}
@endsection

@section('content')
<form action="{{ route('meal.update', [ 'id' => $meal->id ]) }}" method="POST"> 
    @csrf 
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input 
            type="text" 
            name="name" 
            id="name" 
            class="form-control" 
            value="{{ old('name', $meal->name) }}"
        >
        @error('name') 
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label for="meal_type" class="form-label">Meal Type</label>
        <select name="meal_type" id="meal_type" class="form-select">
            <option value="">-- Select meal_type --</option>
            @foreach($meal_types as $meal_type)
                <option 
                    value="{{$meal_type->id}}"
                    {{ $meal_type->id === (int) old('meal_type', $meal->meal_type_id) ? "selected" : "" }}> 
                    {{$meal_type->name}}
                </option>
            @endforeach
        </select>
        @error('meal_type')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        Save
    </button>
</form>
@endsection
