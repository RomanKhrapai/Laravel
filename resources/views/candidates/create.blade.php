@extends('layouts.admin')

@section('title')
    Form for creating candidates
@endsection

@section('content')
    <h1 class="text-white">Form for creating candidates</h1>

    <form action="{{ route('candidates.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-group">
            <label class="text-white" for="title">
                title
            </label>
            <input type="text" name="title" placeholder="Enter a title" id="title" class="form-control"
                value="{{ old('title') }}" class="@error('title') is-invalid @enderror">
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="description">
                description
            </label>
            <input type="text" name="description" placeholder="Enter a description" id="description" class="form-control"
                value="{{ old('description') }}" class="@error('description') is-invalid @enderror">
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="salary">
                salary
            </label>
            <input type="text" name="salary" placeholder="Enter a salary" id="salary" class="form-control"
                value="{{ old('salary') }}" class="@error('salary') is-invalid @enderror">
        </div>
        @error('salary')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="max_salary">
                max salary
            </label>
            <input type="text" name="max_salary" placeholder="Enter a max_salary" id="max_salary" class="form-control"
                value="{{ old('max_salary') }}" class="@error('max_salary') is-invalid @enderror">
        </div>
        @error('max_salary')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                User:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select class="js-example-basic-single" name="user_id">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }}>
                                {{ $user->id }} - {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        @error('company_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                Profession:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select class="js-example-basic-single" name="profession_id" data-url='{{ url(route('api.skillByProfesion')) }}'
                        data-select_skills>
                        @foreach ($professions as $profession)
                            <option value="{{ $profession->id }}"
                                {{ $profession->id == old('profession_id') ? 'selected' : '' }}>
                                {{ $profession->id }} - {{ $profession->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        @error('profession_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <span class="text-white d-block">Skills:</span>
            <div class="bg-white" id='skills'>
                @foreach ($skills as $skill)
                    @if (
                        $skill->profession_id == old('profession_id') ||
                            (empty(old('profession_id')) && $skill->profession_id === $professions[0]->id))
                        <div class="btn row">
                            <label class='form-check-label'> <input value="{{ $skill->id }}" type="checkbox"
                                    class="form-check-input block" name="skills[]"
                                    {{ in_array($skill->id, old('skills', [])) ? 'checked' : '' }}>
                                {{ $skill->name }}
                            </label>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @error('skills')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                Area:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select class="js-example-basic-single" name="area_id">
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}" {{ $area->id == old('area_id') ? 'selected' : '' }}>
                                {{ $area->id }} - {{ $area->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        @error('area_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                Nature:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select class="js-example-basic-single" name="nature_id">
                        @foreach ($natures as $nature)
                            <option value="{{ $nature->id }}" {{ $nature->id == old('nature_id') ? 'selected' : '' }}>
                                {{ $nature->id }} - {{ $nature->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </label>
        </div>
        @error('nature_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <span class="text-white d-block">Types:</span>
            <div class="bg-white">
                @foreach ($types as $type)
                    <div class="btn row">
                        <label class='form-check-label'> <input value="{{ $type->id }}" type="checkbox"
                                class="form-check-input block" name="types[]"
                                {{ in_array($type->id, old('types', [])) ? 'checked' : '' }}>
                            {{ $type->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        @error('type_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div id="dynamicData">
            <!-- Тут буде відображатися динамічний вміст -->
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
